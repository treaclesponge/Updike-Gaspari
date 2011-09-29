<?
class MediaFileComponent extends Object
{
  var $controller = true;

  // **********************************************************
  // public functions
  // **********************************************************
  function startup( &$controller )
  {
    $this->root = $controller->root;
  }

  // **********************************************************
  function uploadImageMultipleSizes( $fileInfo, $imageNum, $propertyID, $sizes ) 
  {
    foreach( $sizes as $size ) {
      $success = true;
      $savename = 'propID'.$propertyID.'-'.str_pad( $imageNum, 2, 0, STR_PAD_LEFT ).'.jpg';

      if( !$size['width'] && !$size['height'] ) {
	// no resizing required
	if( !move_uploaded_file( $fileInfo['tmp_name'], $this->root.'/images/newProperties/'.$size['directory'].'/'.$propertyID.'/'.$savename )) {
	  $success = false;
	}
      }
      else if( !$this->_writeResizedImage( $fileInfo['tmp_name'],
					   $this->root.'/images/newProperties/'.$size['directory'].'/'.$propertyID.'/'.$savename, 
					   $fileInfo['type'],
					   $size['width'],
					   $size['height'],
					   (isset( $size['square'] ) && $size['square']) )) {

	$success = false;
      }

      if( !$success ) {
	// failed remove all of the uploaded files
	foreach( $sizes as $size ) {
	  @ unlink( $this->root.'/images/newProperties/'.$size['directory'].'/'.$propertyID.'/'.$savename );
	}

	@ unlink( $fileInfo['tmp_name'] );
	return false;
      }
    }

    @ unlink( $fileInfo['tmp_name'] );

    return $filename;
  }

  // **********************************************************
  function destroyDir( $dirpath )
  {
    $mydir = opendir( $dirpath );

    while( false !== ( $file = readdir( $mydir ))) {
      if( $file != "." && $file != ".." ) {
	chmod( $dirpath.$file, 0777 );
	if( is_dir( $dirpath.$file )) {
	  chdir('.');
	  $this->destroyDir( $dirpath.$file.'/' );
	  rmdir( $dirpath.$file ) or die( "couldn't delete $dirpath$file<br /> ");
	}
	else
	  unlink( $dirpath.$file ) or die( "couldn't delete $dirpath$file<br /> ");
      }
    }

    rmdir( $dirpath ) or die( "couldn't delete $dirpath<br /> ");

    closedir( $mydir );
  }

  // **********************************************************
  function saveImageMultipleSizes( $fileinfo, $imageNum, $propertyID, $sizes )
  {
    return $this->uploadImageMultipleSizes( $fileinfo, $imageNum, $propertyID, $sizes );
  }

  // **********************************************************
  // protected functions
  // **********************************************************
  function _writeResizedImage( $imgName, $newName, $type, $width, $height, $square = false )
  {
    $size = GetImageSize( $imgName );

    if( $square ) { // calculate cropping
      $new_width = $width;
      $new_height = $height;
      
      if( $size[0] != $size[1] ) {
	if( $size[0] > $size[1] ) {
	  $halfDifference = ($size[0] - $size[1]) / 2;
	  $srcX = $halfDifference;
	  $size[0] = $size[0] - $halfDifference - $halfDifference;
	}
	else {
	  $halfDifference = ($size[1] - $size[0]) / 2;
	  $srcY = $halfDifference;
	  $size[1] = $size[1] - $halfDifference - $halfDifference;
	}
      }
    }
    else { // calculate resize
      $max_width    = !$width || $width < $size[0] ? $width : $size[0];
      $max_height   = !$height || $height < $size[1] ? $height : $size[1];
      $width_ratio  = $max_width == 0 ? 0 :  ($size[0] / $max_width);
      $height_ratio = $max_height == 0 ? 0 : ($size[1] / $max_height);
 
      if($width_ratio >=$height_ratio) {
	$ratio = $width_ratio;
      }
      else {
	$ratio = $height_ratio;
      }
 
      $new_width    = ($size[0] / $ratio);
      $new_height   = ($size[1] / $ratio);
    }

    switch( strtolower( $type )) {
      case "gif":
      case "image/gif":
	$src_img = imagecreatefromgif($imgName);
	break;

      case "png":
      case "image/png":
	$src_img = imagecreatefrompng($imgName);
	break;

      case "jpg":
      case "jpeg":
      case "image/jpg":
      case "image/jpeg":
      case "image/pjpeg":
	$src_img = imagecreatefromjpeg($imgName);
	break;

      default:
	return false;
    }

    $thumb = ImageCreateTrueColor( $new_width, $new_height );

    if( !$thumb ) {
      return false;
    }

    if( !ImageCopyResampled( $thumb, $src_img, 0, 0, isset( $srcX ) ? $srcX : 0, isset( $srcY ) ? $srcY : 0, 
			     $new_width, $new_height, $size[0], $size[1] )) {
      return false;
    }

    if( !ImageDestroy( $src_img )) {
      return false;
    }

    if( !ImageJPEG( $thumb, $newName, 100 )) {
      return false;
    }

    ImageDestroy( $thumb );
    return true;
  }
}

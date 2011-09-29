<?php
class Property extends AppModel
{
  var $name = 'Property';
  var $validate = array( 
			'address' => VALID_NOT_EMPTY
			 );

  var $validateImage = array( );

  var $filenameFields = array( 'filename' );
  var $uploadError = '';

  // **********************************************************
  // Associations
  // **********************************************************

  var $belongsTo = array( 'PropertyCategory' =>
			  array( 'className'  => 'PropertyCategory',
				 'conditions' => '',
				 'order'      => '',
				 'foreignKey' => 'category'
				 ),
			  'PropertyStatus' =>
			  array( 'className'  => 'PropertyStatus',
				 'conditions' => '',
				 'order'      => '',
				 'foreignKey' => 'status'
				 ),
			  );

  var $hasAndBelongsToMany = array( 'PropertyFlooring' =>
				    array('className'    => 'PropertyFlooring',
					  'joinTable'    => 'properties_property_floorings',
					  'foreignKey'   => 'property_id',
					  'associationForeignKey'=> 'property_flooring_id',
					  'conditions'   => '',
					  'order'        => '',
					  'limit'        => '',
					  'unique'       => true,
					  'finderQuery'  => '',
					  'deleteQuery'  => '',
					  )
				    );

  // **********************************************************
  // Model Callbacks
  // **********************************************************
  function beforeValidate() 
  {
    // choose which validation to use, property or image
    if( isset( $this->data[$this->name]['caption'] )) {
      $this->validate = $this->validateImage;

      // validate file
      foreach( $this->filenameFields as $filenameField ) {

	// check that there is a filename if this is a new item

	if( isset( $this->data[$this->name]['newImageNum'] ) && $this->data[$this->name]['newImageNum'] ) {
	  // uploading new image
	  if( !isset( $this->data[$this->name][$filenameField] ) || empty( $this->data[$this->name][$filenameField]['name'] )) {
	    $this->invalidate( $filenameField );
	    $this->uploadError = 'An image file is required.';
	    continue;
	  }
	}
	else{
	  // editing existing image
	  if( !isset( $this->data[$this->name][$filenameField] ) || empty( $this->data[$this->name][$filenameField]['name'] )) {
	    // no image to upload replacing old image
	    unset( $this->data[$this->name][$filenameField] );
	  }
	}

	if( isset( $this->data[$this->name][$filenameField] ) && !empty( $this->data[$this->name][$filenameField]['name'] )) {
	  // check if the file is an image (if type is Image) and that there are no errors
	  if( !$this->data[$this->name][$filenameField] ||
	      !strstr( $this->data[$this->name][$filenameField]['type'], 'image' ) ||
	      $this->data[$this->name][$filenameField]['error'] != '0' ) {
	    $this->invalidate( $filenameField );
	    $this->uploadError = 'Image upload failed.';
	  }
	}
      }
    }
    else {
      $this->validate = $this->validate;
    }

    if( isset( $this->data[$this->name]['sqft'] ) && !empty( $this->data[$this->name]['sqft'] )) {
      if( !preg_match( '/^\\b[0-9]*+\\b$/', $this->data[$this->name]['sqft'] )) {
	$this->invalidate( 'sqft' );
      }
    }
    if( isset( $this->data[$this->name]['lotsize'] ) && !empty( $this->data[$this->name]['lotsize'] )) {
      if( !preg_match( '/^\\b[0-9]*+\\b$/', $this->data[$this->name]['lotsize'] )) {
	$this->invalidate( 'lotsize' );
      }
    }
    if( isset( $this->data[$this->name]['taxes'] ) && !empty( $this->data[$this->name]['taxes'] )) {
      if( !preg_match( '/^\\b[0-9]*+\\b$/', $this->data[$this->name]['taxes'] )) {
	$this->invalidate( 'taxes' );
      }
    }
    if( isset( $this->data[$this->name]['hodues'] ) && !empty( $this->data[$this->name]['hodues'] )) {
      if( !preg_match( '/^\\b[0-9]*+\\b$/', $this->data[$this->name]['hodues'] )) {
	$this->invalidate( 'hodues' );
      }
    }
    if( isset( $this->data[$this->name]['fireplace'] ) && !empty( $this->data[$this->name]['fireplace'] )) {
      if( !preg_match( '/^\\b[0-9]*+\\b$/', $this->data[$this->name]['fireplace'] )) {
	$this->invalidate( 'fireplace' );
      }
    }
    if( isset( $this->data[$this->name]['bath'] ) && !empty( $this->data[$this->name]['bath'] )) {
      if( !preg_match( VALID_NUMBER, $this->data[$this->name]['bath'] )) {
	$this->invalidate( 'bath' );
      }
    }
    if( isset( $this->data[$this->name]['bed'] ) && !empty( $this->data[$this->name]['bed'] )) {
      if( !preg_match( VALID_NUMBER, $this->data[$this->name]['bed'] )) {
	$this->invalidate( 'bed' );
      }
    }
    if( isset( $this->data[$this->name]['yrbuilt'] ) && !empty( $this->data[$this->name]['yrbuilt'] )) {
      if( $this->data[$this->name]['yrbuilt'] < 1800 || $this->data[$this->name]['yrbuilt'] > 2500 ) {
	$this->invalidate( 'yrbuilt' );
      }
    }

    return true;
  }

  // **********************************************************
  function beforeSave() 
  {
    if( isset( $this->data[$this->name]['mls'] ) && empty( $this->data[$this->name]['mls'] )) {
      $this->data[$this->name]['mls'] = null;
    }

    if( isset( $this->data[$this->name]['category'] ) && $this->data[$this->name]['category'] == '0' ) {
      $this->data[$this->name]['category'] = null;
    }

    if( isset( $this->data[$this->name]['status'] ) && $this->data[$this->name]['status'] == '0' ) {
      $this->data[$this->name]['status'] = null;
    }

    if( isset( $this->data[$this->name]['price'] ) && empty( $this->data[$this->name]['price'] )) {
      $this->data[$this->name]['price'] = null;
    }

    if( isset( $this->data[$this->name]['sqft'] ) && empty( $this->data[$this->name]['sqft'] )) {
      $this->data[$this->name]['sqft'] = null;
    }

    if( isset( $this->data[$this->name]['lotsize'] ) && empty( $this->data[$this->name]['lotsize'] )) {
      $this->data[$this->name]['lotsize'] = null;
    }

    if( isset( $this->data[$this->name]['taxes'] ) && empty( $this->data[$this->name]['taxes'] )) {
      $this->data[$this->name]['taxes'] = null;
    }

    if( isset( $this->data[$this->name]['hodues'] ) && empty( $this->data[$this->name]['hodues'] )) {
      $this->data[$this->name]['hodues'] = null;
    }

    if( isset( $this->data[$this->name]['yrbuilt'] ) && empty( $this->data[$this->name]['yrbuilt'] )) {
      $this->data[$this->name]['yrbuilt'] = null;
    }

    if( isset( $this->data[$this->name]['date_sold'] ) && empty( $this->data[$this->name]['date_sold'] )) {
      $this->data[$this->name]['date_sold'] = null;
    }

    if( isset( $this->data[$this->name]['caption'] )) {
      unset( $this->data[$this->name]['caption'] );
      if( isset( $this->data[$this->name]['imageNum'] )) {
	unset( $this->data[$this->name]['imageNum'] );
      }
      if( isset( $this->data[$this->name]['newImageNum'] )) {
	unset( $this->data[$this->name]['newImageNum'] );
      }
    }

    return true;
  }
}
?>

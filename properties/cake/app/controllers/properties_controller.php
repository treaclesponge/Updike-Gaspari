<?php
class PropertiesController extends AppController
{
  var $layout = 'admin';
  var $uses = array( 'Property', 'PropertyCategory', 'PropertyStatus', 'PropertyFlooring' );
  var $components = array( 'MediaFile' );
  var $pageTitle = 'List Properties - Updike Gaspari Admin';
  var $batchSize = 20;
  var $imageSize = 16;
  var $curBatch = '1';
  var $sortOrder = 'desc';
  var $sortBy = 'date_added';
  var $additional1 = '0';

  var $propertyImageSizes = array( 'thumb' => array( 'width' => 100, 'height' => 100, 'square' => true, 'directory' => 'thumb' ),
				   'main' => array( 'width' => 675, 'height' => 506, 'square' => false, 'directory' => 'main' )
				   );

  var $listingRepView = array ( 'all' => 'All', 'buyer' => 'Represented Buyers', 'seller' => 'Represented Sellers' );

  var $listingSortFilter = array( 'desc/date_added' => 'Newest property first',
				  'asc/date_added' => 'Oldest property first',
				  'asc/price' => 'Lowest price first',
				  'desc/price' => 'Highest price first',
				  'asc/neighborhood' => 'Neighborhood (A-Z)',
				  'desc/neighborhood' => 'Neighborhood (Z-A)' );

  // **********************************************************
  // View functions
  // **********************************************************
  function admin_add( $id = '0' )
  {
    // check if user is properly logged in
    $this->checkSession();

    if( !ctype_digit( $id ) || $id < 0 ) {
      $this->redirect( '/admin/properties' );
      return;
    }

    // get items for category select box
    $categories = $this->PropertyCategory->generateList( '', 'PropertyCategory.name ASC', null, '{n}.PropertyCategory.name', '{n}.PropertyCategory.id' );
    $this->set( 'categories', array_flip( array_merge( array( '-- please select category --' => '0' ), $categories )));

    // get items for status select box
    $statuses = $this->PropertyStatus->generateList( '', 'PropertyStatus.name ASC', null, '{n}.PropertyStatus.name', '{n}.PropertyStatus.id' );
    $this->set( 'statuses', array_flip( array_merge( array( '-- please select status --' => '0' ), $statuses )));

    // get floorings
    $this->set( 'floorings', $this->PropertyFlooring->generateList( '', 'PropertyFlooring.name ASC', null, '{n}.PropertyFlooring.id', '{n}.PropertyFlooring.name' ));

    if( $id ) {
      $this->pageTitle = 'Edit property - Updike Gaspari Admin';
    }
    else{
      $this->pageTitle = 'Add new property - Updike Gaspari Admin';
    }

    if( empty( $this->data )) {

      if( $id != 0 ) { // retrieve property
	$this->data = $this->Property->find( 'Property.id = '.$id );
      }
    }
    else { // data posted
      // set property floorings to blank if not set so that HABTM relationships are erased
      if( !isset( $this->data['PropertyFlooring'] )) {
	$this->data['PropertyFlooring']['PropertyFlooring'] = array();
      }

      if( !$id ) {
	$this->data['Property']['date_added'] = date( 'Y-m-d', time());
      }

      // try to save new information to database
      if( !$this->Property->save( $this->data )) {
	$this->set( 'errorMessage', 'Failed to save details.' );
      }
      else { // save succeeded

	// create image folders for new property
	if( !$id ) {
	  $lastInsertId = $this->Property->getLastInsertId();
	  mkdir( $this->root.'images/newProperties/main/'.$lastInsertId );
	  mkdir( $this->root.'images/newProperties/thumb/'.$lastInsertId );
	}

	// set success message
	$this->Session->write( 'message', 'Saved property details successfully' );

	// if the user pressed save then send them back to the index page
	if( isset( $this->data['Form']['save'] )) {
	  if( $id ) {
	    $this->redirect( $this->_buildListingRedirectionURL( ));
	  }
	  else{
	    $this->redirect( '/admin/properties/listing' );
	  }
	  return;
	}
      }
    }

    $this->set( 'selectedPropertyFloorings', $this->selectedItems( 'PropertyFlooring', $this->data ));
    $this->_setListingVars();
  }

  // **********************************************************
  function admin_listing( $curBatch = '1', $sortOrder = 'desc', $sortBy = 'id', $fullview = '0' )
  {
    // check if user is properly logged in
    $this->checkSession();

    // check parameters
    if( !ctype_digit( $curBatch ) || $curBatch <= 0) {
      $curBatch = 1;
    }

    if( $sortOrder != 'asc' && $sortOrder != 'desc' ) {
      $sortOrder = 'desc';
    }

    if( $fullview != '0' && $fullview != '1' ) {
      $fullview = '0';
    }

    $this->_writeListingSession( $curBatch, $sortOrder, $sortBy, $fullview );
    $this->_setListingVars();

    // determine batch parameters
    $numItems = $this->Property->findCount( );
    $this->_setBatchParameters( $curBatch, $this->batchSize, $numItems );

    $properties = $this->Property->findAll( '', '', 'Property.'.$sortBy.' '.$sortOrder, $this->batchSize, $curBatch );

    for( $i=0; $i<count($properties); $i++ ) {
      $properties[$i]['imageNum'] = count( $this->_getPropertyImageNums( $properties[$i]['Property']['id'] ));
    }

    $this->set( 'properties', $properties );
  }

  // **********************************************************
  function admin_index( )
  {
    $this->redirect( '/admin/properties/listing' );
    return;
  }

  // **********************************************************
  function admin_imageDelete( $propertyID, $imageNum = '' )
  {
    // check if user is properly logged in
    $this->checkSession();

    // check that propertyID is valid
    if( !$property = $this->Property->find( 'Property.id = '.$propertyID )) {
      $this->redirect( '/admin/properties' );
      return;
    }

    if( !ctype_digit( $imageNum ) || $imageNum <= 0 ) {
      $this->redirect( '/admin/properties' );
      return;
    }

    // clear image caption
    $this->Property->id = $propertyID;
    $this->Property->saveField( 'caption'.$imageNum, '' );

    // remove image
    $savename = 'propID'.$propertyID.'-'.str_pad( $imageNum, 2, 0, STR_PAD_LEFT ).'.jpg';
    unlink( $this->root.'/images/newProperties/thumb/'.$propertyID.'/'.$savename );
    unlink( $this->root.'/images/newProperties/main/'.$propertyID.'/'.$savename );

    if( !$this->_getPropertyImageNums( $propertyID )) {
      $this->redirect( $this->_buildListingRedirectionURL( ));
      return;
    }

    $this->redirect( '/admin/properties/imageListing/'.$propertyID );
    return;
  }

  // **********************************************************
  function admin_imageListing( $propertyID )
  {
    // check if user is properly logged in
    $this->checkSession();

    $this->pageTitle = 'Property image management - Updike Gaspari Admin';

    // check that propertyID is valid
    $property = $this->Property->find( 'Property.id = '.$propertyID );

    if( empty( $property )) {
      $this->redirect( '/admin/properties' );
      return;
    }

    if( !$imageNums = $this->_getPropertyImageNums( $propertyID )) {
      $this->redirect( '/admin/properties/imageAdd/'.$propertyID );
      return;
    }

    $this->set( 'imageNums', $imageNums );
    $this->set( 'property', $property );
    $this->_setListingVars();
  }

  // **********************************************************
  function admin_imageAdd( $propertyID, $imageNum = '' )
  {
    // check if user is properly logged in
    $this->checkSession();

    // check that propertyID is valid
    if( !$property = $this->Property->find( 'Property.id = '.$propertyID )) {
      $this->redirect( '/admin/properties' );
      return;
    }

    if( !empty( $imageNum )) {

      $this->pageTitle = 'Edit image - Updike Gaspari Admin';

      if( $imageNum < 1 || $imageNum > $this->imageSize ) {
	$this->redirect( '/admin/properties' );
	return;
      }
      else{
	if( !file_exists( $this->root.'images/newProperties/main/'.$propertyID.'/propID'.$propertyID.'-'.( str_pad( $imageNum, 2, 0, STR_PAD_LEFT )).'.jpg' ) ||
	    !file_exists( $this->root.'images/newProperties/thumb/'.$propertyID.'/propID'.$propertyID.'-'.( str_pad( $imageNum, 2, 0, STR_PAD_LEFT )).'.jpg' )) {
	$this->redirect( '/admin/properties' );
	return;
	}
      }
    }
    else{

      $this->pageTitle = 'Add new image - Updike Gaspari Admin';
    }

    if( empty( $this->data )) {

      // retrieve property information
      $this->data = $this->Property->find( 'Property.id = '.$propertyID );

      if( $imageNum ) { // editing
	$this->data['Property']['caption'] = $this->data['Property']['caption'.$imageNum];
	$this->data['Property']['imageNum'] = $imageNum;
      }
      else{
	$this->data['Property']['caption'] = '';
	if( !$this->data['Property']['newImageNum'] = $this->_findNextImageNum( $propertyID )) {
	  $this->redirect( '/admin/properties/imageListing/'.$propertyID );
	  return;
	}
      }
    }
    else { // data posted

      // pull out image file information
      if( $this->data['Property']['filename']['size'] > 0 ) {
	$imageFileInfo = $this->data['Property']['filename'];
      }

      if( $imageNum ) {
	$this->data['Property']['caption'.$this->data['Property']['imageNum']] = $this->data['Property']['caption'];
	$lastInsertImageNum = $this->data['Property']['imageNum'];
      }
      else{
	$this->data['Property']['caption'.$this->data['Property']['newImageNum']] = $this->data['Property']['caption'];
	$lastInsertImageNum = $this->data['Property']['newImageNum'];
      }

      // try to save new information to database
      if( !$this->Property->save( $this->data )) {
	$this->set( 'errorMessage', 'Failed to save details.' );
	$this->set( 'uploadError', $this->Media->uploadError );
      }
      else { // save succeeded
	$lastInsertId = $this->Property->getLastInsertId();

	if( $lastInsertId ) {
	  $this->data['Property']['id'] = $lastInsertId;
	}

	// set success message
	$this->Session->write( 'message', 'Saved image details successfully' );

	// save image if one was uploaded
	if( isset( $imageFileInfo )) {
	  $this->MediaFile->saveImageMultipleSizes( $imageFileInfo, $lastInsertImageNum, $this->data['Property']['id'], $this->propertyImageSizes );
	}

	// if the user pressed save then send them back to the image listing page
	if( isset( $this->data['Form']['save'] )) {
	  $this->redirect( '/admin/properties/imageListing/'.$propertyID );
	  return;
	}
      }
    }

    $property = $this->Property->find( 'Property.id = '.$propertyID );
    $property['imageNum'] = count( $this->_getPropertyImageNums( $propertyID ));
    $this->set( 'property', $property );
  }

  // **********************************************************
  function index( $sold = 0, $curBatch = '1', $sortOrder = 'desc', $sortBy = 'date_added', $typeFilter = 'house', $repFilter = 'all' )
  {
    $this->layout = 'public';
    $this->batchSize = 6;
    $this->bodyID = ( !$sold ? 'sectionIDcurrent' : 'sectionIDsold'.$typeFilter );

    // check parameters
    if( !ctype_digit( $curBatch ) || $curBatch <= 0) {
      $curBatch = 1;
    }
    if( $sortOrder != 'desc' && $sortOrder != 'asc'  ) {
      $sortOrder = 'desc';
    }

    if( $sold == -1 ) {
      $this->redirect( '/current' );
      return;
    }

    switch( $repFilter ) {
      case 'buyer':
	$filterSql = " AND Property.rep_buyer = 1";
	break;

      case 'seller':
	$filterSql = " AND Property.rep_seller = 1";

	break;

      case 'all':
      default:
	$repFilter = 'all';
	$filterSql = "";
    }

    $filerSqlType = '';
    $selectedCategory = '';

    if( $sold ) {
      if( !$propertyCat = $this->PropertyCategory->field( "PropertyCategory.id", "PropertyCategory.name = '".$typeFilter."'" )) {
	$typeFilter = 'house';
	$propertyCat = $this->PropertyCategory->field( "PropertyCategory.id", "PropertyCategory.name = '".$typeFilter."'" );
      }
      $filterSqlType = " AND Property.category = ".$propertyCat;
      $selectedCategory = $this->PropertyCategory->field( "PropertyCategory.title", "PropertyCategory.name = '".$typeFilter."'" );
    }

    $conditions = ( $sold ? 'Property.status = 2' : 'Property.status = 1').' AND Property.display = 1'.$filterSql.$filterSqlType;

    if( $curBatch == 0 ) {
      // get all properties
      $properties = $this->Property->findAll( $conditions, '', $sortBy.' '.$sortOrder );
    }
    else {
      // setup pagination
      $numItems = $this->Property->findCount( $conditions );
      $this->_setBatchParameters( $curBatch, $this->batchSize, $numItems );    
      $properties = $this->Property->findAll( $conditions, '', $sortBy.' '.$sortOrder, $this->batchSize, $curBatch );
    }

    for( $i=0; $i<count($properties); $i++ ) {
      if( $imageNums = $this->_getPropertyImageNums( $properties[$i]['Property']['id'] )) {
	$properties[$i]['imageNum'] = $imageNums[0];
      }
    }

    $this->set( 'properties', $properties );
    $this->set( 'sold', $sold );
    $this->set( 'pageHeader', ( $sold ? 'Properties Sold: '.ucfirst($selectedCategory) : 'Our Current Listings' ));
    $this->set( 'targetPrefix', ( $sold ? '/properties/sold/' : '/properties/current/' ));
    $this->set( 'listingRepView', $this->listingRepView );
    $this->set( 'listingSortFilter', $this->listingSortFilter );
    $this->set( 'typeFilter', $typeFilter );
    $this->set( 'sortOrder', $sortOrder );
    $this->set( 'sortField', $sortBy );
    $this->set( 'selectedCategory', $selectedCategory );
    $this->set( 'propertyCategories', $this->PropertyCategory->findAll( '', '', 'PropertyCategory.order_no ASC' ));
    $this->data['Listing']['rep_view'] = $repFilter;
    $this->data['Listing']['sort_filter'] = $sortOrder.'/'.$sortBy;

    $this->pageTitle = 'David Updike and Kevin Gaspari | '.( $sold ? 'Properties Sold | '.ucfirst($pageHeaderType) : 'Our Current Listings' );
  }

  // **********************************************************
  function detail( $id )
  {
    $this->layout = 'public';
    $this->bodyID = 'pageIDproperties';

    // check args
    if( !ctype_digit( $id ) || $id <= 0 ) {
      $this->redirect( '/properties' );
      return;
    }

    if( !$property = $this->Property->find( 'Property.id = '.$id, null, null )) {
      $this->redirect( '/properties' );
      return;
    }

    $this->pageTitle = 'David Updike &amp; Kevin Gaspari | Property '.$property['Property']['id'].' | '.$property['Property']['descriptor'].( $property['Property']['mls'] ?  ' : MLS: '.$property['Property']['mls'] : '');

    $imageNums = $this->_getRandomPropertyImageNums( $id );

    $property['imageNums'] = $imageNums;
    $this->set( 'property', $property );
    $this->set( 'propertyCategories', $this->PropertyCategory->findAll( '', '', 'PropertyCategory.order_no ASC' ));
    $this->set( 'targetPrefix', '/properties/sold/' );
  }

  // **********************************************************
  // protected functions
  // **********************************************************
  function _writeListingSession( $curBatch, $sortOrder, $sortBy, $additional1 )
  {
    $this->Session->write( 'curBatch', $curBatch );
    $this->Session->write( 'sortOrder', $sortOrder );
    $this->Session->write( 'sortBy', $sortBy );
    $this->Session->write( 'additional1', $additional1 );
  }

  // **********************************************************
  function _readListingSession( )
  {
    $this->curBatch = $this->Session->read( 'curBatch' );
    $this->sortOrder = $this->Session->read( 'sortOrder' );
    $this->sortBy = $this->Session->read( 'sortBy' );
    $this->additional1 = $this->Session->read( 'additional1' );
  }

  // **********************************************************
  function _setListingVars( )
  {
    $this->set( 'curBatch', $this->Session->read( 'curBatch' ));
    $this->set( 'sortOrder', $this->Session->read( 'sortOrder' ));
    $this->set( 'sortBy', $this->Session->read( 'sortBy' ));
    $this->set( 'additional1', $this->Session->read( 'additional1' ));
  }

  // **********************************************************
  function _buildListingRedirectionURL( )
  {
    $this->_readListingSession();
    return '/admin/properties/listing'.
      ( $this->curBatch ? '/'.$this->curBatch.
	( $this->sortOrder ? '/'.$this->sortOrder.
	  ( $this->sortBy ? '/'.$this->sortBy.
	    ( $this->additional1 ? '/'.$this->additional1 : '' )
	    : '' )
	  : '' )
	: '' );
  }


  // **********************************************************
  function _getPropertyImageNums( $propertyID )
  {
    $imageArr = array();

    if( !$imagedir = @opendir( $this->root.'images/newProperties/thumb/'.$propertyID )) {
      return $imageArr;
    }

    $i = 0;
    while( false !== ( $file = readdir( $imagedir ))) {
      if( $file != "." && $file != ".." ) {
	$i++;
	if( $i > $this->imageSize ) {
	  break;
	}
	$fileArr = explode( '-', $file );
	$fileArr = explode( '.', $fileArr[1] );
	array_push( $imageArr, ltrim( $fileArr[0], '0' ));
      }
    }

    return $imageArr;
  }

  // **********************************************************
  function _getRandomPropertyImageNum( $propertyID )
  {
    if( !$imageNums = $this->_getPropertyImageNums( $propertyID )) {
      return 0;
    }

    return $imageNums[array_rand( $imageNums )];
  }

  // **********************************************************
  function _getRandomPropertyImageNums( $propertyID )
  {
    $imageNums = $this->_getPropertyImageNums( $propertyID );
    $imageDif = $this->imageSize - count($imageNums);
    for( $i=0; $i<$imageDif; $i++ ) {
      array_push( $imageNums, -$i );
    }

    shuffle( $imageNums );

    return $imageNums;
  }

  // **********************************************************
  function _findNextImageNum( $propertyID )
  {
    if( !$imagedir = opendir( $this->root.'images/newProperties/thumb/'.$propertyID )) {
      return false;
    }

    $imageNums = array();

    for( $i=1; $i<=$this->imageSize; $i++ ) {
      $imageNums[$i] = $i;
    }

    while( false !== ( $file = readdir( $imagedir ))) {
      if( $file != "." && $file != ".." ) {
	$fileArr = explode( '-', $file );
	$fileArr = explode( '.', $fileArr[1] );
	$imageNum = ltrim( $fileArr[0], '0' );

	$imageNums = array_diff( $imageNums, array( $imageNum ));
      }
    }

    return  array_pop( array_reverse( $imageNums ));
  }
}

<?php
class AppController extends Controller
{  
  // layout variables
  var $bodyID = '';
  var $bodyClass = '';
  var $bodyOnLoad = '';
  var $root = '/mnt/webhosting/sites/u/updikegaspari.com/';

  // **********************************************************
  // Protected functions
  // *****************************************************************
  function _setBatchParameters( $curBatch, $batchSize, $numItems )
  {
    // return if there are no results
    if( !$numItems ) {
      $this->set( 'numItems', 0 );
      $this->set( 'batchSize', 0 );	    
      $this->set( 'numBatches', 0 );	    
      $this->set( 'curBatch', 1 );
      $this->set( 'batchStart', 0 );
      $this->set( 'batchEnd', 0 );
      return;
    }

    // determine batch parameters
    $this->set( 'numItems', $numItems );
    $this->set( 'batchSize', $batchSize );	    

    $numBatches = ceil( $numItems / $batchSize );
    $this->set( 'numBatches', $numBatches );	    

    if( $curBatch < 1 || $curBatch > $numBatches ) {
      $curBatch = 1;
    }

    $batchStart = ($curBatch - 1) * $batchSize + 1;
    $batchEnd = $batchStart + $batchSize - 1;

    $this->set( 'batchStart', $batchStart );    
    $this->set( 'batchEnd', $batchEnd > $numItems ? $numItems : $batchEnd );    
    $this->set( 'curBatch', $curBatch );    
  }

  // *****************************************************************
  function _clearHABTMs( $habtmModels )
  {
    // set habtm data to blank array if !isset so that HABTM relationships are erased
    foreach( $habtmModels as $habtmModel ) {
      if( !isset( $this->data[$habtmModel] )) {
	$this->data[$habtmModel][$habtmModel] = array();
      }
    }
  }

  // **********************************************************
  // callbacks
  // *****************************************************************
  function checkSession()
  {
    // If the session info hasn't been set...
    if( !$this->Session->check( 'User' )) {
      // Force the user to login
      $this->redirect( '/admin/users/login' );
    }
  }

  // **********************************************************
  function beforeFilter()
  {
    error_reporting(E_ALL ^ E_NOTICE);
  }

  // **********************************************************
  function beforeRender()
  {
    // setup layout variables
    $this->set( 'body_id_for_layout', $this->bodyID ? $this->bodyID : (isset( $this->viewVars['page'] ) ? $this->viewVars['page'] : '' ));
    $this->set( 'body_class_for_layout', $this->bodyClass );
    $this->set( 'body_onload_for_layout', $this->bodyOnLoad );

    if( $this->Session->check( 'User' )) {
      $user = $this->Session->read( 'User' );
      $this->set( 'firstname', $user['firstname'] );
      $this->set( 'lastname', $user['lastname'] );
    }

    // media image prefixes
    $this->set( 'media_thumb_prefix_for_layout', '90x90_' );
    $this->set( 'media_medium_landscape_prefix_for_layout', '225x0_' );
    $this->set( 'media_main_landscape_prefix_for_layout', '427x0_' );
    $this->set( 'media_medium_portrait_prefix_for_layout', '200x0_' );
    $this->set( 'media_main_portrait_prefix_for_layout', '285x0_' );

    // get message from session
    if( $this->Session->check( 'message' )) {
      $this->set( 'message', $this->Session->read( 'message' ));
      $this->Session->del( 'message' );
    }
  }

  // **********************************************************
  // helper functions
  // *****************************************************************
  function selectedItems( $modelName, $data )
  {
    if( isset( $this->data[$modelName][$modelName] )) {
      return $this->data[$modelName][$modelName];
    }

    $selectedItems = array();

    if( isset( $this->data[$modelName] )) {
      foreach( $this->data[$modelName] as $item ) {
	if( isset( $item['id'] )) {
	  array_push( $selectedItems, $item['id'] );
	}
      }
    }

    return $selectedItems;
  }
}
?>

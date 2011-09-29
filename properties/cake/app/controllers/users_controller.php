<?php
class UsersController extends AppController
{
  var $layout = 'admin';
  var $pageTitle = 'David Upike and Kevin Gaspari - Admin Area';
  var $uses = array( 'User' );
  var $bodyID = 'admin';
  var $bodyOnLoad = 'swapPic()';

  // **********************************************************
  function admin_login()
  {
    $this->layout = 'public';

    //Don't show the error message if no data has been submitted.
    $this->set( 'error', false );

    // If a user has submitted form data:
    if( !empty( $this->data ))
    {
      // First, let's see if there are any users in the database
      // with the username supplied by the user using the form:
      $someone = $this->User->findByUsername( $this->data['User']['username'] );

      // At this point, $someone is full of user data, or its empty.
      // Let's compare the form-submitted password with the one in
      // the database.

      if( !empty($someone['User']['password']) && $someone['User']['password'] == $this->data['User']['password'] )
      {
	// Note: hopefully your password in the DB is hashed,
	// so your comparison might look more like:
	// md5($this->data['User']['password']) == ...
	
	// This means they were the same. We can now build some basic
	// session information to remember this user as 'logged-in'.
	$this->Session->write( 'User', $someone['User'] );

	// Now that we have them stored in a session, forward them on
	// to a landing page for the application.
	$this->redirect( '/admin/properties/listing' );
      }
      // Else, they supplied incorrect data:
      else
      {
	// Remember the $error var in the view? Let's set that to true:
	$this->set( 'error', true );
      }
    }
  }

  // **********************************************************
  function admin_logout()
  {
    // Redirect users to this action if they click on a Logout button.
    // All we need to do here is trash the session information:
    $this->Session->delete('User');
    
    // And we should probably forward them somewhere, too...
    $this->redirect('/admin/users/login');
  }

  // **********************************************************
  function admin_index()
  {
    $this->redirect( '/admin/properties/listing' );
  }

  // **********************************************************
  function index()
  {
    $this->redirect( '/admin/properties/listing' );
  }
}
?>

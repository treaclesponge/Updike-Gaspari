<?php
/* SVN FILE: $Id: routes.php 6305 2008-01-02 02:33:56Z phpnut $ */
/**
 * Short description for file.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.app.config
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 6305 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2008-01-01 20:33:56 -0600 (Tue, 01 Jan 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.thtml)...
 */
  //	$Route->connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
  //	$Route->connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

$Route->connect( '/sold/*', array( 'controller' => 'properties', 'action' => 'index', '1' ));
$Route->connect( '/current/*', array( 'controller' => 'properties', 'action' => 'index', '0' ));
$Route->connect( '/detail/*', array( 'controller' => 'properties', 'action' => 'detail' ));
$Route->connect( '/', array( 'controller' => 'properties', 'action' => 'index', '-1' ));

$Route->connect( '/admin/', array( 'controller' => 'users', 'action' => 'index' ));

?>

<?php
/* SVN FILE: $Id: class_registry.php 6305 2008-01-02 02:33:56Z phpnut $ */
/**
 * Class collections.
 *
 * A repository for class objects, each registered with a key.
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
 * @subpackage		cake.cake.libs
 * @since			CakePHP(tm) v 0.9.2
 * @version			$Revision: 6305 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2008-01-01 20:33:56 -0600 (Tue, 01 Jan 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Class Collections.
 *
 * A repository for class objects, each registered with a key.
 * If you try to add an object with the same key twice, nothing will come of it.
 * If you need a second instance of an object, give it another key.
 *
 * @package		cake
 * @subpackage	cake.cake.libs
 */
class ClassRegistry{
/**
 * Names of classes with their objects.
 *
 * @var array
 * @access private
 */
	var $_objects = array();
/**
 * Return a singleton instance of the ClassRegistry.
 *
 * @return ClassRegistry instance
 */
	function &getInstance() {
		static $instance = array();
		if (!$instance) {
			$instance[0] = &new ClassRegistry;
		}
		return $instance[0];
	}
/**
 * Add $object to the registry, associating it with the name $key.
 *
 * @param string $key
 * @param mixed $object
 */
	function addObject($key, &$object) {
		$_this =& ClassRegistry::getInstance();
		$key = strtolower($key);
		if (array_key_exists($key, $_this->_objects) === false) {
			$_this->_objects[$key] = &$object;
		}
	}
/**
 * Remove object which corresponds to given key.
 *
 * @param string $key
 * @return void
 */
	function removeObject($key) {
		$_this =& ClassRegistry::getInstance();
		$key = strtolower($key);
		if (array_key_exists($key, $_this->_objects) === true) {
			unset($_this->_objects[$key]);
		}
	}
/**
 * Returns true if given key is present in the ClassRegistry.
 *
 * @param string $key Key to look for
 * @return boolean Success
 */
	function isKeySet($key) {
		$_this =& ClassRegistry::getInstance();
		$key = strtolower($key);
		return array_key_exists($key, $_this->_objects);
	}
/**
 * Get all keys from the regisrty.
 *
 * @return array
 */
	function keys() {
		$_this =& ClassRegistry::getInstance();
		return array_keys($_this->_objects);
	}
/**
 * Return object which corresponds to given key.
 *
 * @param string $key
 * @return mixed
 */
	function &getObject($key) {
		$_this =& ClassRegistry::getInstance();
		$key = strtolower($key);
		return $_this->_objects[$key];
	}
}
?>
<?php
/* SVN FILE: $Id: cake_log.php 6305 2008-01-02 02:33:56Z phpnut $ */
/**
 * Logging.
 *
 * Log messages to text files.
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
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 6305 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2008-01-01 20:33:56 -0600 (Tue, 01 Jan 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Included libraries.
 *
 */
	if (!class_exists('File')) {
		uses('file');
	}
/**
 * Logs messages to text files
 *
 * @package		cake
 * @subpackage	cake.cake.libs
 */
class CakeLog{
/**
 * Writes given message to a log file in the logs directory.
 *
 * @param string $type Type of log, becomes part of the log's filename
 * @param string $msg  Message to log
 * @return boolean Success
 */
	function write($type, $msg) {
		$filename = LOGS . $type . '.log';
		$output = date('Y-m-d H:i:s') . ' ' . ucfirst($type) . ': ' . $msg . "\n";
		$log = new File($filename);
		return $log->append($output);
	}
}
?>
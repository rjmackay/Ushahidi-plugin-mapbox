<?php
/**
 * Performs install/uninstall methods for the Mapbox plugin
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi - http://source.ushahididev.com
 * @module	   Actionable Installer
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */

class Mapbox_Install {

	/**
	 * Constructor to load the shared database library
	 */
	public function __construct()
	{
		$this->db = Database::instance();
	}

	/**
	 * Creates the required database tables for the Mapbox plugin
	 */
	public function run_install()
	{
		// Create the database tables.
		// Also include table_prefix in name
		$this->db->query('CREATE TABLE `'.Kohana::config('database.default.table_prefix').'mapbox` (
			  `id` int(11) unsigned NOT NULL,
			  `mapbox_access_token` varchar(255) DEFAULT NULL,
			  `mapbox_map_id` varchar(255) DEFAULT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
	}

	/**
	 * Deletes the database tables for the Mapbox module
	 */
	public function uninstall()
	{
		$this->db->query('DROP TABLE `'.Kohana::config('database.default.table_prefix').'mapbox`;');
	}

}
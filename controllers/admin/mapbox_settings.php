<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Mapbox Settings Controller
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi - http://source.ushahididev.com
 * @module	   Clickatell Settings Controller
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
*
*/

class Mapbox_Settings_Controller extends Admin_Controller {
	public function index()
	{
		$this->template->this_page = 'addons';

		// Standard Settings View
		$this->template->content = new View("admin/addons/plugin_settings");
		$this->template->content->title = "Mapbox Settings";

		// Settings Form View
		$this->template->content->settings_form = new View("mapbox/admin/mapbox_settings");

		// Do we have a frontlineSMS Key? If not create and save one on the fly
		$mapbox = ORM::factory('mapbox', 1);

		// Get current settings.
		if (!$mapbox->loaded) {
			// We don't have a settings row for this, so create a blank one.
			$mapbox->id = 1;
			$mapbox->save();
		}

		if ($_POST) {
			// Instantiate Validation, use $post, so we don't overwrite $_POST
			// fields with our own things
			$post = new Validation($_POST);

			// Add some filters
			$post->pre_filter('trim', TRUE);

			$post->add_rules('mapbox_access_token', 'required');
			$post->add_rules('mapbox_map_id','required');

			if ($post->validate()) {
				$mapbox->mapbox_access_token = $post->mapbox_access_token;
				$mapbox->mapbox_map_id       = $post->mapbox_map_id;
				$mapbox->save();
			}
		}

		$this->template->content->settings_form->mapbox_access_token = $mapbox->mapbox_access_token;
		$this->template->content->settings_form->mapbox_map_id       = $mapbox->mapbox_map_id;
	}
}
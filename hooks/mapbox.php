<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Mapbox Hook - Load All Events
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com> 
 * @package	   Ushahidi - http://source.ushahididev.com
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license	   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 */

class mapbox {
	
	private $layers;
	
	/**
	 * Registers the main event add method
	 */
	public function __construct()
	{		
		// Hook into routing
		Event::add('system.pre_controller', array($this, 'add'));
	}
	
	/**
	 * Adds all the events to the main Ushahidi application
	 */
	public function add()
	{
		Event::add('ushahidi_filter.map_base_layers', array($this, '_add_layer'));
		if (Router::$controller != 'settings')
		{
			Event::add('ushahidi_filter.map_layers_js', array($this, '_add_map_layers_js'));
		}
	}
	
	public function _add_layer()
	{
		$this->layers = Event::$data;
		$this->layers = $this->_create_layer();
		
		// Return layers object with new Cloudmade Layer
		Event::$data = $this->layers;
	}
	
	public function _create_layer()
	{

		// MapBoxStreets
		$layer = new stdClass();
		$layer->active = TRUE;
		$layer->name = 'mapbox_streets';
		$layer->openlayers = "XYZ";
		$layer->title = 'Mapbox Streets';
		$layer->description = '.';
		$layer->api_url = '';
		$layer->data = array(
			'baselayer' => TRUE,
			'attribution' => '',
			'url' => 'http://a.tiles.mapbox.com/v3/mapbox.mapbox-streets/${z}/${x}/${y}.png',
			'type' => ''
		);
		$this->layers[$layer->name] = $layer;

		// MapBoxStreets - Lacquer
		$layer = new stdClass();
		$layer->active = TRUE;
		$layer->name = 'mapbox_lacquer';
		$layer->openlayers = "XYZ";
		$layer->title = 'Mapbox Lacquer';
		$layer->description = '.';
		$layer->api_url = '';
		$layer->data = array(
			'baselayer' => TRUE,
			'attribution' => '',
			'url' => 'http://a.tiles.mapbox.com/v3/mapbox.mapbox-lacquer/${z}/${x}/${y}.png',
			'type' => ''
		);
		$this->layers[$layer->name] = $layer;

		// MapBoxStreets - Light
		$layer = new stdClass();
		$layer->active = TRUE;
		$layer->name = 'mapbox_light';
		$layer->openlayers = "XYZ";
		$layer->title = 'Mapbox Light';
		$layer->description = '.';
		$layer->api_url = '';
		$layer->data = array(
			'baselayer' => TRUE,
			'attribution' => '',
			'url' => 'http://a.tiles.mapbox.com/v3/mapbox.mapbox-light/${z}/${x}/${y}.png',
			'type' => ''
		);
		$this->layers[$layer->name] = $layer;

		// MapBoxStreets - Simple
		$layer = new stdClass();
		$layer->active = TRUE;
		$layer->name = 'mapbox_simple';
		$layer->openlayers = "XYZ";
		$layer->title = 'Mapbox Simple';
		$layer->description = '.';
		$layer->api_url = '';
		$layer->data = array(
			'baselayer' => TRUE,
			'attribution' => '',
			'url' => 'http://a.tiles.mapbox.com/v3/mapbox.mapbox-simple/${z}/${x}/${y}.png',
			'type' => ''
		);
		$this->layers[$layer->name] = $layer;
		
		return $this->layers;
	}

	function _add_map_layers_js ()
	{
		$js = Event::$data;
		
		// Next get the default base layer
		$default_map = Kohana::config('settings.default_map');

		// Hack on Mapbox Attribution layer here
		if (stripos($default_map,'mapbox_') !== FALSE)
		{
			$js .= "$('div#map').append('<div style=\"position:absolute;right:0;z-index:1000;margin: -40px 10px 0 90px;\"><small>Designed by <a href=\"http://mapbox.com/about/maps/\">MapBox</a> with data from OpenStreet Map.<br/ >&copy;<a href=\"http://creativecommons.org/licenses/by-sa/2.0/\">CCBYSA</a> 2010 <a href=\"http://www.openstreetmap.org/\">OpenStreetMap.org</a> contributors</small></div>');";
		}

		Event::$data = $js;
	}
}

new mapbox;
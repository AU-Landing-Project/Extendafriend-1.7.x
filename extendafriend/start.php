<?php
/**
 * extendafriend
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Matt Beckett
 * @copyright University of Athabasca 2011
 */

include_once 'lib/functions.php';

function extendafriend_init() {

	// Load system configuration
	global $CONFIG;

	// Extend system CSS with our own styles
	elgg_extend_view('css', 'extendafriend/css');
	elgg_extend_view('metatags','extendafriend/metatags');
	
	// Extend page view to add jquery triggers at bottom of page
	elgg_extend_view('footer/analytics', 'extendafriend/jqueryinit', 1000);

	// Load the language file
	register_translations($CONFIG->pluginspath . "extendafriend/languages/");

	//register action to add friends with collections
	register_action("extendafriend/add", true, $CONFIG->pluginspath . "extendafriend/actions/add.php");	
}


global $CONFIG;

// call init
register_elgg_event_handler('init','system','extendafriend_init');
?>

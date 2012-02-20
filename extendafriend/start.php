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

	// Load the language file
	register_translations($CONFIG->pluginspath . "extendafriend/languages/");

	//register action to add friends with collections
	register_action("extendafriend/add", true, $CONFIG->pluginspath . "extendafriend/actions/add.php");	
	
	register_page_handler('extendafriend','extendafriend_page_handler');
}


function extendafriend_page_handler($page){
  global $CONFIG;
		
  set_input('friend', $page[0]);
  set_input('approve', $page[1]);
  if(!include($CONFIG->pluginspath . "extendafriend/pages/form.php")){
    return FALSE;
  }
  return TRUE;
}

// call init
register_elgg_event_handler('init','system','extendafriend_init');
?>

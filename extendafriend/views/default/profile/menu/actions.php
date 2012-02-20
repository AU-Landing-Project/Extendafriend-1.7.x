<?php

	/**
	 * Elgg profile icon hover over: actions
	 * 
	 * @package ElggProfile
	 * 
	 * @uses $vars['entity'] The user entity. If none specified, the current user is assumed.
	 * 
	 *  editted for extendafriend
	 *  uses the guid of each user to generate unique ids for the form popup
	 */

	if (isloggedin()) {
		if ($_SESSION['user']->getGUID() != $vars['entity']->getGUID()) {
		  global $CONFIG;
		  
		  // create pseudounique rel to prevent multiple facebox instances
		  // when the same menu is rendered on a page
		  // kind of hackey - but it works
		$length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $string = '';    

        for ($p = 0; $p < $length; $p++) {
          $string .= $characters[mt_rand(0, strlen($characters))];
        }
         
        // a collision here is theoretically possible
        // but honestly, 10 random characters matching for the same guid on a single pageload
        // chances are on the order of 1/trillions.  I can live with that.
		 $rel = md5($vars['entity']->guid . $string);
			
			$ts = time();
			$token = generate_action_token($ts);
			$rtags = "";
					
			if ($vars['entity']->isFriend()) {
				echo "<p class=\"user_menu_removefriend\"><a href=\"{$vars['url']}action/friends/remove?friend={$vars['entity']->getGUID()}&__elgg_token=$token&__elgg_ts=$ts\">" . elgg_echo("friend:remove") . "</a></p>";
				echo "<p class=\"user_menu_addfriend\"><a href=\"{$CONFIG->url}pg/extendafriend/{$vars['entity']->username}\" rel=\"extendafriend{$rel}\">" . elgg_echo('extendafriend:edit:friend') . "</a></p>";
					
			} else {
				echo "<p class=\"user_menu_addfriend\"><a href=\"{$CONFIG->url}pg/extendafriend/{$vars['entity']->username}\" rel=\"extendafriend{$rel}\">" . elgg_echo('friend:add') . "</a></p>";
			}
			
		// initialize js on a per-view basis due to widget ajax loading
?>

<script type="text/javascript">

		 jQuery(document).ready(function($) {
			$('a[rel*=extendafriend<?php echo $rel; ?>]').facebox();
		});
</script>

<?php
		
		}
	}
?>
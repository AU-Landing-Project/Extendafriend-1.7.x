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
			
			$ts = time();
			$token = generate_action_token($ts);
			$rtags = "";
					
			if ($vars['entity']->isFriend()) {
				echo "<p class=\"user_menu_removefriend\"><a href=\"{$vars['url']}action/friends/remove?friend={$vars['entity']->getGUID()}&__elgg_token=$token&__elgg_ts=$ts\">" . elgg_echo("friend:remove") . "</a></p>";
				echo "<p class=\"user_menu_addfriend\"><a href=\"javascript:void(0);\" class=\"extendafriendmodal\" rel=\"#extendafriendform{$vars['entity']->getGUID()}\">" . elgg_echo('extendafriend:edit:friend') . "</a></p>";
					
			} else {
				echo "<p class=\"user_menu_addfriend\"><a href=\"javascript:void(0);\" class=\"extendafriendmodal\" rel=\"#extendafriendform{$vars['entity']->getGUID()}\">" . elgg_echo('friend:add') . "</a></p>";
			}
			
			
				$html = "<div class=\"modal\" id=\"extendafriendform{$vars['entity']->getGUID()}\">";
				
				//create our form
				$form = "<label>" . elgg_echo('extendafriend:rtags') . "</label><br>";
				$form .= elgg_view('input/text', array('internalname' => 'rtags', 'internalid' => 'rtags', 'value' => "")) . "<br>";
				$form .= elgg_view('input/hidden', array('internalname' => 'friend_guid', 'value' => $vars['entity']->getGUID()));

				//get array of names of all collections owned by me
				$allcollections = get_user_access_collections(get_loggedin_userid());
				$collections = extendafriend_sortcollectionsbyname($allcollections);
				//get array of ids of collections this person is in
				$friendcollections = extendafriend_get_friend_collections($vars['entity']->getGUID());
				
				if(!empty($collections[0]->id)){ // we have collections to show

					$collectioncount = count($collections);
					for($i=0; $i<$collectioncount; $i++){
						$checked = "";
						if(in_array($collections[$i]->id, $friendcollections)){
							$checked = " checked=\"checked\"";
						}
						
						$form .= "<div class=\"extendafriendcollectionlist\">";
						$form .= "<input type=\"checkbox\" id=\"" . $collections[$i]->name . $vars['entity']->getGUID() . "\" name=\"existing_rtag[]\" value=\"" . $collections[$i]->name . "\"$checked>";
						$form .= "<label for=\"" . $collections[$i]->name . $vars['entity']->getGUID() . "\">" . $collections[$i]->name . "</label>";
						$form .= "</div>";
					}	
				}
				
				$form .= "<div class=\"extendafriendclear\"></div>";
				
				$form .= elgg_view('input/submit', array('value' => elgg_echo('extendafriend:submit'))) . " ";
			
				$html .= elgg_view('input/form', array('body' => $form, 'action' => $CONFIG->url . "action/extendafriend/add"));
				
				$html .= "<br>" . elgg_echo('extendafriend:form:instructions') . "<br><br>";
				$html .= "<a href=\"javascript:void(0);\" class=\"close extendafriendcloselink\">" . elgg_echo('extendafriend:cancel') . "</a>";
				$html .= "</div>";

				
				// jquery init inserted as extension of the footer/analytics view - bottom of page
				
				echo $html;
		}
	}

?>
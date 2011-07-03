<?php

// takes an array of collections names
// returns an array of corresponding ids
function extendafriend_collection_names_to_ids($names_array){
	if(!is_array($names_array)){
		return false;
	}
	
	$collections = get_user_access_collections(get_loggedin_userid());
	
	$collectionscount = count($collections);
	$ids = array();
	for($i=0; $i<$collectionscount; $i++){
		if(in_array($collections[$i]->name, $names_array)){
			$ids[] = $collections[$i]->id;
		}
	}

	return $ids;
}

// get array of collection ids that the friend is already tagged as
function extendafriend_get_friend_collections($friend_guid, $names = false){
	$collections = get_user_access_collections(get_loggedin_userid());
	$collectionscount = count($collections);
	
	$friend_collections = array();
	for($i=0; $i<$collectionscount; $i++){
		$cur_members = get_members_of_access_collection($collections[$i]->id, true);
		if(in_array($friend_guid, $cur_members)){
			if($names){
				$friend_collections[] = $collections[$i]->name;
			}
			else{
				$friend_collections[] = $collections[$i]->id;
			}
		}
	}

	return $friend_collections;
}

function extendafriendSortByName($a, $b) {
	return strnatcmp(strtolower($a->name), strtolower($b->name));
}

function extendafriend_sortcollectionsbyname($objectArray) {
        usort($objectArray, "extendafriendSortByName");
        return $objectArray;
} 

//
//	removes a single item from an array
//	resets keys
//
function extendafriend_removeFromArray($value, $array){
	if(!is_array($array)){ return $array; }
	if(!in_array($value, $array)){ return $array; }
	
	for($i=0; $i<count($array); $i++){
		if($value == $array[$i]){
			unset($array[$i]);
			$array = array_values($array);
		}
	}
	
	return $array;
}

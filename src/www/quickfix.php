<?php

$access_item["/"] = true;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$IC = new Item();
$query = new Query();
$fs = new FileSystem();


// UPDATING FRONTPAGE TABLE

// $itemtype = "frontpage";
// $model = $IC->typeObject($itemtype);
// $query->checkDbExistance($model->db);
// $query->checkDbExistance($model->db_mediae);
//
//
// // get photos with frontpage tag
// $sql = "SELECT * FROM teisbruno_com.item_tags WHERE tag_id = 1";
// //print $sql."<br>";
// $query->sql($sql);
// $results = $query->results();
//
// foreach($results as $result) {
//
// 	$item_id = $result["item_id"];
//
// 	$sql = "SELECT name FROM teisbruno_com.itemtype_photo WHERE item_id = $item_id";
// 	print $sql."<br>";
// 	$query->sql($sql);
// 	$name = $query->result(0, "name");
//
// 	$format = "jpg";
//
// 	$image = new Imagick(PRIVATE_FILE_PATH."/".$item_id."/".$format);
//
// 	if($image) {
// 		$width = $image->getImageWidth();
// 		$height = $image->getImageHeight();
// 		$variant = "main";
// 		$name = $name;
// 		$filesize = filesize(PRIVATE_FILE_PATH."/".$item_id."/".$format);
//
// 		// insert data
// 		$sindex = $IC->sindex($item_id, "frontpage_".$name);
// 		$sql = "INSERT INTO ".UT_ITEMS." VALUES(DEFAULT, '$sindex', 1, 'frontpage', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
// //		print $sql."<br>";
// 		$query->sql($sql);
// 		$new_item_id = $query->lastInsertId();
//
// 		$sql = "INSERT INTO ".$model->db." VALUES(DEFAULT, $new_item_id, '".ucwords(strtolower($name))."')";
// //		print $sql."<br>";
// 		$query->sql($sql);
//
// 		$sql = "INSERT INTO ".$model->db_mediae." VALUES(DEFAULT, $new_item_id, '".ucwords(strtolower($name))."', '$format', '$variant', '$width', '$height', '$filesize', 0)";
// //		print $sql."<br>";
// 		$query->sql($sql);
//
// 		$fs->makeDirRecursively(PRIVATE_FILE_PATH."/".$new_item_id."/".$variant);
// 		copy(PRIVATE_FILE_PATH."/".$item_id."/".$format, PRIVATE_FILE_PATH."/".$new_item_id."/".$variant."/".$format);
//
// 	}
// 	else {
// 		print "MISSING FILE<br>";
// 	}
// }
//
// print "Frontpages added<br>";


// create photocollections

// $itemtype = "photocollection";
// $model = $IC->typeObject($itemtype);
// $query->checkDbExistance($model->db);
// $query->checkDbExistance($model->db_mediae);
//
// $sql = "SELECT * FROM teisbruno_com.navigation WHERE tags != 'frontpage'";
// //print $sql."<br>";
// $query->sql($sql);
// $results = $query->results();
//
// foreach($results as $result) {
//
// 	$name = $result["name"];
// 	$tags = $result["tags"];
// 	$sequence = $result["sequence"];
//
//
// 	$sindex = $IC->sindex(1, $name);
// 	$sql = "INSERT INTO ".UT_ITEMS." VALUES(DEFAULT, '$sindex', 1, 'photocollection', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
// 	print $sql."<br>";
// 	$query->sql($sql);
// 	$new_item_id = $query->lastInsertId();
//
// 	$sql = "INSERT INTO ".$model->db." VALUES(DEFAULT, $new_item_id, '".ucwords(strtolower($name))."', '', '', $sequence)";
// 	print $sql."<br>";
// 	$query->sql($sql);
//
//
// 	// find photos based on tags
// 	$sql = "SELECT * FROM teisbruno_com.item_tags as it, teisbruno_com.navigation_items as ni  WHERE it.tag_id = $tags AND it.item_id = ni.item_id ORDER BY ni.sequence ASC";
// 	//print $sql."<br>";
// 	$query->sql($sql);
// 	$nav_results = $query->results();
//
// 	foreach($nav_results as $nav_item) {
//
// 		$item_id = $nav_item["item_id"];
// 		$sequence = $nav_item["sequence"];
//
// 		$sql = "SELECT * FROM teisbruno_com.itemtype_photo WHERE item_id = $item_id";
// 		//print $sql."<br>";
// 		$query->sql($sql);
//
// 		$name = ucwords(strtolower($query->result(0, "name")));
//
// 		$format = "jpg";
//
// 		$image = new Imagick(PRIVATE_FILE_PATH."/".$item_id."/".$format);
//
// 		if($image) {
// 			$width = $image->getImageWidth();
// 			$height = $image->getImageHeight();
// 			$variant = randomKey(8);
// 			$name = $name;
// 			$filesize = filesize(PRIVATE_FILE_PATH."/".$item_id."/".$format);
//
// 			// add photos to photocollections
// 			$sql = "INSERT INTO ".$model->db_mediae." VALUES(DEFAULT, $new_item_id, '".ucwords(strtolower($name))."', '$format', '$variant', '$width', '$height', '$filesize', $sequence)";
// 			print $sql."<br>";
// 			$query->sql($sql);
//
// 			$fs->makeDirRecursively(PRIVATE_FILE_PATH."/".$new_item_id."/".$variant);
// 			copy(PRIVATE_FILE_PATH."/".$item_id."/".$format, PRIVATE_FILE_PATH."/".$new_item_id."/".$variant."/".$format);
//
// 		}
// 		else {
// 			print "MISSING FILE<br>";
// 		}
//
// 	}
// }


// remove old items and related files
// $sql = "SELECT * FROM teisbruno_com.items WHERE itemtype = 'photo'";
// //print $sql."<br>";
// $query->sql($sql);
// $results = $query->results();
//
// foreach($results as $result) {
//
// 	$item_id = $result["id"];
//
// 	$sql = "DELETE FROM teisbruno_com.items WHERE id = $item_id";
// 	print $sql."<br>";
// 	$query->sql($sql);
//
//
// 	$fs->removeDirRecursively(PRIVATE_FILE_PATH."/".$item_id);
// 	$fs->removeDirRecursively(PUBLIC_FILE_PATH."/".$item_id);
//
// }


// Clean up old files
// $files = scandir(PRIVATE_FILE_PATH);
// //$files = $fs->files(PRIVATE_FILE_PATH);
// foreach($files as $file) {
//
// //	$item_id = preg_replace("/\/(.)+$/", "", str_replace(PRIVATE_FILE_PATH."/", "", $file));
//
// 	if($file != "." && $file != "..") {
//
// 		$item_id = $file;
//
// 		$sql = "SELECT * FROM teisbruno_com.items WHERE id = $item_id";
// 		if(!$query->sql($sql)) {
//
// 			if(is_dir(PRIVATE_FILE_PATH."/".$item_id)) {
//
// 				$fs->removeDirRecursively(PRIVATE_FILE_PATH."/".$item_id);
// 				$fs->removeDirRecursively(PUBLIC_FILE_PATH."/".$item_id);
//
// 			}
// 			else {
//
// 				unlink(PRIVATE_FILE_PATH."/".$item_id);
// 				unlink(PUBLIC_FILE_PATH."/".$item_id);
//
// 			}
//
// 		}
//
// 	}
//
// }

?>
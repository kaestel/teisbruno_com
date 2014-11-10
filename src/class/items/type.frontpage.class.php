<?php
/**
* @package janitor.items
* This file contains item type functionality
*/

class TypeFrontpage extends Model {

	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {

		// itemtype database
		$this->db = SITE_DB.".item_frontpage";
		$this->db_mediae = SITE_DB.".item_frontpage_mediae";


		// Name
		$this->addToModel("name", array(
			"type" => "string",
			"label" => "Name",
			"required" => true,
			"hint_message" => "Name your frontpage entry", 
			"error_message" => "Name must be filled out."
		));

		// Media
		$this->addToModel("main_media", array(
			"type" => "files",
			"label" => "Drag image here",
			"allowed_sizes" => "1600x900",
			"allowed_formats" => "png,jpg",
			"hint_message" => "Add image here. Use png or jpg in 1600x900.",
			"error_message" => "File does not fit requirements."
		));

		parent::__construct();
	}


	// Custom get item with media
	function get($item_id) {
		$query = new Query();
		$query_media = new Query();

		if($query->sql("SELECT * FROM ".$this->db." WHERE item_id = $item_id")) {
			$item = $query->result(0);
			unset($item["id"]);

			$item["main_media"] = false;

			// get media
			if($query_media->sql("SELECT * FROM ".$this->db_mediae." WHERE item_id = $item_id AND variant = 'main'")) {

				$media = $query_media->result(0);
				$item["main_media"]["id"] = $media["id"];
				$item["main_media"]["variant"] = $media["variant"];
				$item["main_media"]["format"] = $media["format"];
				$item["main_media"]["width"] = $media["width"];
				$item["main_media"]["height"] = $media["height"];
				$item["main_media"]["filesize"] = $media["filesize"];
				
			}

			return $item;
		}
		else {
			return false;
		}
	}


	// CMS SECTION
	// custom loopback function


	// custom function to add main media
	// /janitor/frontpage/addMain/#item_id#
	function addMain($action) {

		if(count($action) == 2) {
			$query = new Query();
			$IC = new Item();
			$item_id = $action[1];

			$query->checkDbExistance($this->db_mediae);

			// Image main_media
			if($this->validateList(array("main_media"), $item_id)) {
				$uploads = $IC->upload($item_id, array("input_name" => "main_media", "variant" => "main"));
				if($uploads) {
					$query->sql("DELETE FROM ".$this->db_mediae." WHERE item_id = $item_id AND variant = '".$uploads[0]["variant"]."'");
					$query->sql("INSERT INTO ".$this->db_mediae." VALUES(DEFAULT, $item_id, '".$uploads[0]["name"]."', '".$uploads[0]["format"]."', '".$uploads[0]["variant"]."', '".$uploads[0]["width"]."', '".$uploads[0]["height"]."', '".$uploads[0]["filesize"]."', 0)");

					return array(
						"item_id" => $item_id, 
						"media_id" => $query->lastInsertId(), 
						"variant" => $uploads[0]["variant"], 
						"format" => $uploads[0]["format"], 
						"width" => $uploads[0]["width"], 
						"height" => $uploads[0]["height"],
						"filesize" => $uploads[0]["filesize"]
					);
				}
			}
		}

		return false;
	}

	// delete image - 3 parameters exactly
	// /janitor/frontpage/deleteImage/#item_id#/#variant#
	function deleteMedia($action) {

		if(count($action) == 3) {

			$query = new Query();
			$fs = new FileSystem();

			$sql = "DELETE FROM ".$this->db_mediae." WHERE item_id = ".$action[1]." AND variant = '".$action[2]."'";
			if($query->sql($sql)) {
				$fs->removeDirRecursively(PUBLIC_FILE_PATH."/".$action[1]."/".$action[2]);
				$fs->removeDirRecursively(PRIVATE_FILE_PATH."/".$action[1]."/".$action[2]);

				message()->addMessage("Media deleted");
				return true;
			}
		}

		message()->addMessage("Media could not be deleted", array("type" => "error"));
		return false;
	}

}

?>
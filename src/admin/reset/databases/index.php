<?php
$access_item = false;

if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["LOCAL_PATH"]."/config/connect.php");
include_once($_SERVER["FRAMEWORK_PATH"]."/config/file_paths.php");


// Database names
$global_db_name = 'w_tbc';
$regional_db_names = array('w_tbc');
$local_db_name = 'w_tbc';

// Always list tables in IMPORT order
$global_db = array();
$regional_db = array();
$local_db = array();


// import default table-sets
include_once($_SERVER["FRAMEWORK_PATH"]."/config/db/basics.php");
include_once($_SERVER["FRAMEWORK_PATH"]."/config/db/users.php");
include_once($_SERVER["FRAMEWORK_PATH"]."/config/db/content.php");


$local_db[] = 'import_local';


// include default loop
include_once($_SERVER["FRAMEWORK_PATH"]."/admin/reset/databases/default_loop.php");

?>
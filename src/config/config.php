<?php

/**
* This file contains definitions
*
* @package Config
*/
header("Content-type: text/html; charset=UTF-8");
error_reporting(E_ALL);

/**
* Required site information
*/
define("SITE_UID", "TBC");
define("SITE_NAME", "teisbruno.com");
define("SITE_URL", (isset($_SERVER["HTTPS"]) ? "https" : "http")."://".$_SERVER["SERVER_NAME"]);
define("SITE_EMAIL", "teis@teisbruno.com");

/**
* Optional constants
*/
define("DEFAULT_PAGE_DESCRIPTION", "Photographer Teis Bruno");
define("DEFAULT_LANGUAGE_ISO", "EN");
define("DEFAULT_COUNTRY_ISO", "DK");


// Enable items model
define("SITE_ITEMS", true);


// Enable notifications (send collection email after N notifications)
define("SITE_COLLECT_NOTIFICATIONS", 50);

//define("SITE_INSTALL", true);
?>

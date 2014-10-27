<?php
global $IC;
global $action;

$items = $IC->getItems(array("itemtype" => "frontpage", "status" => 1));
$item = $IC->extendItem($items[rand(0, count($items)-1)]);

?>
<div class="scene front i:front item_id:<?= $item["id"] ?> format:<?= $item["main_media"]["format"] ?>"></div>

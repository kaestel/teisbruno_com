<?php
global $IC;
global $action;

$items = $IC->getItems(array("itemtype" => "frontpage", "status" => 1));
if($items) {
	$item = $IC->extendItem($items[rand(0, count($items)-1)]);
}
else {
	$item = false;
}
?>
<div class="scene front i:front<?= $item ? " item_id:".$item["id"]." format:".$item["main_media"]["format"] : "" ?>"></div>

<?php
global $action;
global $IC;
global $model;
global $itemtype;

$all_items = $IC->getItems(array("itemtype" => $itemtype, "order" => "status DESC, published_at DESC"));
?>
<div class="scene defaultList <?= $itemtype ?>List">
	<h1>Frontpages</h1>

	<ul class="actions">
		<?= $HTML->link("New frontpage entry", "/janitor/".$itemtype."/new", array("class" => "button primary key:n", "wrapper" => "li.new")) ?>
	</ul>

	<div class="all_items i:defaultList taggable filters" 
		data-csrf-token="<?= session()->value("csrf") ?>"
		data-get-tags="<?= $this->validPath("/janitor/admin/items/tags") ?>" 
		data-delete-tag="<?= $this->validPath("/janitor/admin/items/tags/delete") ?>"
		data-add-tag="<?= $this->validPath("/janitor/admin/items/tags/add") ?>"
		>
<?		if($all_items): ?>
		<ul class="items">
<?			foreach($all_items as $item): 
				$item = $IC->extendItem($item, array("tags" => true));
				$media = $item["main_media"] ? $item["main_media"] : false; ?>
			<li class="item item_id:<?= $item["id"] ?><?= $media ? (" image:".$media["format"]." variant:".$media["variant"]) : "" ?> width:160">
				<h3><?= $item["name"] ?></h3>

				<ul class="actions">
					<?= $HTML->link("Edit", "/janitor/".$itemtype."/edit/".$item["id"], array("class" => "button", "wrapper" => "li.edit")) ?>
					<?= $HTML->deleteButton("Delete", "/janitor/admin/items/delete/".$item["id"], array("js" => true)) ?>
					<?= $HTML->statusButton("Enable", "Disable", "/janitor/admin/items/status", $item, array("js" => true)) ?>
				</ul>
			 </li>
<?			endforeach; ?>
		</ul>
<?		else: ?>
		<p>No frontpage entries.</p>
<?		endif; ?>
	</div>

</div>

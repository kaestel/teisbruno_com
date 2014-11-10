<?php
global $action;
global $IC;
global $model;
global $itemtype;

$item = $IC->getCompleteItem(array("id" => $action[1]));
$item_id = $item["item_id"];

?>
<div class="scene defaultEdit <?= $itemtype ?>Edit">
	<h1>Edit frontpage entry</h1>

	<ul class="actions i:defaultEditActions item_id:<?= $item_id ?>"
		data-csrf-token="<?= session()->value("csrf") ?>"
		>
		<?= $HTML->link("List", "/janitor/".$itemtype."/list", array("class" => "button", "wrapper" => "li.cancel")) ?>
		<?= $HTML->deleteButton("Delete", "/janitor/admin/items/delete/".$item["id"], array("js" => true)) ?>
	</ul>

	<div class="status i:defaultEditStatus item_id:<?= $item["id"] ?>"
		data-csrf-token="<?= session()->value("csrf") ?>"
		>
		<ul class="actions">
			<?= $HTML->statusButton("Enable", "Disable", "/janitor/admin/items/status", $item, array("js" => true)) ?>
		</ul>
	</div>

	<div class="item i:defaultEdit">
		<h2>Frontpage entry</h2>
		<?= $model->formStart("/janitor/admin/items/update/".$item_id, array("class" => "labelstyle:inject")) ?>
			<fieldset>
				<?= $model->input("name", array("value" => $item["name"])) ?>
			</fieldset>

			<ul class="actions">
				<?= $model->link("Back", "/janitor/".$itemtype."/list", array("class" => "button key:esc", "wrapper" => "li.cancel")) ?>
				<?= $model->submit("Update", array("class" => "primary key:s", "wrapper" => "li.save")) ?>
			</ul>
		<?= $model->formEnd() ?>
	</div>

	<div class="media main_media i:addMediaSingle variant:main item_id:<?= $item_id ?>"
		data-delete-media="<?= $this->validPath("/janitor/".$itemtype."/deleteMedia") ?>"
	>
		<h2>Main image</h2>
		<?= $model->formStart("/janitor/".$itemtype."/addMain/".$item_id, array("class" => "upload labelstyle:inject")) ?>
			<fieldset>
				<?= $model->input("main_media") ?>
			</fieldset>
		<?= $model->formEnd() ?>

<?	if(isset($item["main_media"]) && $item["main_media"]): ?>
		<img src="/images/<?= $item_id ?>/main/500x.<?= $item["main_media"]["format"] ?>" />
<?	endif; ?>

	</div>


</div>

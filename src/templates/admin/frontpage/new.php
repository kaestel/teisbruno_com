<?php
global $action;
global $IC;
global $model;
global $itemtype;
?>
<div class="scene defaultNew">
	<h1>New frontpage image</h1>

	<ul class="actions">
		<?= $model->link("List", "/admin/".$itemtype."/list", array("class" => "button", "wrapper" => "li.cancel")) ?>
	</ul>

	<?= $model->formStart("/admin/cms/save/".$itemtype, array("class" => "i:defaultNew labelstyle:inject")) ?>
		<p>You always have to start with a name. You can add your frontpage photo in the next step.</p>
		<fieldset>
			<?= $model->input("name") ?>
		</fieldset>

		<ul class="actions">
			<?= $model->link("Cancel", "/admin/".$itemtype."/list", array("class" => "button key:esc", "wrapper" => "li.cancel")) ?>
			<?= $model->submit("Save", array("class" => "primary key:s", "wrapper" => "li.save")) ?>
		</ul>
	<?= $model->formEnd() ?>

</div>



<!--div class="i:carousel carousel">
	<div class="imageNav">
		<ul>
		<?
		/*
		 foreach($item["id"] as $key => $id) {
			// get width/height if the file already exists (file will be generated on first request)
			if(file_exists(PUBLIC_FILE_PATH.$id."/x52.jpg")) {
				list($width, $height, $type) = getimagesize(PUBLIC_FILE_PATH.$id."/x52.jpg");
			}
		*/
		?>
			<li class="id:<?=$id?>">
				<a href="/view.php?id=<?=$id?>"><img src="/images/<?= $id ?>/x52.jpg" width="<?= $width ?>" height="<?= $height ?>" alt="<?= $item["name"][$key] ?>" /></a>
			</li>
		<? //} ?>
		</ul>
	</div>
</div-->


<?php
global $IC;
global $action;

$item = $IC->getCompleteItem(array("sindex" => $action[0]));
$item_id = $item["item_id"];
?>
<div class="scene photos i:photos item_id:<?= $item["item_id"] ?>">

	<div class="carousel">
		<ul class="images">
<?		foreach($item["mediae"] as $media): ?>
			<li class="item format:<?= $media["format"] ?> variant:<?= $media["variant"] ?>">
				<a href="/images/<?= $item["item_id"] ?>/<?= $media["variant"] ?>/x250.<?= $media["format"] ?>"><?= $media["name"] ?></a>
			</li>
<?		endforeach; ?>
		</ul>
	</div>

</div>

<?php
global $action;
global $IC;
global $itemtype;


// get post tags for listing
$categories = $IC->getTags(array("context" => $itemtype, "order" => "value"));
$items = $IC->getItems(array("itemtype" => $itemtype, "status" => 1, "extend" => array("tags" => true, "user" => true, "mediae" => true)));

?>

<div class="scene posts i:blog">

	<h1>Blog</h1>

<? /*if($categories): ?>
	<div class="categories">
		<ul class="tags">
			<li class="selected"><a href="/blog">All posts</a></li>
			<? foreach($categories as $tag): ?>
			<li><a href="/blog/tag/<?= urlencode($tag["value"]) ?>"><?= $tag["value"] ?></a></li>
			<? endforeach; ?>
		</ul>
	</div>
<? endif;*/ ?>


<? if($items): ?>
	<ul class="articles">
		<? foreach($items as $item):
			$media = $IC->sliceMedia($item); ?>
		<li class="item article id:<?= $item["item_id"] ?>" itemscope itemtype="http://schema.org/BlogPosting">


			<?= $HTML->articleTags($item, [
				"context" => [$itemtype],
				"url" => false
			]) ?>


			<h2 itemprop="headline"><?= $item["name"] ?></h2>


			<?= $HTML->articleInfo($item, "/blog", [
				"media" => $media, 
				"sharing" => true
			]) ?>


			<div class="articlebody" itemprop="articleBody">
				<?= $item["html"] ?>
			</div>

		</li>
		<? endforeach; ?>
	</ul>
	
<? else: ?>
	<p>No posts</p>
<? endif; ?>

</div>

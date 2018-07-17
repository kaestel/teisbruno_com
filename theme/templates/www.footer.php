<?
$IC = new Items();
$collections = $IC->getItems(array("itemtype" => "photocollection", "status" => 1, "order" => "position"));
?>
	</div>

	<div id="navigation">
		<ul class="navigation">
			<li class="front"><a href="/">Frontpage</a></li>
			<li class="contact" itemscope itemtype="http://schema.org/Organization">
				<h3>Contact</h3>
				<ul itemscope itemtype="http://schema.org/PostalAddress">
					<li class="name" itemprop="name">Teis Bruno</li>
					<li class="role" itemprop="role">Photographer</li>
					<li class="street" itemprop="streetAddress">Chr. Richardts Vej 8, 1.sal</li>
					<li class="postalcity"><span itemprop="postalCode">1951</span> <span itemprop="addressLocality">Frederiksberg C</span></li>
					<li class="phone" itemprop="telephone">+45 4019 2919</li>
					<li class="email" itemprop="email"><a href="mailto:mail@teisbruno.com">mail@teisbruno.com</a></li>
				</ul>
			</li>
<?		foreach($collections as $collection):
	 		$collection = $IC->extendItem($collection); ?>
			<li<?= $HTML->attribute("class", $collection["classname"]) ?>><a href="/photos/<?= $collection["sindex"] ?>"><?= $collection["name"] ?></a></li>
<?		endforeach; ?>
		</ul>
	</div>

	<div id="footer"></div>

</div>

</body>
</html>
	</div>

	<div id="navigation">
		<ul>
			<?= $HTML->link("Frontpage", "/admin/frontpage/list", array("wrapper" => "li.frontpage")) ?>
			<?= $HTML->link("Collections", "/admin/photocollection/list", array("wrapper" => "li.photocollection")) ?>

			<?= $HTML->link("Tags", "/admin/tag/list", array("wrapper" => "li.tags")) ?>
			<?= $HTML->link("Users", "/admin/user/list", array("wrapper" => "li.user")) ?>
		</ul>
	</div>

	<div id="footer">
		<ul class="servicenavigation">
			<li class="copyright">Janitor, Manipulator, Modulator - parentNode - Copyright 2014</li>
		</ul>
	</div>
</div>

</body>
</html>
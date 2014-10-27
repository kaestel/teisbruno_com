Util.Objects["article"] = new function() {
	this.init = function(scene) {
		
		// resize handler 
		scene.resized = function() {
			
			// refresh dom
			this.offsetHeight;

		}

		// scroll handler 
		scene.scrolled = function() {

			// change menu height!
			// if (u.scrollY() > 1) {
			// 	u.bug("you scrolled");
			// }
		}

		// GO GO!
		scene.ready = function() {
			u.bug("scene.ready:" + u.nodeId(this))
			

			// load image
			var img = u.qs(".image", this);
			
			// if img
			if (img) {
				// get html vars for img
				img.image_id = u.cv(img, "image_id");
				img.image_format = u.cv(img, "image_format");

				img.url = "/images/"+img.image_id+"/main/480x."+img.image_format;

				// load img
				img.loaded = function(queue) {
					u.ae(this, "img", {"src": queue[0]._image.src});
				}
				u.preloader(img, [img.url]);
			}
		}
		
		// are you ready?
		scene.ready();
	}

}

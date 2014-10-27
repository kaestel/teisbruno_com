Util.Objects["magazine"] = new function() {
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
			//u.bug("scene.ready:" + u.nodeId(this))
			
			var ul = u.qs("ul.items", this);
			var nodes = u.qsa("li.item", ul);
			var i, node;

			// add top live
			u.ie(ul, "li", {"class": "line"});

			for(i = 0; node = nodes[i]; i++) {

				// get html vars for img
				node.image_id = u.cv(node, "image_id");
				node.image_format = u.cv(node, "image_format");

				// if img
				if (node.image_id && node.image_format) {
					//node.url = "/img/temp/"+node.image_id+"."+node.image_format;
					node.img_url = "/images/"+node.image_id+"/main/500x."+node.image_format;

					// load img
					node.loaded = function(queue) {
						var img = u.ie(this, "div", {"class": "image"});
						u.ae(img, "img", {"src": queue[0]._image.src});
						
					}
					u.preloader(node, [node.img_url]);
				}
			}

		}
		
		// are you ready?
		scene.ready();
	}

}

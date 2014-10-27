Util.Objects["interview"] = new function() {
	this.init = function(scene) {
		
		// resize handler 
		scene.resized = function() {
			
			// refresh dom
			this.offsetHeight;

		}

		// scroll handler 
		scene.scrolled = function() {

			// change menu height!
			if (u.scrollY() > 1) {
				// u.bug("you scrolled");
			}
		}

		// GO GO!
		scene.ready = function() {
			u.bug("scene.ready:" + u.nodeId(this))
			
			// get first image
			var image = u.qs(".image", this);
			// get html vars for img
			image.image_id = u.cv(image, "image_id");
			image.image_format = u.cv(image, "image_format");

			// if img
			if (image.image_id && image.image_format) {
				// load img
				image.loaded = function(queue) {
					//var img = u.ie(this, "div", {"class": "image"});
					u.ae(this, "img", {"src": queue[0]._image.src});
				}
				u.preloader(image, ["/images/"+image.image_id+"/main/480x."+image.image_format]);
			}

			// // load image list
			// var ul = u.qs("ul.images", this);
			// var lis = u.qsa("li", ul);
			// var i, node;

			// // add top live
			// //u.ie(ul, "li", {"class": "line"});

			// for(i = 0; node = lis[i]; i++) {

			// 	// get html vars for img
			// 	node.image_id = u.cv(node, "image_id");
			// 	node.image_format = u.cv(node, "image_format");
			// 	node.image_variant = u.cv(node, "image_variant");

			// 	// if img
			// 	if (node.image_id && node.image_format && node.image_variant) {
			// 		node.url = "/images/"+node.image_id+"/"+node.image_variant+"/320x."+node.image_format;

			// 		// load img
			// 		node.loaded = function(queue) {
			// 			//var img = u.ie(this, "div", {"class": "image"});
			// 			u.ae(this, "img", {"src": queue[0]._image.src});
			// 		}
			// 		u.preloader(node, [node.url]);
			// 	}
			// }

		}
		
		// are you ready?
		scene.ready();
	}

}

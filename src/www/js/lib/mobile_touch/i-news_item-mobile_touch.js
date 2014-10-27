Util.Objects["news_item"] = new function() {
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



			// Load related news!
			var ul = u.qs(".related ul.items", this);
			var nodes = u.qsa("li.item", ul);
			var i, node;

			for(i = 0; node = nodes[i]; i++) {

				// store h3, link
				node.h3 = u.qs("h3 a", node);
				node.url = node.h3.href;

				// get html vars for img
				node.image_id = u.cv(node, "image_id");
				node.image_format = u.cv(node, "image_format");

				// if img
				if (node.image_id && node.image_format) {
					node.img_url = "/images/"+node.image_id+"/main/480x."+node.image_format;
					//u.bug(node.url)

					// load img
					node.loaded = function(queue) {
						var img = u.ie(this, "div", {"class": "image"});
						img.node = this;
						u.ae(img, "img", {"src": queue[0]._image.src});

						// add tag to img
						u.ae(img, u.qs("ul.tag", this));

						// click img
						img.url = this.url;
						u.bug("img.url: " +img.url);
						img.clicked = function() {
							location.href = this.url;
						}
						u.ce(img)

						// hover img to trigger h2.hover
						img.over = function(event) {
							u.ac(this.node.h3, "hover");
						}
						img.out = function(event) {
							u.rc(this.node.h3, "hover");
						}
						u.e.addEvent(img, "mouseover", img.over);
						u.e.addEvent(img, "mouseout", img.out);
					}
					u.preloader(node, [node.img_url]);
				}
				// no image
				else {
					// add tag first in li
					u.ie(node, u.qs("ul.tag", node));
				}
			}

		}
		
		// are you ready?
		scene.ready();
	}

}

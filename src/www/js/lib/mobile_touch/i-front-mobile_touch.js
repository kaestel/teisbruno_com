Util.Objects["front"] = new function() {
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
			
			// set hedaer hegiht
			u.as(page.hN, "height", u.browserHeight()+"px");
			// add arrow to splash
			var splash = u.qs(".splash", this);
			u.as(splash, "top", (u.browserHeight()/2)-80 +"px")

			// animate arrow
			var arrow = u.ae(splash, "div", {"class": "arrow"});
			arrow.iteration = 0;
			arrow.max_iteration = 4;

			arrow.transitioned = function() {
				if (arrow.iteration < arrow.max_iteration && arrow.first) {

					if (arrow.done) {
						u.a.transition(arrow, "all 0.6s ease-out");
						u.a.translate(arrow, 0, -15);
						arrow.done = false;

					} else {
						u.a.transition(arrow, "all 0.2s ease-in");
						u.a.translate(arrow, 0, 0, true);
						arrow.done = true;
					}
					arrow.iteration++;

				} else {
					u.t.setTimer(arrow, arrow.transitioned, 2500);
					arrow.iteration = 0;
					arrow.first = true;
				}
			}
			arrow.transitioned();



			var sign_up = u.we(u.qs(".sign_up", this), "li", {"class": "full"});

			// grid
			var ul = u.qs("ul.items", this);
			var nodes = u.qsa("li.item", ul);
			var i, node;

			for(i = 0; node = nodes[i]; i++) {

				// store h2, link
				node.h2 = u.qs("h2 a", node);
				node.url = node.h2.href;

				// grid classes
				u.ac(node, "i"+i);

				// get html vars for img
				node.image_id = u.cv(node, "image_id");
				node.image_format = u.cv(node, "format");
				node.image_variant = u.cv(node, "variant");

				// if img
				if (node.image_id && node.image_format) {
					u.bug("boom:" + node.image_variant);
					node.img_url = "/images/"+node.image_id+"/"+(node.image_variant ? node.image_variant+"/" : "")+node.offsetWidth+"x."+node.image_format;


					// load img
					node.loaded = function(queue) {
						// add tag
						u.ie(this, u.qs("ul.tag", this));

						// add img
						var img = u.ie(this, "div", {"class": "image"});
						img.node = this;
						u.ae(img, "img", {"src": queue[0]._image.src});
						
						// click img
						img.url = this.url;
						img.clicked = function() {
							location.href = this.url;
						}
						u.ce(img)
					}
					u.preloader(node, [node.img_url]);
				}
				// no image
				else {
					// add tag first in li
					u.ie(node, u.qs("ul.tag", node));
				}

				// add sign_up in middle of list
				if (i == 4) {
					ul.insertBefore(sign_up, node);
				}
			}

		}
		
		// are you ready?
		scene.ready();
	}

}

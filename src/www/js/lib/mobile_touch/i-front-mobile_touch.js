Util.Objects["front"] = new function() {
	this.init = function(scene) {
		
		// resize handler 
		scene.resized = function() {
			//u.bug("scene.resized:" + u.nodeId(this))

			u.as(this.cover, "height", this.offsetHeight-40+"px");

			// refresh dom
			this.offsetHeight;
		}

		// scroll handler 
		scene.scrolled = function() {
			//u.bug("scene.scrolled:" + u.nodeId(this))

		}

		// GO GO!
		scene.ready = function() {
			//u.bug("scene.ready:" + u.nodeId(this))

			item_id = u.cv(this, "item_id");
			format = u.cv(this, "format");

			// load cover
			if(item_id) {
				this.cover = u.ae(this, "div", {"class":"cover"});
				u.as(this.cover, "height", this.offsetHeight-40+"px");
				u.as(this.cover, "backgroundImage", "url(/images/"+item_id+"/main/1600x."+format+")");

				u.e.click(this.cover);
				this.cover.clicked = function(event) {

					if(page.first_nav_link) {
						page.first_nav_link.clicked(event);
					}
					else {
						this.transitioned = function() {
							page.cN.ready();
							page.cN.removeChild(this.parentNode);
						}

						u.a.transition(this, "all 0.5s ease-in-out");
						u.a.setOpacity(this, 0);
					}
				}
			}
			else {
				page.cN.ready();
			}

		}
		
		// are you ready?
		scene.ready();
	}

}

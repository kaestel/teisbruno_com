Util.Objects["front"] = new function() {
	this.init = function(scene) {
		
		// resize handler 
		scene.resized = function() {
			//u.bug("scene.resized:", this);

			u.as(this.cover, "height", page.offsetHeight-40+"px");

			// refresh dom
			this.offsetHeight;
		}

		// scroll handler 
		scene.scrolled = function() {
			//u.bug("scene.scrolled:", this);

		}

		// GO GO!
		scene.ready = function() {
//			u.bug("scene.ready:", this);

			// reverse ready state
			page.cN.unready();


			var item_id = u.cv(this, "item_id");
			var format = u.cv(this, "format");
			var width = u.cv(this, "width");
			var height = u.cv(this, "height");

			// load cover
			if(item_id) {
				this.cover = u.ae(page.cN, "div", {"class":"cover"});
				u.as(this.cover, "height", page.offsetHeight-40+"px");
				if(width > height) {
					u.as(this.cover, "backgroundImage", "url(/images/"+item_id+"/main/1200x."+format+")");
				}
				else {
					u.as(this.cover, "backgroundImage", "url(/images/"+item_id+"/main/x800."+format+")");
				}

				u.e.click(this.cover);
				this.cover.clicked = function(event) {

					this.transitioned = function(event) {

						// remove cover
						page.cN.removeChild(this);

						// click on first navigation link
						if(page.first_nav_link) {
							page.first_nav_link.clicked();
						}

						page.cN.ready();
					}

					u.a.transition(this, "all 0.5s ease-in-out");
					u.a.setOpacity(this, 0);
				}
			}
			else {

				// click on first navigation link
				if(page.first_nav_link) {
					page.first_nav_link.clicked();
				}

				page.cN.ready();
			}

		}
		
		// are you ready?
		scene.ready();
	}

}

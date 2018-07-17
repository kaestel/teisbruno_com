Util.Objects["blog"] = new function() {
	this.init = function(scene) {
		
		// resize handler 
		scene.resized = function() {
			//u.bug("scene.resized:", this);

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


			this.articles = u.qsa("li.article", this);
	//		list.add_readmore = u.hc(list, "readmore");

			var i, node;
			for(i = 0; i < this.articles.length; i++) {
				node = this.articles[i];

				node._tags = u.qs("ul.tags", node);
				node._published_at = u.qs("ul.info li.published_at", node);
				if(node._tags && node._published_at) {
					u.ie(node._tags, node._published_at);
				}


				node._images = u.qsa("div.image,div.media", node);
				for(j = 0; j < node._images.length; j++) {

					image = node._images[j];
					image.node = node;

					// remove link from caption
					image.caption = u.qs("p a", image);
					if(image.caption) {
						image.caption.removeAttribute("href");
					}

					// get image variables
					image._id = u.cv(image, "item_id");
					image._format = u.cv(image, "format");
					image._variant = u.cv(image, "variant");

					// if image
					if(image._id && image._format) {

						// add image
						image._image_src = "/images/" + image._id + "/" + (image._variant ? image._variant+"/" : "") + "480x." + image._format;
						u.ass(image, {
							// "height": image.wrapper_height,
							"opacity": 0
						});

						image.loaded = function(queue) {

							u.ac(this, "loaded");

							this._image = u.ie(this, "img");
							this._image.image = this;
							this._image.src = queue[0].image.src;

							u.a.transition(this, "all 0.5s ease-in-out");
							u.ass(this, {
								//"height": (this._image.offsetHeight + this.wrapper_height) +"px",
								"opacity": 1
							});

						}
						u.preloader(image, [image._image_src]);

					}
				}
			}


			page.cN.ready();

		}
		
		// are you ready?
		scene.ready();
	}

}

u.bug_console_only = true;

Util.Objects["page"] = new function() {
	this.init = function(page) {
		
		//if(u.hc(page, "i:page")) {
			
			// header reference
			page.hN = u.qs("#header");
			page.hN.service = u.qs(".servicenavigation", page.hN);

			// content reference
			page.cN = u.qs("#content", page);

			// navigation reference
			page.nN = u.qs("#navigation", page);
			// move navigation to header
			page.nN = u.ae(page.hN, page.nN);

			// footer reference
			page.fN = u.qs("#footer");
			
			

			// global resize handler 
			page.resized = function() {
				//u.bug("page.resized");
				// forward resize event to current scene
				if(page.cN && page.cN.scene && typeof(page.cN.scene.resized) == "function") {
					page.cN.scene.resized();
				}

			}

			// global scroll handler 
			page.scrolled = function() {

				// forward scroll event to current scene
				if(page.cN && page.cN.scene && typeof(page.cN.scene.scrolled) == "function") {
					page.cN.scene.scrolled();
				}

			}

			page.orientationchanged = function(event) {
				
				u.rc(document.body, "landscape|portrait");
				if (this.orientation == 90 || this.orientation == -90) {
					u.ac(document.body, "landscape");
				} else {
					u.ac(document.body, "portrait");
				}

			}

			// Page is ready - called from several places, evaluates when page is ready to be shown
			page.ready = function() {
//				u.bug("page ready")

				// page is ready to be shown - only initalize if not already shown
				if(!u.hc(this, "ready")) {

					// page is ready
					u.addClass(this, "ready");

					// set resize handler
					u.e.addEvent(window, "resize", page.resized);
					// set scroll handler
					u.e.addEvent(window, "scroll", page.scrolled);
					// set orientation change handler
					u.e.addEvent(window, "orientationchange", page.orientationchanged);

					this.initNavigation();
					this.initFooter();

					// show scene
					page.cN.scene = u.qs(".scene", this);

					// load random 1/5 img
					// var nr = u.random(1, 5);
					//u.as(page, "background-image", "url(/img/bg_page"+nr+".jpg)");
					
				}
			}


			// initialize navigation elements
			page.initNavigation = function() {

				// add menu logo
				this.logo = u.ie(page.hN, "div", ({"class": "logo"}));
				this.logo.clicked =function() {
					window.location.href = "/";
				}
				u.ce(this.logo);

				// add shadow - behind "fake" nav
				var shadow = u.ie(this.hN, "div", {"class": "shadow"});
				u.a.setOpacity(shadow, "0");
				u.as(shadow, "display", "none");

				// add "fake" nav - holds menu icon + li.sected
				var nav = u.ie(page.hN, "ul", ({"class": "nav"}));
				u.ae(nav, "li", ({"class": "menu", "html": "<p>Menu</p>"}));
				if (u.hc(document.body, "front")) {
					u.as(page, "backgroundImage", "url(/img/bg_page1.jpg)");
					u.as(nav, "top", window.innerHeight-50 +"px");
				}
				
				shadow.clicked = function() {
					nav.clicked();
				}
				nav.clicked = function() {
					// shadow - display none
					shadow.transitioned = function() {
						u.a.transition(shadow, "none");
						if (u.gcs(shadow, "opacity") == "0") {
							u.as(shadow, "display", "none");
						}
					}

					// Open
					page.nN.transitioned = function() {
						u.a.transition(this, "none");
						u.e.drag(this, [0, window.innerHeight-this.offsetHeight, this.offsetWidth, this.offsetHeight], {"strict":false, "elastica":200});
					}
					
					// open
					if (!this.open) {
						this.open = true;
						u.a.transition(page.nN, "all 0.5s ease-out");
						u.as(page.nN, "left", "0px");
						u.as(shadow, "display", "block");
						u.a.transition(shadow, "all 0.5s ease-out");
						u.a.setOpacity(shadow, "1");
					}
					// Close
					else {
						this.open = false;
						u.a.transition(page.nN, "all 0.3s ease-in");
						u.as(page.nN, "left", "-280px");
						u.a.transition(shadow, "all 0.3s ease-in");
						u.a.setOpacity(shadow, "0");
					}
					
				}
				u.ce(nav);
				u.ce(shadow);


				// move li children from .member & kill it
				var ul = u.qs("ul.navigation", this.nN);
				var level0 = u.qsa("li.indent0", ul);
				var sib = u.qs("li.interview", ul);
				var kill = u.qs("li.member", ul);
				ul.removeChild(kill);
				var li_height = 64;
				var node, i, j, li, sub_li;;
				for (i = 0; node = level0[i]; i++) {
					//u.ae(this.nN, node);
					ul.insertBefore(node, sib	);
				}

				// loop and fold sub navigation
				for (i = 0; li = level0[i]; i++) {
					
					// loop and fold second level first
					var level1 = u.qsa("li.indent1", li);
					for (j = 0; sub_li = level1[j]; j++) {
						if (!u.hc(sub_li, "selected")) {
							if (!u.hc(sub_li, "path")) {
								u.as(sub_li, "height", li_height+"px");
							}
						}
					}

					// click sublevel groups
					li.h4 = u.qs("h4", li);
					li.h4.node = li;
					li.h4.clicked = function(event) {

						this.node.transitioned = function() {
							u.a.transition(this, "none");
							u.e.drag(page.nN, [0, window.innerHeight-page.nN.offsetHeight, page.nN.offsetWidth, page.nN.offsetHeight], {"strict":false, "elastica":200});
						}
						// FOLD
						if (this.open) {
							this.open = false;
							u.a.transition(this.node, "all 0.4s ease-out");
							u.a.setHeight(this.node, li_height);
						}
						// OPEN
						else {
							this.open = true;
							u.a.transition(this.node, "all 0.4s ease-in");
							u.a.setHeight(this.node, this.node.org_height)
						}
					}
					u.ce(li.h4);


					// Store height after folding second level.
					li.org_height = li.offsetHeight;


					// LEVEL 1 - FOUND PATH
					if (u.hc(li, "path")) {
						li.h4.open = true;
					}
					// NOT ACTIVE - FOLD
					else {
						li.h4.open = false;
						u.as(li, "height", li_height+"px");
					}
				}
				

				// add selected class - add li.selected to "fake" nav
				var nav_list = u.qsa("li", ul);
				for (i = 0; node = nav_list[i]; i++) {
					
					// find current page -> navigation relation
					if(u.hc(document.body, node.className) || u.hc(node, "selected")) {
						
						this.active_menu = node;
						u.ac(node, "selected");

						// add active menu node to dummy menu
						var clone = node.cloneNode(true);
						u.ie(nav, clone);

					}
					
					// not current - remove class
					else {
						if (u.hc(node, "selected")) {
							u.rc(node, "selected");
						}
					}
				}



			}


			// initialize navigation elements
			page.initFooter = function() {

				var sponsor = u.qs(".sponsors", page.fN)
				var sponsor_h5 = u.qs("h5", sponsor);
				var sponsor_ul = u.qs("ul", sponsor);
				sponsor_ul.org_height = sponsor_ul.offsetHeight;
				u.as(sponsor_ul, "height", "0px");

				sponsor_ul.transitioned = function() {
					u.a.transition(this, "none");
				}

				sponsor_h5.clicked = function(event) {
					u.a.transition(sponsor_ul, "all 0.4s ease-out");

					if (!this.open) {
						this.open = true;
						u.as(sponsor_ul, "height", sponsor_ul.org_height+"px");
					}
					// close
					else {
						this.open = false;
						u.as(sponsor_ul, "height", "0px");
					}
				}
				u.ce(sponsor_h5);
			}

			// ready to start page builing process
			page.ready();


		//}
	}
}

u.e.addDOMReadyEvent(u.init);








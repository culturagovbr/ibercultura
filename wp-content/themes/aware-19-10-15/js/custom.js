/**
 * Custom Javascript for Aware
 *
 * @package WordPress
 * @subpackage Aware
 * @since Aware 1.4
 */
	
// Set jQuery to NoConflict Mode
jQuery.noConflict();

// Utility for creating objects in older browsers
if ( typeof Object.create !== 'function' ) {
  Object.create = function( obj ) {

    function F() {}
    F.prototype = obj;
    return new F();

  };
}

/**
 * Ajax load post function
 */
(function($, window, document, undefined)
{
  var pluginName = 'ajaxHomepage';
  var storageName = 'plugin_' + pluginName;

  var homepageAjax = {

  	/**
  	 * Initialize plugin namespace and variables
  	 */
    init : function(options, element) {
      var self = this;

      // Initialise options
      self.options = $.extend(true, {}, $.fn.ajaxHomepage.options, options);

      // Set plugin event namespace
      self.namespace = '.' + pluginName + '.' + new Date().getTime();

      // Store current element
      self.element = element;
      self.$element = $(element);

      // Init your plugin stuff here
      self.$body = $('body');
      self.initialOpen = self.options.opened;
      self.ajaxouter = '#ajaxouter'; /* Outer Container  */
      self.loadingContainer = '#loadingcontainer'; /* Loading Container */
      self.ajaxContainer = $('#ajaxcontainer');
      self.loadingImage = $('.ajaxloading'); /* Loading Image */
      self.clicked = null;

      // Bind events after intialisation
      self.bind();

      // Return plugin instance
      return self;
    },

    /**
     * Bind original click events
     */
    bind : function() {
      var self = this;

      // click event binding
      $(self.options.items).each(function(){
      	$(this).click(function(e){
      		self.clicked = this; // store clicked item globally
	      	self.loadPost(self.clicked, self);
	      	e.preventDefault();
      	});
      });

      self.testOpened();
    },

    testOpened : function() {
    	var self = this;

    	if (self.options.opened) {
    		self.options.opened = !self.options.opened; // reset opened var
			$(self.options.items).first().one().click();	
    	}
    },

    /**
     * In case you need to destroy this
     */
    destroy : function() {
      var self = this;

      // Remove all binds from element
      self.$element.off(self.namespace);
      // Remove plugin instance from object
      self.$element.removeData(storageName);
    },

    /**
     * Load clicked post
     */
    loadPost : function(clicked, self) {
		var postID = $(clicked).attr('data-url'); // get ID

		if ( self.options.opened ) { 
	    	self.toggleAjaxHeight(); // toggle height closed if already open
		}

      self.ajaxLoad(postID); // call ajax function
    },

    /**
     * Load post controls
     */
    controls : function() {
    	var self = this;

    	self.findPrevNext(); // prev/next links
    	self.xOut(); // xout functionality
    },

    /**
     * X Out Method
     */
    xOut : function(e) {
    	var self = this;

    	$('a.portfolio-close').click(function(e){
	    	if ( self.options.opened ) { 
		    	self.toggleAjaxHeight(true); // toggle height closed if already open
		    	self.scrollWindow('body'); // scroll to the loading container
			}
    		e.preventDefault();
    	});
    },

    /**
     * Finds previous or next items
     * @return {string}          Selector of Previous or Next Item
     */
    findPrevNext : function() {
		var self = this,
    		$item = $(self.clicked), // store item
    		prevNextItem = nextItem = prevItem = $item, // previous and next item reset
    		i = ii = 0; // counter reset

    	// If we're at the same item OR next item has no opacity OR next item disable is on
    	while ( nextItem == $item || nextItem.css('opacity') == 0 || nextItem.find('.disable').css('display') == 'block') {
			// store next item
			nextItem = nextItem.closest('.portfolioitem').next('.portfolioitem'); 

			// prevent infinite loops
			if (i == 100) { console.log('No next Items'); break; } i++; 
    	}

		// If we're at the same item OR previous item has no opacity OR previous item disable is on
    	while ( prevItem == $item || prevItem.css('opacity') == 0 || prevItem.find('.disable').css('display') == 'block') {
    		// store prev item
    		prevItem = prevItem.closest('.portfolioitem').prev('.portfolioitem'); 

    		// prevent infinite loops
    		if (ii == 100) { console.log('No Previous Items'); break; } ii++; 
    	}

    	if ( nextItem.length == 0 ) { // if there's no next item
    		$('#next-port').stop().fadeOut();
    	} else {
    		$('#next-port').stop().fadeIn();
    	}

    	if ( prevItem.length == 0 ) { // if there's no prev item
			$('#prev-port').stop().fadeOut();
    	} else {
    		$('#prev-port').stop().fadeIn();
    	}

		// store prev/next in same variable
    	prevNextItem = nextItem; 
    	prevNextItem.previousItem = prevItem;

		self.nextPost(prevNextItem); // run next post click events
		self.prevPost(prevNextItem); // run prev post click events
    },

    /**
     * Next Post Method
     */
    nextPost : function(nextPost) {
    	var self = this,
    		nextPostLink = nextPost.find('a.ajax-portfolio').first(); // find next post link

    	$('#next-port').click(function(e){
    		nextPostLink.click();
    		e.preventDefault();
    	});
    },

    /** 
     * Previous Post Method
     */
    prevPost : function(prevPost) {
    	var self = this,
    		prevPostLink = prevPost.previousItem.find('a.ajax-portfolio').first(); // find prev post link

    	$('#prev-port').click(function(e){
    		prevPostLink.click();
    		e.preventDefault();
    	});
    },

    /**
     * Turn on/off loading animation
     * @param  {bool} state Fade in/out the loading image
     */
    loadingAnimation : function(state) {
    	var self = this;

    	if (state) {
    		self.loadingImage.stop().fadeIn(500);    		
    	} else {
    		self.loadingImage.stop().fadeOut(500);
    	}
    },

    /**
     * Scrolls the window
     * @param  {string} here Name of selector to scroll to
     */
    scrollWindow : function(here) {
    	var self = this,
    		$viewport = $('html,body');

		$viewport
			.stop()
			.animate({scrollTop: $(here).offset().top}, 2000, 'easeOutCubic')                
			.bind("scroll mousedown DOMMouseScroll mousewheel keyup", function (e) {
		        if (e.which > 0 || e.type === "mousedown" || e.type === "mousewheel") {
		            $viewport.stop()
		            // This identifies the scroll as a user action, stops the animation, then unbinds the event straight after
		            .unbind('scroll mousedown DOMMouseScroll mousewheel keyup');
		        }
			});
    },

    /**
     * Opens and closes the ajax container
     */
    toggleAjaxHeight : function(remove) {
    	var self = this;

        self.ajaxContainer.stop().animate({ height: "toggle"}, 500, 'easeOutCubic', function(){
        	if (remove) {
        		$(self.ajaxouter).empty(); // remove what's currently inside
        	}
        }); // toggle height
        self.options.opened = !self.options.opened; // switch opened variable
    },

    /**
     * Loads post output via ajax
     */
    ajaxLoad : function(postID) {
    	var self = this;

    	jQuery.ajax({
		        type: 'POST',
		        url: twAjax.ajaxurl,
		        data: {
		        'action': 'themewich_load_home_post', 
		        'postID': postID,
		        'cache' : false 
	        },
	        beforeSend: function() { 
	        	self.loadingAnimation(true); // fade in loading animation
	        	if ( ! self.initialOpen ) { // if inital open isn't set to true
	        		self.scrollWindow(self.loadingContainer); // scroll to the loading container
	        	}
	        	self.initialOpen = false;
	        },
	        success: function(data, textStatus, XMLHttpRequest) {
				if(data) { // Are there items in the response
					$.each(data, function(idx,item) { // For each item in the array
						$newItems = data.output; // load the output
					});
				} else { console.log("There are no items to get."); } // if nothing if found

				$(self.ajaxouter).html($newItems).promise().done(function(){
					self.afterLoad();
			    });
	        },
	        error: function(MLHttpRequest, textStatus, errorThrown) {
	        	console.log(errorThrown);
	        	console.log(MLHttpRequest);
	        },
	        complete: function(XMLHttpRequest, textStatus) {
	        	console.log(textStatus);
	        },
	        dataType: 'json'
	    });
    },

    /**
     * Functions to run after content is loaded
     */
    afterLoad :function() {
    	var self = this;

    	// Hide slideshow temporarily
		$('.projectslideshow').css({
			'opacity' : 0
		});

		// reload controls
		self.controls(); 

		// toggle height if not open
		if ( ! self.options.opened ) { 
	   		self.toggleAjaxHeight(); 
	    }

        // reload slider
		$('.projectslideshow').projectSlideShows();

		// reload lightbox
		$("a[rel^='prettyPhoto']").themewichLightbox(); 

		// reload fitvids
		$(".videocontainer").fitVids();

		// fade out loading animation
		self.loadingAnimation(false);   
    }

  };

  $.fn.ajaxHomepage = function(options) {
    var args = Array.prototype.slice.call(arguments);

    return this.each(function() {

      var pluginInstance = $.data(this, storageName);
      if(typeof options === 'object' || options === 'init' || ! options) {
        if(!pluginInstance) {
          if(options === 'init') {
            options = args[1] || {};
          }

          pluginInstance = Object.create(homepageAjax).init(options, this);
          $.data(this, storageName, pluginInstance);
        } else {
          $.error('Plugin is already initialized for this object.');
          return;
        }
      } else if(!pluginInstance) {
        $.error('Plugin is not initialized for this object yet.');
        return;
      } else if(pluginInstance[options]) {
        var method = options;
        options = args.slice(1);
        pluginInstance[method].apply(pluginInstance, options);
      } else {
        $.error('Method ' +  options + ' does not exist on jQuery.' + pluginName + '.');
        return;
      }

    });

  };

  $.fn.ajaxHomepage.options = {
    items : 'a.ajax-portfolio',
	opened : false
  };

})(jQuery, window, document);

(function ($) {
	"use strict";

	/**
	 * Loads loading image on page load of homepage
	 * @since v1.4
	 * (c) Copyright 2014 Andre Gagnon - http://themewich.com
	 */
	$.fn.homeLoad = function(slideshowpreload){
		var ajaxLoading = $(this),
			slideshowpreload = $(slideshowpreload);

		ajaxLoading.fadeIn(500);
		$(window).load(function(){ 
			ajaxLoading.fadeOut(500);
			slideshowpreload.fadeOut(500); 
		});
	}

	/**
	 * Sticks footer to the bottom of the page if content isn't long enough
	 * @since v1.4
	 * (c) Copyright 2014 Andre Gagnon - http://themewich.com
	 */
	$.fn.stickyFooter = function(options) {
    	var footer = this;
       
    	positionFooter();
 
    	$(window)
        	.scroll(positionFooter)
        	.resize(positionFooter);
 
    	function positionFooter() {
        	var docHeight = $(document.body).height() - $("#sticky-footer-push").height();

        	if(docHeight < $(window).height()){
          		var diff = $(window).height() - docHeight;

          		if (!$("#sticky-footer-push").length > 0) {
            		$(footer).before('<div id="sticky-footer-push"></div>');
          		}

          		$("#sticky-footer-push").height(diff);
        	}
      	}
	}


	/**
	 * Runs isotope on the site
	 * @since v1.4
	 * (c) Copyright 2014 Andre Gagnon - http://themewich.com
	 */
	$.fn.themewichIsotope = function() {

		function runIsotope() {
    		var $container = $('div.isotopecontainer');  

	        $container.each(function() {
	            var $this = $(this),
	                columnNumber = $this.attr('data-value'),
	                isoBrick = $('.isobrick'),
	                $colnum2;

                isoBrick.css({
                    'margin-left': 0,
                    'margin-right': 0 
                });
          
				/**
				 * Calculate column number
				 */
				if ($this.width() < 500 ) {
					$colnum2 = 2;
				} else {
					$colnum2 = columnNumber;
				}

				/**
				 * Call Isotope with selected Columns
				 */
				if (columnNumber != '1') {
                	$this.isotope({
                		masonry: {
                    		columnWidth: $this.width() / $colnum2
                    	},
                    	itemSelector : '.isobrick',
                    	layoutMode : 'masonry'
                  	});
                }

                /**
			     * Filter functionality
			     */
				$('.filtershuffle a').click(function(e){
					var $clicked = $(this),
						$selector = $clicked.attr('data-value');

				    $('.filtershuffle li').removeClass("active");
					$clicked.closest('li').addClass('active');
				      
					if ($selector != '*') {
						$selector = '.'+$selector;
					}

					// filter isotope
					$this.isotope({ filter: $selector }, function() {
            //$('.my-isotope.hidden').removeClass('my-isotope-hidden');
						$('.slideshowcontainer').ajaxHomepage('findPrevNext');
            //$('.isotope-item:not(.isotope-hidden):gt(6)').addClass('my-isotope-hidden');

					});
				    
					e.preventDefault();
				});
	        });
	    }

		$(window).load(runIsotope);
		$(window).resize(runIsotope);
	}

	/**
	 * Fades in/out block
	 * @since v1.4
	 * (c) Copyright 2014 Andre Gagnon - http://themewich.com
	 */
	$.fn.filterFade = function() {

		function showHideBlock(filter) {
			var $items 		= $('.portfolioitem .disable'),
				$slideshow 	= $('.slideshowcontainer');

			// if not all filter
			if ( filter != '*') {

				// Check each item
				$items.each(function() {
					var $item = $(this);
					
					// if item doesn't have the filtervalue, show the blocker
					if ( ! $item.hasClass(filter) ) { 
						$item.css('display', 'block')
						.stop().animate({opacity: .95}, 500);
					// else, hide the blocker
					} else {
						$item.stop().animate({opacity: 0}, 500)
						.css('display', 'none');
					}
				});

				// reset arrows
				resetArrows($slideshow); 

			} else {
				// if filter is all
				$items.stop().animate({opacity: 0}, 500, function(){
	            	$items.css('display', 'none');
					resetArrows($slideshow);
            	});
			}
		}

		// Reset prev/next arrows
		function resetArrows(slideshow) {
			slideshow.ajaxHomepage('findPrevNext');
		}

		// Click event
		$('ul.filterfade a').click(function(e) {
			var $clicked = $(this),
				filterVal = $clicked.attr('data-value'); // get clicked slug

			// Filter click classes
			$('ul.filter .active').removeClass('active');
			$(this).parent().addClass('active');

			showHideBlock(filterVal); // run function

			e.preventDefault();

		}); // filterfade click
	}

	/**
	 * Runs tab script
	 * @since v1.4
	 * (c) Copyright 2014 Andre Gagnon - http://themewich.com
	 */
	$.fn.themewichAwareTabs = function() {
		this.tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
		this.find('li').removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
		this.tabs({ fx: { opacity: 'toggle' } });
	}

	/**
	 * Runs lightbox script
	 * @since v1.4
	 * (c) Copyright 2014 Andre Gagnon - http://themewich.com
	 */
	$.fn.themewichLightbox = function() {
		var lighboxSkin = $('body').attr('data-lightbox') ? $('body').attr('data-lightbox') : 'light_square';
		
		$(this).prettyPhoto({
			animation_speed: 'fast', /* fast/slow/normal */
			slideshow: 5000, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: false, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			default_width: 500,
			default_height: 344,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: lighboxSkin, /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			horizontal_padding: 20, /* The padding on each side of the picture */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
			overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
			callback: function(){}, /* Called when prettyPhoto is closed */
			ie6_fallback: true
		});
	}

	/**
	 * Controls hover effects
	 * @since v1.4
	 * (c) Copyright 2014 Andre Gagnon - http://themewich.com
	 */
	$.fn.themewichHovers = function() {
		function hover_overlay() {
	        $('.flexslider .slides').each(function() {
                var $this = $(this),
                 	$background = $this.closest('.portfolioitem');

                $this.hover( function() {
                  	  $background.addClass('darkbg');
                      $this.stop().animate({opacity : 0.1}, 500);
                }, function() {
                    $this.stop().animate({opacity : 1}, 500, function(){
                    	$background.removeClass('darkbg');
                	});
                });
	        });
	    }
   		hover_overlay(); // run function

		function hover_overlay_slide() {
			$('.video').hover( function() {
            	$(this).stop().animate({opacity : 1}, 100);
        	}, function() {
            	$(this).stop().animate({opacity : .9}, 100);
        	});
    	}  
    	hover_overlay_slide(); // run function
    
		function hover_overlay_images() {
			$('a img').not('#featuredle a img, .themewich-slider a img').hover( function() {
            	$(this).stop().animate({opacity : 0.7}, 500);
        	}, function() {
            	$(this).stop().animate({opacity : 1}, 500);
        	});
   		}
    	hover_overlay_images(); // run function
	}

	/**
	 * Controls top drawer
	 * @since v1.4
	 * (c) Copyright 2014 Andre Gagnon - http://themewich.com
	 */
	$.fn.topWidgetDrawer = function() {
		var height = $('#top_panel_content').height();
		
		$('#top_panel_button').click(function() {
			var docHeight = $(document).height(),
				windowHeight = $(window).height(),
				scrollPos = docHeight - windowHeight + height;
        console.log(height);
			$('#top_panel_content').animate({ height: "toggle"}, 500, 'easeOutCubic');
        	$('#toggle_button').toggleClass("downarrow");
       		$('#top_panel').removeClass('active');
			$(this).addClass('active');
		});
	}

	/**
	 * Scroll top function
	 * @since v1.4
	 * (c) Copyright 2014 Andre Gagnon - http://themewich.com
	 */
	$.fn.scrollTop = function() {
		var top = $(this);
							   
		$(window).scroll(function () {				   
		 	var y_scroll_pos = window.pageYOffset,
		   		scroll_pos_test = 50;
			
		    if ( y_scroll_pos > scroll_pos_test ) {
		        top.stop().fadeIn(1000);
		        $('.iphone').children('.top').css('display', 'none !important');
			} else { 
				top.stop().fadeOut(500);
		    }
		});

		top.click(function(e){
			$('html, body').animate({scrollTop:0}, 500, 'easeOutCubic');
			e.preventDefault();
		});
	}

	/**
	 * Homepage mini slideshows
	 * @since v1.4
	 * (c) Copyright 2014 Andre Gagnon - http://themewich.com
	 */
	$.fn.homeMiniSlideshows = function() {
		var $body = $('body');

		this.each(function() {
        	var $this = $(this);
        		$this.flexslider({
					animation: "fade",              //String: Select your animation type, "fade" or "slide"
					slideDirection: "vertical",   //String: Select the sliding direction, "horizontal" or "vertical"
					slideshow: ($body.hasClass('mini-slideshows')) ? true : false, //Boolean: Animate slider automatically
					slideshowSpeed: Math.floor(Math.random()*10001) + 3000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
					animationDuration: 2000,         //Integer: Set the speed of animations, in milliseconds
					directionNav: false,             //Boolean: Create navigation for previous/next navigation? (true/false)
					controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
					keyboardNav: false,              //Boolean: Allow slider navigating via keyboard left/right keys
					mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
					prevText: "Previous",           //String: Set the text for the "previous" directionNav item
					nextText: "Next",               //String: Set the text for the "next" directionNav item
					pausePlay: false,               //Boolean: Create pause/play dynamic element
					pauseText: 'Pause',             //String: Set the text for the "pause" pausePlay item
					playText: 'Play',               //String: Set the text for the "play" pausePlay item
					randomize: false,               //Boolean: Randomize slide order
					slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
					animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
					pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
					pauseOnHover: true,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
					controlsContainer: "",          //Selector: Declare which container the navigation elements should be appended too. Default container is the flexSlider element. Example use would be ".flexslider-container", "#container", etc. If the given element is not found, the default action will be taken.
					manualControls: "",             //Selector: Declare custom control navigation. Example would be ".flex-control-nav li" or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
					start: function(){},            //Callback: function(slider) - Fires when the slider loads the first slide
					before: function(){},           //Callback: function(slider) - Fires asynchronously with each slider animation
					after: function(){},            //Callback: function(slider) - Fires after each slider animation completes
					end: function(){}               //Callback: function(slider) - Fires when the slider reaches the last slide (asynchronous)					
										
			});
		});
	},

	$.fn.projectSlideShows = function() {
		var $slideshows = $(this);

		// Project slideshows
		$slideshows.each(function(){
			var slideshow = $(this),
				wrapper = slideshow.closest('div.info'),
				autoplay = (wrapper.attr('data-autoplay') == 'true') ? true : false,
				delay = ( wrapper.attr('data-autoplay-delay') ) ? wrapper.attr('data-autoplay-delay') + '000' : '5000';

			if (slideshow.find('img').length > 1) {

        slideshow.bxSlider({ 
          mode: 'fade',
          auto: autoplay,
          pause: delay,
          adaptiveHeight: true,
          onSliderLoad: function(){
            // Remove min-height and loading image
            var slideshowH = slideshow.height(),
              viewportH = slideshow.find('span:first-child img').height();

            wrapper.height(slideshowH).animate({
              height: viewportH,
              opacity : 1,
              background : 'none'
            }, 1000, 'easeOutCubic', function(){
              wrapper
                .css({
                  height : 'auto',
                  background : 'none'
                });
            });

              }
        }); 

      } else {
        wrapper.css({'height': 'auto'}).animate({'opacity': 1}, 500);
      }
		});
	}

	// Run functions on document ready
	$(document).ready(function(){
    //jQuery("#featuredle .content").remove()
    jQuery('#featuredle').orbit({
      animation: "vertical-slide",
      animationSpeed: 800,
      timer: true,
      advanceSpeed: 5000,
      pauseOnHover: false,
      directionalNav: true,
      captions: true,
      captionAnimation: "none",
      captionAnimationSpeed: 800,
      bullets: true,
      bulletThumbs: false,
      centerBullets: false,
      fluid: true
    });
//jQuery("#featuredle").orbit({bullets: false, fluid: true});

		// preloading image on homepage
		$('.ajaxloading').homeLoad('.slideshowpreload');

		// Homepage ajax function
		$('.slideshowcontainer').ajaxHomepage({
			opened : $('body').hasClass('slideshow-open') ? true : false
		});

		// Home mini slideshows
		$('.flexslider').homeMiniSlideshows();

		// Project slideshows
		$('.projectslideshow').projectSlideShows();

		// sticky footer
		$('#footer').stickyFooter();

		// Run Isotope
		if ( $.fn.isotope ) {
			$('body').themewichIsotope();
		}

		// Run superfish
		$('ul.sf-menu').superfish({ 
            autoArrows:  true
        });

    // Run Tabs
    if ($.fn.tabs) {
    	$('#tabs').themewichAwareTabs();
    } 

    // Run Lightbox
    $("a[rel^='prettyPhoto']").themewichLightbox();

    // Filter fade
    $('body').filterFade();

    // Hover effects
    $('body').themewichHovers();

    // Top Widget Drawer
    $('body').topWidgetDrawer();

    // Scroll top function
    $('.top').scrollTop();

    // Fitvids script
    $(".videocontainer").fitVids();

    // Form validation
    $("#contactform, #quickform, #commentsubmit").validate();

    // aumentando a fonte
    jQuery(".contraste").click(function () {
      if(jQuery("body .sitecontainer").css("backgroundColor")=="rgb(0, 0, 0)"){
        jQuery("body .sitecontainer").css("background-color","");
        jQuery("body .sitecontainer a").css("color","");
        jQuery("body #top_panel").css("color","");
        jQuery("body #top_panel").css("background-color","");
        jQuery("body #footer").css("background-color","");
        jQuery("body #footer a").css("color","");
      }else{
        jQuery("body .sitecontainer").css("background-color","black");
        jQuery("body .sitecontainer a").css("color","white");
        jQuery("body #top_panel").css("background-color","black");
        jQuery("body #top_panel").css("color","white");
        jQuery("body #footer").css("background-color","black");
        jQuery("body #footer a").css("color","white");
      }
     console.log();
      
    });

    $(".inc-font").click(function () {
      
      var size = $("body").css('font-size');

      size = size.replace('px', '');
      size = parseInt(size) + 1.4;
      console.log(size);
      jQuery("body").animate({'font-size' : size + 'px'});
      jQuery(".nav ul li a").animate({'font-size' : size + 'px'});
      jQuery("p").animate({'font-size' : size + 'px'});
      jQuery("h3 a").animate({'font-size' : size + 'px'});
      jQuery("h4 a").animate({'font-size' : size + 'px'});
      jQuery("h5 a").animate({'font-size' : size + 'px'});
    });

    $(window).scroll(function(e){
	var pos = window.scrollY,
	    compactaHeader = function() {
		$('#top_panel').css('position', 'fixed');
		$('#top_panel').css('z-index', '2000');

		$('#searchbox').hide(200);
		$('.topcontent').hide(200);
		//$('#qtranslate-3').hide(200);
		//$('#acessibilidade').hide(200);		
		$('#redes-sociais').hide(200);
	    },
	    expandeHeader = function() {
		$('#top_panel').css('position', 'relative');
		
		$('#searchbox').show(200);		
		$('.topcontent').show(200);		
		//$('#qtranslate-3').show(200);
		//$('#acessibilidade').show(200);		
		$('#redes-sociais').show(200);
	    }
	if (pos > 0) {
	    compactaHeader();
	} else {
	    expandeHeader();
	}
    });
	    
    //diminuindo a fonte
    $(".dec-font").click(function () {
      var size = $("body").css('font-size');

      size = size.replace('px', '');
      size = parseInt(size) - 1.4;

      jQuery("body").animate({'font-size' : size + 'px'});
      jQuery(".nav ul li a").animate({'font-size' : size + 'px'});
      jQuery("p").animate({'font-size' : size + 'px'});
      jQuery("h3 a").animate({'font-size' : size + 'px'});
      jQuery("h4 a").animate({'font-size' : size + 'px'});
      jQuery("h5 a").animate({'font-size' : size + 'px'});
    });

    // resetando a fonte
    $(".res-font").click(function () {
      size = 10;
      jQuery("body").animate({'font-size' : '10px'});
      jQuery(".nav ul li a").animate({'font-size' : size + 'px'});
      jQuery("p").animate({'font-size' : size + 'px'});
      jQuery("h3 a").animate({'font-size' : size + 'px'});
      jQuery("h4 a").animate({'font-size' : size + 'px'});
      jQuery("h5 a").animate({'font-size' : size + 'px'});
    });

    // efeito no campo de busca 	  
    $('#top_panel input#s').focus(function() {
	    $('#top_panel input#s').animate({width : '90%'}, 100);	
    });
	    
    $('#top_panel input#s').blur(function() {
	     $('#top_panel input#s').val('Buscar...');
	     $('#top_panel input#s').animate({width : '20%'}, 100);	
    });

	    
    $('.alpha-home ul li a').click(function(e){
     
      e.preventDefault();
      
      $('.isobrick').hide();
      if($(this).attr('data-value')!="*"){
        $('.isobrick.'+$(this).attr('data-value')+':lt(6)').show('fast');
      }else{
        $('.isobrick:lt(6)').show('fast');
      }
      
     
    });	    

	});	
})(jQuery);

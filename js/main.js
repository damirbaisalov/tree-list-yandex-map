(function($){
	"use strict";
	// PRELOADER JS CODE
    jQuery(window).on('load',function(){
        jQuery(".loader-box").fadeOut(500);
    });
    // END PRELOADER JS CODE
	$(document).on('ready', function(){
		
		// START MENU JS CODE
		$(window).on('scroll', function() {
			if ($(this).scrollTop() > 100) {
				$('.navbar-expand-lg').addClass('menu-shrink animated slideInDown');
			} else {
				$('.navbar-expand-lg').removeClass('menu-shrink animated slideInUp');
			}
		});	
		
		$('.navbar-nav li a').on('click', function(e){
			var anchor = $(this);
			$('html, body').stop().animate({
				scrollTop: $(anchor.attr('href')).offset().top - 50
			}, 1000);
			e.preventDefault();
		});
		
		$(document).on('click','.navbar-collapse.in',function(e) {
			if( $(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle' ) {
				$(this).collapse('hide');
			}
		});	
		
		$('.navbar-nav>li>a').on('click', function(){
			$('.navbar-collapse').collapse('hide');
		});
		
		$('.top-bottom a').on('click', function(e){
			var anchor = $(this);
			$('html, body').stop().animate({
				scrollTop: $(anchor.attr('href')).offset().top - 50
			}, 1000);
			e.preventDefault();
		});
		// END MENU JS CODE
		
		// HOME SLIDER JS CODE
		$('.home-slider').owlCarousel({
			items:1,
			autoplay:true,
			autoplayHoverPause: true,
			dots: true,
			loop:true,
			slideSpeed: 300,
			paginationSpeed: 400,
			mouseDrag: true,
			singleItem: true,
			animateIn: 'fadeIn',
			animateOut: 'fadeOut',
			nav:true,
			pullDrag:true,
			navText: ["<i class='icofont-thin-left'></i>", "<i class='icofont-thin-right'></i>"],
		});
		
		$(".home-slider").on("translate.owl.carousel", function(){
			$(".benner-text h1").removeClass("animated fadeInUp").css("opacity", "0");
			$(".benner-text p").removeClass("animated fadeInDown").css("opacity", "0");
			$(".benner-text span").removeClass("animated fadeInDown").css("opacity", "0");
			$(".benner-text .slide-btn").removeClass("animated zoomIn").css("opacity", "0");
		});
		$(".home-slider").on("translated.owl.carousel", function(){
			$(".benner-text h1").addClass("animated fadeInUp").css("opacity", "1");
			$(".benner-text p").addClass("animated fadeInDown").css("opacity", "1");
			$(".benner-text span").addClass("animated fadeInDown").css("opacity", "1");
			$(".benner-text .slide-btn").addClass("animated zoomIn").css("opacity", "1");
		});
		// END HOME SLIDER JS CODE
		
		// WOW JS CODE
		new WOW().init();
		
		// SKILLS JS CODE
		$(".skills").addClass("active")
		$(".skills .skill .skill-bar span").each(function() {
		   $(this).animate({
			  "width": $(this).parent().attr("data-bar") + "%"
		   }, 1000);
		   $(this).append('<b>' + $(this).parent().attr("data-bar") + '%</b>');
		});
		setTimeout(function() {
		   $(".skills .skill .skill-bar span b").animate({"opacity":"1"},1000);
		}, 2000);
		
		var TxtType = function(el, toRotate, period) {
			this.toRotate = toRotate;
			this.el = el;
			this.loopNum = 0;
			this.period = parseInt(period, 10) || 2000;
			this.txt = '';
			this.tick();
			this.isDeleting = false;
		};

		TxtType.prototype.tick = function() {
			var i = this.loopNum % this.toRotate.length;
			var fullTxt = this.toRotate[i];

			if (this.isDeleting) {
			this.txt = fullTxt.substring(0, this.txt.length - 1);
			} else {
			this.txt = fullTxt.substring(0, this.txt.length + 1);
			}

			this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

			var that = this;
			var delta = 200 - Math.random() * 100;

			if (this.isDeleting) { delta /= 2; }

			if (!this.isDeleting && this.txt === fullTxt) {
			delta = this.period;
			this.isDeleting = true;
			} else if (this.isDeleting && this.txt === '') {
			this.isDeleting = false;
			this.loopNum++;
			delta = 500;
			}

			setTimeout(function() {
			that.tick();
			}, delta);
		};

		window.onload = function() {
			var elements = document.getElementsByClassName('typewrite');
			for (var i=0; i<elements.length; i++) {
				var toRotate = elements[i].getAttribute('data-type');
				var period = elements[i].getAttribute('data-period');
				if (toRotate) {
				  new TxtType(elements[i], JSON.parse(toRotate), period);
				}
			}
			// INJECT CSS
			var css = document.createElement("style");
			css.type = "text/css";
			css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
			document.body.appendChild(css);
		};
		// END SKILLS JS CODE
		
		// POPPUP GALLERY JS CODE
		$('.popup-gallery').magnificPopup({
			type: 'image',
			gallery: {
				enabled: true,
			},
		}); 
		// END POPPUP GALLERY JS CODE
		
		// MIXITUP JS CODE
		$('#shorting, .s-container').mixItUp();
		// END MIXITUP JS CODE
		
		//POPUP VIDEO JS CODE
		$('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
			disableOn: 320,
			type: 'iframe',
			mainClass: 'mfp-fade',
			removalDelay: 160,
			preloader: false,
			fixedContentPos: false
		});
		//END POPUP VIDEO JS CODE
		
		//COUNTER JS CODE
		$('.counter').counterUp({
			delay: 10,
			time: 1000
		});
		//END COUNTER JS CODE
		
		// CLIENT SLIDER JS CODE
		$(function() {
			$('.client-slider').owlCarousel({
			dots: false,
			loop:true,
			autoplay:true,
			autoplayHoverPause:true,
			nav:true,
			navText: ["<i class='icofont-thin-left'></i>", "<i class='icofont-thin-right'></i>"],
			responsive: {
				0: {
					items: 1,
				},
				992: {
					items: 2,
					}
				}
			});
		});
		// END CLIENT SLIDER JS CODE
		
		//CLIENTS SLIDER JS CODE
		$('.clients-slider').owlCarousel({
			loop:true,
			margin:10,
			nav:false,
			dots:true,
			autoplay:true,
			autoplayHoverPause:true,
			responsive:{
				0:{
					items:2
				},
				600:{
					items:3
				},
				768:{
					items:4
				},
				1000:{
					items:5
				}
			}
		})
		//END CLIENTS SLIDER JS CODE
		
		//PARTICLES JS CODE
		if(document.getElementById("particles-js")) particlesJS("particles-js", {
		  "particles": {
			"number": {
			  "value": 500,
			  "density": {
				"enable": true,
				"value_area": 1200
			  }
			},
			"color": {
			  "value": "#efefef"
			},
			"shape": {
			  "type": "circle",
			  "stroke": {
				"width": 0,
				"color": "#000000"
			  },
			  "polygon": {
				"nb_sides": 3
			  },
			  "image": {
				"src": "img/github.svg",
				"width": 100,
				"height": 100
			  }
			},
			"opacity": {
				"value": 0.5,
				"random": true,
				"anim": {
				"enable": false,
				"speed": 1,
				"opacity_min": 0.1,
				"sync": false
			}
			},
			"size": {
				"value": 5,
				"random": true,
				"anim": {
				"enable": false,
				"speed": 40,
				"size_min": 0.1,
				"sync": false
			  }
			},
			"line_linked": {
			  "enable": false,
			  "distance": 500,
			  "color": "#e24c89",
			  "opacity": 0.4,
			  "width": 2
			},
			"move": {
			  "enable": true,
			  "speed": 5,
			  "direction": "bottom",
			  "random": true,
			  "straight": false,
			  "out_mode": "out",
			  "bounce": false,
			  "attract": {
				"enable": false,
				"rotateX": 600,
				"rotateY": 1200
			  }
			}
		  },
		  "interactivity": {
			"detect_on": "canvas",
			"events": {
			  "onhover": {
				"enable": false,
				"mode": "repulse"
			  },
			  "onclick": {
				"enable": false,
				"mode": "repulse"
			  },
			  "resize": true
			},
			"modes": {
			  "grab": {
				"distance": 400,
				"line_linked": {
				  "opacity": 0.5
				}
			  },
			  "bubble": {
				"distance": 400,
				"size": 4,
				"duration": 0.3,
				"opacity": 1,
				"speed": 3
			  },
			  "repulse": {
				"distance": 200,
				"duration": 0.4
			  },
			  "push": {
				"particles_nb": 4
			  },
			  "remove": {
				"particles_nb": 2
			  }
			}
		  },
		  "retina_detect": true
		});
		//END PARTICLES JS CODE

		// TOP BUTTON JS CODE
		$('body').append('<div id="toTop" class="top-arrow"><i class="icofont-scroll-long-up"></i></div>');
		$(window).on('scroll', function () {
			if ($(this).scrollTop() != 0) {
				$('#toTop').fadeIn();
			} else {
			$('#toTop').fadeOut();
			}
		}); 
		$('#toTop').on('click', function(){
			$("html, body").animate({ scrollTop: 0 }, 600);
			return false;
		});
		// END TOP BUTTON JS CODE
		
		// Subscribe form
		$(".newsletter-form").validator().on("submit", function (event) {
			if (event.isDefaultPrevented()) {
			// handle the invalid form...
				formErrorSub();
				submitMSGSub(false, "Please enter your email correctly.");
			} else {
				// everything looks good!
				event.preventDefault();
			}
		});

		function callbackFunction (resp) {
			if (resp.result === "success") {
				formSuccessSub();
			}
			else {
				formErrorSub();
			}
		}
		function formSuccessSub(){
			$(".newsletter-form")[0].reset();
			submitMSGSub(true, "Thank you for subscribing!");
			setTimeout(function() {
				$("#validator-newsletter").addClass('hide');
			}, 4000)
		}
		function formErrorSub(){
			$(".newsletter-form").addClass("animated shake");
			setTimeout(function() {
				$(".newsletter-form").removeClass("animated shake");
			}, 1000)
		}
		function submitMSGSub(valid, msg){
			if(valid){
				var msgClasses = "validation-success";
			} else {
				var msgClasses = "validation-danger";
			}
			$("#validator-newsletter").removeClass().addClass(msgClasses).text(msg);
		}
		// AJAX MailChimp
		$(".newsletter-form").ajaxChimp({
			url: "https://envytheme.us20.list-manage.com/subscribe/post?u=60e1ffe2e8a68ce1204cd39a5&amp;id=42d6d188d9", // Your url MailChimp
			callback: callbackFunction
		});
	});
    
}(jQuery));
(function($) {

	"use strict";

	$(window).stellar({
    responsive: true,
    parallaxBackgrounds: true,
    parallaxElements: true,
    horizontalScrolling: false,
    hideDistantElements: false,
    scrollProperty: 'scroll'
  });


	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	// loader
	var loader = function() {
		setTimeout(function() { 
			if($('#ftco-loader').length > 0) {
				$('#ftco-loader').removeClass('show');
			}
		}, 1);
	};

	if (title2 == 'Waluran Mandiri' || title2 == 'Daftar Blog') {
		loader();
	}

	// Scrollax
   $.Scrollax();

	var carousel = function() {
		$('.carousel-testimony').owlCarousel({
			center: true,
			loop: true,
			items:1,
			margin: 30,
			stagePadding: 0,
			nav: false,
			navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
			responsive:{
				0:{
					items: 1
				},
				600:{
					items: 2
				},
				1000:{
					items: 3
				}
			}
		});
		$('.carousel-destination').owlCarousel({
			center: false,
			loop: true,
			items:1,
			margin: 30,
			stagePadding: 0,
			nav: false,
			navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
			responsive:{
				0:{
					items: 1
				},
				600:{
					items: 2
				},
				1000:{
					items: 4
				}
			}
		});

	};
	carousel();

	$('nav .dropdown').hover(function(){
		var $this = $(this);
		// 	 timer;
		// clearTimeout(timer);
		$this.addClass('show');
		$this.find('> a').attr('aria-expanded', true);
		// $this.find('.dropdown-menu').addClass('animated-fast fadeInUp show');
		$this.find('.dropdown-menu').addClass('show');
	}, function(){
		var $this = $(this);
			// timer;
		// timer = setTimeout(function(){
			$this.removeClass('show');
			$this.find('> a').attr('aria-expanded', false);
			// $this.find('.dropdown-menu').removeClass('animated-fast fadeInUp show');
			$this.find('.dropdown-menu').removeClass('show');
		// }, 100);
	});


	$('#dropdown04').on('show.bs.dropdown', function () {
	  console.log('show');
	});

	// scroll
	var scrollWindow = function() {
		$(window).scroll(function(){
			var $w = $(this),
					st = $w.scrollTop(),
					navbar = $('.ftco_navbar'),
					sd = $('.js-scroll-wrap');

			if (st > 150) {
				if ( !navbar.hasClass('scrolled') ) {
					navbar.addClass('scrolled');	
				}
			} 
			if (st < 150) {
				if ( navbar.hasClass('scrolled') ) {
					navbar.removeClass('scrolled sleep');
				}
			} 
			if ( st > 350 ) {
				if ( !navbar.hasClass('awake') ) {
					navbar.addClass('awake');	
				}
				
				if(sd.length > 0) {
					sd.addClass('sleep');
				}
			}
			if ( st < 350 ) {
				if ( navbar.hasClass('awake') ) {
					navbar.removeClass('awake');
					navbar.addClass('sleep');
				}
				if(sd.length > 0) {
					sd.removeClass('sleep');
				}
			}
		});
	};
	scrollWindow();

	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
			BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
			iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
			Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
			Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
			any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};

	var counter = function() {
		
		$('#section-counter, .hero-wrap, .ftco-counter').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {

				var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')
				$('.number').each(function(){
					var $this = $(this),
						num = $this.data('number');
						console.log(num);
					$this.animateNumber(
					  {
					    number: num,
					    numberStep: comma_separator_number_step
					  }, 7000
					);
				});
				
			}

		} , { offset: '95%' } );

	}
	counter();


	var contentWayPoint = function() {
		var i = 0;
		$('.ftco-animate').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {
				
				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function(){

					$('body .ftco-animate.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							var effect = el.data('animate-effect');
							if ( effect === 'fadeIn') {
								el.addClass('fadeIn ftco-animated');
							} else if ( effect === 'fadeInLeft') {
								el.addClass('fadeInLeft ftco-animated');
							} else if ( effect === 'fadeInRight') {
								el.addClass('fadeInRight ftco-animated');
							} else {
								el.addClass('fadeInUp ftco-animated');
							}
							el.removeClass('item-animate');
						},  k * 50, 'easeInOutExpo' );
					});
					
				}, 100);
				
			}

		} , { offset: '95%' } );
	};
	contentWayPoint();


	// magnific popup
	$('.image-popup').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    closeBtnInside: false,
    fixedContentPos: true,
    mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
     gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0,1] // Will preload 0 - before current, and 1 after the current image
    },
    image: {
      verticalFit: true
    },
    zoom: {
      enabled: true,
      duration: 300 // don't foget to change the duration also in CSS
    }
  });

  $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
    disableOn: 700,
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,

    fixedContentPos: false
  });


  $('.checkin_date, .checkout_date').datepicker({
	  'format': 'm/d/yyyy',
	  'autoclose': true
	});

  	/**
	* GET ALL ARTIKEL (limit)
	*/
	if (title2 == 'Waluran Mandiri') {
		axios.get(`${BASE_URL}/artikel?orderby=terbaru&limit=6`)
		.then(res => {
			let elBerita  = '';
			let data = res.data.data;
			
			data.forEach(b => {
				let date      = new Date(parseInt(b.published_at) * 1000);
				let day       = date.toLocaleString("id-ID",{day: "numeric"});
				let month     = date.toLocaleString("id-ID",{month: "long"});
				let year      = date.toLocaleString("id-ID",{year: "numeric"});
	
				elBerita += `<div class="col-md-4 d-flex ftco-animate">
					<div class="blog-entry justify-content-end">
						<a href="blog-single.html" class="block-20"
							style="background-image: url(${b.thumbnail});">
						</a>
						<div class="text">
							<div class="d-flex align-items-center mb-4 topp">
								<div class="one">
									<span class="day">${day}</span>
								</div>
								<div class="two">
									<span class="yr">${year}</span>
									<span class="mos">${month}</span>
								</div>
							</div>
							<h3 class="heading"><a href="#">${b.title}</a></h3>
							<p><a href="${BASE_URL}/blog/baca?slug=${b.slug}" class="btn btn-primary">Read more</a></p>
						</div>
					</div>
				</div>`;
	
			});
			
			document.querySelector('#container-blog').innerHTML = elBerita;
			contentWayPoint();
		})
		.catch(err => {
			if (err.response.status == 404){
			}  
			else if (err.response.status == 500){
			}
		});
	}

	/**
	* GET DETIL ARTIKEL
	*/
	const params = new URL(window.location.href).searchParams;
	const SLUG   = params.get('slug'); 
	
	if (title2 == 'Baca Blog') {
		axios.get(`${BASE_URL}/artikel?slug=${SLUG}`)
		.then(res => {
			let data = res.data.data;
			let date      = new Date(parseInt(data.published_at) * 1000);
			let day       = date.toLocaleString("id-ID",{day: "numeric"});
			let month     = date.toLocaleString("id-ID",{month: "long"});
			let year      = date.toLocaleString("id-ID",{year: "numeric"});

			$('#hero #title').html(data.title);
			$('#hero #thumbnail').attr('style',`background-image: url(${data.thumbnail});background-repeat: no-repeat;background-size: cover;`);
			$('#hero #published_at').html(`${day}th ${month}, ${year}`);
			$('#hero #category').html(`<span class="badge badge-pill py-2 px-3 badge-light">#${data.kategori}</span>`);
			$('#content #body').html(data.content);
			$('#content #body br').remove();

			let docHref = window.location.href;
			let fbHref  = `https://www.facebook.com/sharer/sharer.php?u=${docHref}`;
			let waHref  = `https://api.whatsapp.com/send?text=${data.title} ${docHref}`;
			let twHref  = `https://twitter.com/intent/tweet?text=${data.slug}&url=${docHref}`;

			$('#social-share').html(`<a class="btn  btn-light m-2" href="${fbHref}"><i class="fab fa-facebook-f"></i></a>
			<a class="btn  btn-light m-2" href="${waHref}"><i class="fab fa-whatsapp"></i></a>
			<a class="btn  btn-light m-2" href="${twHref}"><i class="fab fa-twitter"></i></a>`);

			$('#ftco-loader').removeClass('show');
		})
		.catch(err => {
			if (err.response.status == 404){
				window.location.replace(`${BASE_URL}/not-found`);
			}  
			else if (err.response.status == 500){
			}
		});
	}

	/**
	* RELATED ARTICLE
	*/
	if (title2 == 'Baca Blog') {
		axios.get(`${BASE_URL}/artikel/related?slug=${SLUG}`)
		.then(res => {
			let elBerita  = '';
			let data = res.data.data;
			
			data.forEach(b => {
				let date      = new Date(parseInt(b.published_at) * 1000);
				let day       = date.toLocaleString("id-ID",{day: "numeric"});
				let month     = date.toLocaleString("id-ID",{month: "long"});
				let year      = date.toLocaleString("id-ID",{year: "numeric"});
	
				elBerita += `<div class="col-xl-6 col-lg-12 text-center">
					<a href="${BASE_URL}/blog/baca?slug=${b.slug}">
						<div class="article-card">
							<div class="article-img">
								<img src="${b.thumbnail}" style='opacity:1;width:auto;height:100%;'>
							</div>

							<div class="article-meta text-left" style='text-transform:capitalize;'>
								${b.title}
							</div>
						</div>
					</a>
				</div>`;
	
			});
			
			document.querySelector('#related-article').innerHTML = elBerita;
		})
		.catch(err => {
			if (err.response.status == 404){
			}  
			else if (err.response.status == 500){
			}
		});
	}

})(jQuery);


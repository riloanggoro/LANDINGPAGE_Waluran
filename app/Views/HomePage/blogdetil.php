<?= $this->extend('LayoutHtml/index') ?>

<!-- Css -->
<?= $this->section('layoutCss'); ?>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
		integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
		integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
	<link rel="stylesheet" href="<?= base_url('assets/css/animate.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/owl.theme.default.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/magnific-popup.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-datepicker.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/flaticon.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/jquery.timepicker.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/owl.carousel.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/styles.css'); ?>">
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('layoutJs'); ?>
	<script src="<?= base_url('assets/js/jquery.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/jquery-migrate-3.0.1.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/popper.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/jquery.easing.1.3.js'); ?>"></script>
	<script src="<?= base_url('assets/js/jquery.waypoints.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/jquery.stellar.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/owl.carousel.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/jquery.magnific-popup.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/jquery.animateNumber.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/bootstrap-datepicker.js'); ?>"></script>
	<script src="<?= base_url('assets/js/scrollax.min.js'); ?>"></script>
	<script
		src="<?= base_url('https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false'); ?>">
	</script>
	<script src="<?= base_url('assets/js/google-map.js'); ?>"></script>
	<script src="<?= base_url('assets/js/homepage.main.js'); ?>"></script>
<?= $this->endSection(); ?>

<!-- Html -->
<?= $this->section('layoutHtml'); ?>

	<body>
		<!-- loader -->
		<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
		<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
		<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
			stroke="#F96D00" /></svg></div>

		<!-- Navbar -->
		<div class="container-fluid" id="header">
			<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
				<div class="container">
					<a class="navbar-brand" href="index.html">Desa<span>Wisata Hanjeli</span></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
						aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="oi oi-menu"></span> Menu
					</button>

					<div class="collapse navbar-collapse" id="ftco-nav">
						<ul class="navbar-nav ml-auto">
							<li class="nav-item"><a href="<?= base_url('/') ?>" class="nav-link">Home</a></li>
							<li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
							<li class="nav-item"><a href="destination.html" class="nav-link">Destination</a></li>
							<li class="nav-item"><a href="hotel.html" class="nav-link">Hotel</a></li>
							<li class="nav-item"><a href="<?= base_url('/blog') ?>" class="nav-link">Blog</a></li>
							<li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
						</ul>
					</div>
				</div>
			</nav>


			<!-- Hero Section -->
			<div class="container blog" id="hero">
				<div class="row justify-content-end">
					<div class="col-lg-6 hero-img-container">
						<div id="thumbnail" class="hero-img" style="background-image: url(<?= base_url('assets/images/about-1.jpg'); ?>);">>
							<!-- hero img -->
							<img src="./img/hero-img-2.jpeg">
						</div>
					</div>

					<div class="col-lg-9">
						<div class="hero-title">
							<h1 id="title" style="text-transform: capitalize;">Desa Wisata Hanjeli, Kab. Sukabumi, Jawa barat</h1>
						</div>

					</div>
					<!-- hero meta -->
					<div class="col-lg-6">
						<div class="hero-meta">
							<div class="author">
								<div class="author-img"><img src="<?= base_url('/assets/images/default-profile.webp') ?>"></div>
								<div class="author-meta">
									<span class="author-name">Admin</span>
									<span class="author-tag">author</span>
								</div>
							</div>
							<span id="published_at" class="date mt-2">25th January, 2019</span>
							<div id="category" class="tags mt-2">
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!-- Content -->
		<div class="container mt-5" id="content">
			<div class="row justify-content-center">
				<!-- Share buttons -->
				<div class="col-lg-1 text-left mb-3 fixed" id="social-share">
				</div>

				<!-- the content -->
				<div id="body" class="col-xl-7 col-lg-10 col-md-12">
					
				</div>

				<div class="col-lg-10 mt-3">
					<hr>
				</div>
			</div>
		</div>


		<!-- Related Article Grid -->

		<div class="container mt-3 mb-5" id="article-grid">
			<div id="related-article" class="row">

			</div>
		</div>

		<!-- Footer section  -->

		<footer class="ftco-footer bg-bottom ftco-no-pt"
			style="background-image: url(<?= base_url('assets/images/bg_3.jpg'); ?>);">
			<div class="container">
				<div class="row mb-5">
					<div class="col-md pt-5">
						<div class="ftco-footer-widget pt-md-5 mb-4">
							<h2 class="ftco-heading-2">About</h2>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
								there live the
								blind texts.</p>
							<ul class="ftco-footer-social list-unstyled float-md-left float-lft">
								<li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
								<li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
								<li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
							</ul>
						</div>
					</div>
					<div class="col-md pt-5 border-left">
						<div class="ftco-footer-widget pt-md-5 mb-4 ml-md-5">
							<h2 class="ftco-heading-2">Infromation</h2>
							<ul class="list-unstyled">
								<li><a href="#" class="py-2 d-block">Online Enquiry</a></li>
								<li><a href="#" class="py-2 d-block">General Enquiries</a></li>
								<li><a href="#" class="py-2 d-block">Booking Conditions</a></li>
								<li><a href="#" class="py-2 d-block">Privacy and Policy</a></li>
								<li><a href="#" class="py-2 d-block">Refund Policy</a></li>
								<li><a href="#" class="py-2 d-block">Call Us</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md pt-5 border-left">
						<div class="ftco-footer-widget pt-md-5 mb-4">
							<h2 class="ftco-heading-2">Experience</h2>
							<ul class="list-unstyled">
								<li><a href="#" class="py-2 d-block">Adventure</a></li>
								<li><a href="#" class="py-2 d-block">Hotel and Restaurant</a></li>
								<li><a href="#" class="py-2 d-block">Beach</a></li>
								<li><a href="#" class="py-2 d-block">Nature</a></li>
								<li><a href="#" class="py-2 d-block">Camping</a></li>
								<li><a href="#" class="py-2 d-block">Party</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md pt-5 border-left">
						<div class="ftco-footer-widget pt-md-5 mb-4">
							<h2 class="ftco-heading-2">Have a Questions?</h2>
							<div class="block-23 mb-3">
								<ul>
									<li><span class="icon fa fa-map-marker"></span><span class="text">203 Fake St. Mountain
											View, San
											Francisco, California, USA</span></li>
									<li><a href="#"><span class="icon fa fa-phone"></span><span class="text">+2 392 3929
												210</span></a></li>
									<li><a href="#"><span class="icon fa fa-paper-plane"></span><span
												class="text">info@yourdomain.com</span></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 text-center">

						<p>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							Copyright &copy;<script>
								document.write(new Date().getFullYear());
							</script> Desa Wisata Hanjeli Waluran Sukabumi
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						</p>
					</div>
				</div>
			</div>
		</footer>


	</body>

<?= $this->endSection(); ?>
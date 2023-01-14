<?= $this->extend('LayoutHtml/index') ?>

<!-- Css -->
<?= $this->section('layoutCss'); ?>
  <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/css/template-dashboard.css'); ?>" rel="stylesheet">
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('layoutJs'); ?>
  <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/template-dashboard.js'); ?>"></script>
<?= $this->endSection(); ?>

<!-- Html -->
<?= $this->section('layoutHtml'); ?>

  <!-- ======== Navbar ========  -->
  <?= $this->include('Components/dashboardNavBar'); ?>
  <!-- ======== Sidebar ========  -->
  <?= $this->include('Components/dashboardSideBar'); ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1 style="text-transform: capitalize;"><?= $title ?></h1>
    </div><!-- End Page Title -->

  </main>
	
<?= $this->endSection(); ?>
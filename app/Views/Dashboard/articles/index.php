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
  <script src="<?= base_url('assets/js/dashboard.artikellist.js'); ?>"></script>
<?= $this->endSection(); ?>

<!-- Html -->
<?= $this->section('layoutHtml'); ?>

  <!-- ======== Navbar ========  -->
  <?= $this->include('Components/dashboardNavBar'); ?>
  <!-- ======== Sidebar ========  -->
  <?= $this->include('Components/dashboardSideBar'); ?>
    
  <!-- ========= Alert info ========= -->
  <?= $this->include('Components/alertInfo'); ?>
  <!-- ========= Loading Spinner =========  -->
  <?= $this->include('Components/loadingSpinner'); ?>

  <main id="main" class="main">

    <!-- Page Title -->
    <div class="pagetitle mt-4 mb-4 d-flex align-items-center justify-content-between">
      <h1 style="text-transform: capitalize;"><?= $title ?></h1>

      <a href="<?= base_url('/dashboard/tambah-artikel'); ?>" class="btn btn-primary rounded">
        <i class="bi bi-plus"></i> tambah
      </a>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
          <!-- Table Articles -->
          <div class="col">
            <div class="card">
              <div class="card-body table-responsive">
                
                <!-- spinner -->
                <div id="list-articles-spinner" class="bg-white d-flex align-items-center justify-content-center pt-5 pb-4">
                  <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                </div>
                <!-- message not found -->
                <div id="list-articles-notfound" class="d-none bg-white d-flex align-items-center justify-content-center pt-5 pb-4">
                  <h6 class='opacity-6'>
                    artikel belum ditambah
                  </h6>
                </div>

                <table id="table-articles" class="table d-none">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">THUMBNAIL</th>
                      <th class="text-center">JUDUL</th>
                      <th class="text-center">KATEGORI</th>
                      <th class="text-center">DIPUBLIKASI</th>
                      <th class="text-center">TANGGAL PUBLIKASI</th>
                      <th class="text-center">ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div><!-- End Table Categories -->
      </div>
    </section>

  </main>
	
<?= $this->endSection(); ?>
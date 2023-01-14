<?= $this->extend('LayoutHtml/index') ?>

<!-- Css -->
<?= $this->section('layoutCss'); ?>
  <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/css/template-dashboard.css'); ?>" rel="stylesheet">
  <style>
		.btn-toggle{
			left: 0;
			transition: all 0.3s;
			transform: translateX(0px);
		}

		.btn-toggle.active{
			transform: translateX(25px);
		}
  </style>
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('layoutJs'); ?>
  <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/template-dashboard.js'); ?>"></script>
  <script src="<?= base_url('assets/js/dashboard.kategoriArtikel.js'); ?>"></script>
<?= $this->endSection(); ?>

<!-- Html -->
<?= $this->section('layoutHtml'); ?>

  <!-- ======== Navbar =========  -->
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

      <button type="button" class="btn btn-primary rounded" data-bs-toggle="modal" data-bs-target="#modalCrudKategori" onclick="openModalCrudKategori('addkategori')">
        <i class="bi bi-plus"></i> tambah
      </button>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
          <!-- Table Categories -->
          <div class="col">
            <div class="card">
              <div class="card-body table-responsive">
                
                <!-- spinner -->
                <div id="list-kategori-spinner" class="bg-white d-flex align-items-center justify-content-center pt-5 pb-4">
                  <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                </div>
                <!-- message not found -->
                <div id="list-kategori-notfound" class="d-none bg-white d-flex align-items-center justify-content-center pt-5 pb-4">
                  <h6 class='opacity-6'>
                    kategori belum ditambah
                  </h6>
                </div>

                <table id="table-kategori-artikel" class="table d-none">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">ICON</th>
                      <th class="text-center">NAME</th>
                      <th class="text-center">DESCRIPTION</th>
                      <th class="text-center">UTAMA</th>
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

  <!-- Modals CRUD Categories -->
  <div class="modal fade" id="modalCrudKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form id="formCrudKategori" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form-control" name="id" id="id_kategori">
          
          <div class="row">
            <div class="col-12 col-sm-6">
              <img id="img-preview" src="<?= base_url('assets/images/skeleton-icon.png'); ?>" class="img-thumbnail" style="width:100px;height:100px;max-width:100px;max-height:100px;">
              <div class="input-group mt-2">
                <input type="file" class="form-control" name="icon" id="icon" autocomplete="off" placeholder="icon" style="min-height: 38px" onchange="changeThumbPreview(this);">
              </div>
            </div>

            <h6 class="font-italic opacity-8 mt-4 mb-2">Nama kategori</h6>
            <div class="col-12 input-group">
              <input type="text" class="form-control px-2" id="kategori_name" name="kategori_name" autocomplete="off" placeholder="masukan kategori baru">
            </div>
            <small
              id="kategori_name-error"
              class="text-danger"></small>

            <h6 class="font-italic opacity-8 mt-4 mb-2">Deskripsi</h6>
            <div class="col-12 input-group">
              <textarea id="description" name="description" class="form-control rounded-sm" rows="3"></textarea>
            </div>
            
            <h6 class="font-italic opacity-8 mt-4 mb-2">Kategori utama</h6>
            <div class="col-12">
              <div class="position-relative p-0 d-flex align-items-center" style="border-radius: 14px;width: 50px;height: 25px;box-shadow: inset 0 0 4px 0px rgba(0, 0, 0, 0.4);">
                <div class="btn-toggle bg-secondary rounded-circle position-absolute" style="width: 25px;height: 25px;">
                  <input type="checkbox" id="kategori_utama" class="cursor-pointer" style="width: 25px;height: 25px;opacity: 0;">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button id="btnCrudKategoriArtikel" type="submit" class="btn btn-success d-flex justify-content-center align-items-center" style="height: 40.8px;" onclick="crudKategoriArtikel(this,event)">
            <span id="text">simpan</span>
            <div id="spinner" class="d-none spinner-border text-white" role="status" style="width: 20px; height: 20px;">
              <span class="visually-hidden">Loading...</span>
            </div>
          </button>
        </div>
      </form>
    </div>
  </div><!-- End Modals CRUD Categories -->
	
<?= $this->endSection(); ?>
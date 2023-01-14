<?= $this->extend('LayoutHtml/index') ?>

<!-- Css -->
<?= $this->section('layoutCss'); ?>
  <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/boxicons/css/boxicons.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/quill/quill.snow.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/quill/quill.bubble.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/remixicon/remixicon.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/simple-datatables/style.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/css/template-dashboard.css'); ?>" rel="stylesheet">
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('layoutJs'); ?>
  <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?= base_url('assets/vendor/quill/quill.min.js'); ?>"></script>
  <script src="<?= base_url('assets/vendor/tinymce/tinymce.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/template-dashboard.js'); ?>"></script>
  <script src="<?= base_url('assets/js/dashboard.artikelcrud.js'); ?>"></script>
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

  <form id="main" class="main formCrudArticle">

    <div class="pagetitle">
      <h1 style="text-transform: capitalize;"><?= $title ?></h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col">

          <div class="card mt-3 pt-4">
            <div class="card-body">
              <!-- General Form Elements -->
              <div>
                <div class="row mb-3 d-flex flex-column">
                  <div id="thumbnail-wraper" class="position-relative col-12 col-sm-6 mt-1 mb-2">
                    <div id="thumbnail-spinner" class="img-thumbnail d-none position-absolute bg-white d-flex align-items-center justify-content-center pt-4" style="z-index: 11;top: 0;bottom: 0;left: 0;right: 0;">
                      <div class="spinner-border text-secondary" role="status">
                        <span class="visually-hidden">Loading...</span>
                      </div>
                    </div>
                    <img src="<?= base_url('assets/images/skeleton-thumbnail.webp'); ?>" class="w-100" style="opacity: 0;">
                    <img src="<?= base_url('assets/images/default-thumbnail.webp'); ?>" alt="thumbnail" id="preview-thumbnail" class="img-thumbnail position-absolute" style="z-index: 10;min-width: 100%;max-width: 100%;max-height: 100%;min-height: 100%;left:0;">
                  </div>
                </div>

				        <input type="hidden" name="id" id="idartikel">

                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Thumbnail</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="thumbnail" name="thumbnail" onchange="changeThumbPreview(this)">
                    <div class="text-danger"></div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title">
                    <div id="title-error" class="text-danger"></div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Publish</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="published_at" name="published_at">
                    <div class="text-danger"></div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">Kategori</label>
                  <div class="col-sm-10">
                    <select id="kategori-artikel-wraper" class="form-select" id="id_kategori" name="id_kategori">
                      <option value='' selected>-- pilih kategori --</option>
                    </select>
                  </div>
                </div>
                <div class="row mt-1">
                  <label for="inputDate" class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10 pl-1">
                    <a class="" href="<?= base_url('/dashboard/kategori-artikel') ?>">manage kategori</a>
                  </div>
                </div>

              </div><!-- End General Form Elements -->

            </div>
          </div>

          <div class="card mt-3 pt-4">
            <div class="card-body">
              <div class="quill-editor-full">
                tulis blog disini ....
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <div class="w-100">
      <button type="submit" class="btn btn-primary w-100">simpan</button>
    </div>

  </form>
	
<?= $this->endSection(); ?>
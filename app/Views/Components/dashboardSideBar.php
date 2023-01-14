<?= $this->extend('LayoutHtml/index') ?>

<!-- Css -->
<?= $this->section('layoutCss'); ?>
    <style>
    </style>
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('jsComponent'); ?>
    <script>
        /**
        * LOGOUT
        */
        $('#btn_logout').on('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'LOGOUT',
                text: "Anda yakin ingin keluar dari dashboad?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'iya',
                cancelButtonText: 'tidak',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    doLogout(true);
                    return 0;
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        })
    </script>
<?= $this->endSection(); ?>

<?= $this->section('layoutHtml'); ?>
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <?php if($title == 'tambah artikel' || $title == 'edit artikel') { ?>
        
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('/dashboard/artikel') ?>">
            <i class="bi bi-chevron-left"></i>
            <span>kembali</span>
          </a>
        </li>

      <?php } else if($title == 'kategori artikel') { ?>
          
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('/dashboard/tambah-artikel') ?>">
              <i class="bi bi-chevron-left"></i>
              <span>kembali</span>
            </a>
          </li>

      <?php } else { ?>

        <li class="nav-item">
          <a class="nav-link <?= $title=='home' ? '' : 'collapsed' ?>" href="<?= base_url('/dashboard') ?>">
            <i class="bi bi-grid"></i>
            <span>Home</span>
          </a>
        </li><!-- End Dashboard Nav -->

        <?php if($previlege == 'admin') { ?>
        
          <li class="nav-item">
            <a class="nav-link  <?= $title=='daftar artikel' ? '' : 'collapsed' ?>" href="<?= base_url('/dashboard/artikel') ?>">
              <i class="bi bi-journal-text"></i>
              <span>Artikel</span>
            </a>
          </li><!-- End Article Nav -->

        <?php } ?>

      <?php } ?>

    </ul>

  </aside><!-- End Sidebar-->
<?= $this->endSection(); ?>
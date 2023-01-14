<?= $this->extend('LayoutHtml/index') ?>

<!-- Css -->
<?= $this->section('layoutCss'); ?>
    <style>
    </style>
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('layoutJs'); ?>
    <script>
        /**
        * GET USER PROFILE
        * ========================================
        */
        const getDataProfile = async () => {
            let httpResponse = await httpRequestGet(`${BASE_URL}/user/profile`);

            if (httpResponse.status === 200) {
                let data = httpResponse.data.data;
                
                $('#formEditProfile #username').val(data.username);
            }
        };
        getDataProfile();

        /**
        * UPDATE USER PROFILE
        * ========================================
        */
        $('#formEditProfile').on('submit', async function(e) {
            e.preventDefault();
            let form = new FormData(e.target);

            if (validateFormEditProfile()) {

                if (form.get('new_password') == '') {
                  form.delete('new_password');
                }

                $('#formEditProfile button #text').addClass('d-none');
                $('#formEditProfile button #spinner').removeClass('d-none');

                httpResponse = await httpRequestPut(`${BASE_URL}/user/profile`,form);

                $('#formEditProfile button #text').removeClass('d-none');
                $('#formEditProfile button #spinner').addClass('d-none');

                if (httpResponse.status === 201) {
                    if (form.get('new_password') != '') {
                        $('#new_password').val('');
                        $('#old_password').val('');
                    }

                    showAlert({
                        message: `<strong>Success...</strong> edit profile berhasil!`,
                        autohide: true,
                        type:'success'
                    })
                }
                else if (httpResponse.status === 400) {
                  if (httpResponse.message.username) {
                      $('#username').addClass('is-invalid');
                      $('#username-error').text('*'+httpResponse.message.username);
                  }
                  if (httpResponse.message.old_password) {
                      $('#old_password').addClass('is-invalid');
                      $('#old_password-error').text('*'+httpResponse.message.old_password);
                  }
                }
            }
        });

        function validateFormEditProfile() {
            let status = true;

            // clear error message first
            $('#formEditProfile .form-control').removeClass('is-invalid');
            $('#formEditProfile .text-danger').html('');

            // username validation
            if ($('#username').val() == '') {
                $('#username').addClass('is-invalid');
                $('#username-error').html('*username harus di isi');
                status = false;
            }
            else if ($('#username').val().length < 8 || $('#username').val().length > 20) {
                $('#username').addClass('is-invalid');
                $('#username-error').html('*minimal 8 huruf dan maksimal 20 huruf');
                status = false;
            }
            else if (/\s/.test($('#username').val())) {
                $('#username').addClass('is-invalid');
                $('#username-error').html('*tidak boleh ada spasi');
                status = false;
            }
            // pass validation
            if ($('#new_password').val() !== '') {   
                if ($('#new_password').val().length < 8 || $('#new_password').val().length > 20) {
                    $('#new_password').addClass('is-invalid');
                    $('#new_password-error').html('*minimal 8 huruf dan maksimal 20 huruf');
                    status = false;
                }
                else if (/\s/.test($('#new_password').val())) {
                    $('#new_password').addClass('is-invalid');
                    $('#new_password-error').html('*tidak boleh ada spasi');
                    status = false;
                }
                if ($('#old_password').val() == '') {
                    $('#old_password').addClass('is-invalid');
                    $('#old_password-error').html('*password lama harus di isi');
                    status = false;
                }
            }

            return status;
        }
    </script>
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('jsComponent'); ?>
    <script>
        /**
        * LOGOUT
        * ========================================
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
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block" style="text-transform: capitalize;">dashboard</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?= base_url('assets/images/default-profile.webp') ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">Admin</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

            <li>
              <a class="dropdown-item d-flex align-items-center" href="" data-bs-toggle="modal" data-bs-target="#modalEditProfile">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a id="btn_logout" class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
      
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- Modals Edit Profile -->
  <div class="modal fade" id="modalEditProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form id="formEditProfile" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row pb-4">
            <small class="font-italic opacity-8 mt-3 mb-2">Username</small>
            <div class="col-12 input-group">
              <input type="text" class="form-control px-2" id="username" name="username" autocomplete="off">
            </div>
            <small
              id="username-error"
              class="text-danger"></small>

            <div class="mt-5 mb-3 d-flex justify-content-center align-items-center" style="position:relative;">
              <div class="px-3" style="position:absolute;z-index:2;background:white;width:min-content;color: rgba(0,0,0,0.5);">
                opsional
              </div>
              <div class="w-100" style="position:relative;z-index:1;border-bottom: 0.3px solid black;opacity: 0.2;"></div>
            </div>

            <small class="font-italic opacity-8 mt-4 mb-2">Passsword lama</small>
            <div class="col-12 input-group">
              <input type="password" class="form-control px-2" id="old_password" name="old_password" autocomplete="off">
            </div>
            <small
              id="old_password-error"
              class="text-danger"></small>

            <small class="font-italic opacity-8 mt-4 mb-2">Passsword baru</small>
            <div class="col-12 input-group">
              <input type="password" class="form-control px-2" id="new_password" name="new_password" autocomplete="off">
            </div>
            <small
              id="new_password-error"
              class="text-danger"></small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success d-flex justify-content-center align-items-center" style="height: 40.8px;">
            <span id="text">simpan</span>
            <div id="spinner" class="d-none spinner-border text-white" role="status" style="width: 20px; height: 20px;">
              <span class="visually-hidden">Loading...</span>
            </div>
          </button>
        </div>
      </form>
    </div>
  </div><!-- End Modals Edit Profile -->
<?= $this->endSection(); ?>
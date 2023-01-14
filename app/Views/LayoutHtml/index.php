<!DOCTYPE html>
<html lang="en">
<head>
  <title>WALURAN | <?= $title ?></title>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="<?= base_url('images/logo.png') ?>" type="image/x-icon">

  <!-- Render Css -->
  <?= $this->renderSection('layoutCss'); ?>

  <style>
    body{
      /* font-family: 'sans' !important; */
    }
  </style>

</head>

<body  
  style="background-image: url('<?= base_url('images/bg.webp'); ?>');"
  class="bg-cover bg-no-repeat">

    <!-- Render Html -->
    <?= $this->renderSection('layoutHtml'); ?>
    
    <script src="<?= base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/axios.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/sweetalert2.min.js'); ?>"></script>
    
    <script>
      let PASSWORD     = "";
      const TOKEN      = "<?= (isset($token)) ? $token : null; ?>";
      const PREVILEGE  = "<?= (isset($previlege)) ? $previlege : null; ?>";
      const BASE_URL   = "<?= base_url('/') ?>";
      const LASTURL    = "<?= (isset($lasturl)) ? $lasturl : null; ?>"; //login controller
    </script>

    <!-- Render Js -->
    <?= $this->renderSection('jsComponent'); ?>
    <script src="<?= base_url('assets/js/helper.js'); ?>"></script>
    <?= $this->renderSection('layoutJs'); ?>

</body>

</html>
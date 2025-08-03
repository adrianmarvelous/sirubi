<?php
session_start();
?>

<!doctype html>

<html
  lang="en"
  class="layout-wide customizer-hide"
  data-assets-path="assets/sneat/assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Register</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/sneat/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="assets/sneat/assets/vendor/fonts/iconify-icons.css" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="assets/sneat/assets/vendor/css/core.css" />
    <link rel="stylesheet" href="assets/sneat/assets/css/demo.css" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="assets/sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- endbuild -->

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="assets/sneat/assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="assets/sneat/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="assets/sneat/assets/js/config.js"></script>
  </head>
  <body>
    <!-- Content -->

    <div class="container-xxl">
      <!-- <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner"> -->
          <!-- Register Card -->
          <div class="card px-sm-6 px-0">
            <div class="card-body">
              <?php if (isset($_SESSION['alert'])): ?>
                <div class="alert alert-<?= $_SESSION['alert']['type'] ?> alert-dismissible fade show" role="alert">
                  <?= $_SESSION['alert']['message'] ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['alert']); ?>
              <?php endif; ?>

              <div class="row">
                <div class="col-lg-8 d-none d-lg-block">
                  <img src="resources/img/bg-sirubi.jpeg" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="Background Image">
                </div>
                <div class="col-lg-4">
              <!-- Logo -->
              <div class="app-brand justify-content-center mb-6">
                <a class="app-brand-link gap-2">
                  <span class="app-brand-text demo text-heading fw-bold">Sirubi</span>
                </a>
              </div>
              <!-- /Logo -->
              <!-- <h4 class="mb-1">Adventure starts here 🚀</h4>
              <p class="mb-6">Make your app management easy and fun!</p> -->

              <form id="formAuthentication" class="mb-6" method="POST" action="controller/auth.php">
                <div class="mb-6">
                  <label for="username" class="form-label">Nama</label>
                  <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="name"
                    placeholder="Masukan Nama"
                    autofocus required />
                </div>
                <div class="mb-6">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Masukan Email" required />
                </div>
                <div class="form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password" required/>
                    <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="my-7">
                  <!-- <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                    <label class="form-check-label" for="terms-conditions">
                      I agree to
                      <a href="javascript:void(0);">privacy policy & terms</a>
                    </label>
                  </div> -->
                </div>
                <input type="hidden" name="action" value="register">
                <button class="btn btn-primary d-grid w-100">Daftar</button>
              </form>

              <p class="text-center">
                <span>Sudah punya akun?</span>
                <a href="auth-login-basic.html">
                  <span>Login disini</span>
                </a>
              </p>
                </div>
            </div>
          </div>
          <!-- Register Card -->
        <!-- </div>
      </div> -->
    </div>

    <!-- / Content -->

    <!-- <div class="buy-now">
      <a
        href="https://themeselection.com/item/sneat-dashboard-pro-bootstrap/"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Upgrade to Pro</a
      >
    </div> -->

    <!-- Core JS -->

    <script src="assets/sneat/assets/vendor/libs/jquery/jquery.js"></script>

    <script src="assets/sneat/assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/sneat/assets/vendor/js/bootstrap.js"></script>

    <script src="assets/sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/sneat/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->

    <script src="assets/sneat/assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>

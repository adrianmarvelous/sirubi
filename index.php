<?php
    ini_set('display_errors', 1);
    error_reporting(~0);
    require_once 'config/koneksi.php';
	if(htmlentities(!isset($_SESSION['auth']))){
  		header("Location: login.php");
	}
    // dd($_SESSION);
    $role_id = htmlentities($_SESSION['role_id']);
    $q_menu = $db->prepare("SELECT * FROM `rb_menu` JOIN rb_role_to_menu ON rb_menu.id_menu = rb_role_to_menu.id_menu WHERE rb_role_to_menu.id_role = :role_id");
    $q_menu->bindParam(':role_id',$role_id);
    $q_menu->execute();
    $menu = $q_menu->fetchAll(PDO::FETCH_ASSOC);
    // dd($menu);
?>
<!doctype html>

<html
  lang="en"
  class="layout-menu-fixed layout-compact"
  data-assets-path="assets/sneat/assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard Sirubi</title>

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

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
	<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="assets/sneat/assets/vendor/css/core.css" />
    <link rel="stylesheet" href="assets/sneat/assets/css/demo.css" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="assets/sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- endbuild -->

    <link rel="stylesheet" href="assets/sneat/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="assets/sneat/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="assets/sneat/assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.php" class="app-brand-link">
              <span class="app-brand-text demo menu-text fw-bold ms-2">SiRuBi</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="bx bx-chevron-left d-block d-xl-none align-middle"></i>
            </a>
          </div>

          <div class="menu-divider mt-0"></div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">

            <!-- Apps & Pages -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Main Menu</span>
            </li>
            <?php
              foreach ($menu as $key => $value_menu) {
            ?>
            <li class="menu-item">
              <a href="<?=$value_menu['slug']?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-<?=$value_menu['icon']?>"></i>
                <div class="text-truncate" data-i18n="Email"><?=$value_menu['menu']?></div>
              </a>
            </li>
            <?php }?>
        
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                <i class="icon-base bx bx-menu icon-md"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center me-auto">
                <div class="nav-item d-flex align-items-center">
                  <span class="w-px-22 h-px-22"><i class="icon-base bx bx-search icon-md"></i></span>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none ps-1 ps-sm-2 d-md-block d-none"
                    placeholder="Search..."
                    aria-label="Search..." />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-md-auto">
                <!-- Place this tag where you want the button to render. -->
                <!-- <li class="nav-item lh-1 me-4">
                  <a
                    class="github-button"
                    href="https://github.com/themeselection/sneat-bootstrap-html-admin-template-free"
                    data-icon="octicon-star"
                    data-size="large"
                    data-show-count="true"
                    aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
                    >Star</a
                  >
                </li> -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a
                    class="nav-link dropdown-toggle hide-arrow p-0"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="<?= isset($_SESSION['picture']) ? htmlentities($_SESSION['picture']) : 'assets/sneat/assets/img/avatars/1.png' ?>" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="<?= isset($_SESSION['picture']) ? htmlentities($_SESSION['picture']) : 'assets/sneat/assets/img/avatars/1.png' ?>" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-0"><?=htmlentities($_SESSION['name'])?></h6>
                            <small class="text-body-secondary"><?=htmlentities($_SESSION['role'])?></small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="icon-base bx bx-user icon-md me-3"></i><span>My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="icon-base bx bx-cog icon-md me-3"></i><span>Settings</span>
                      </a>
                    </li>
                    <!-- <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 icon-base bx bx-credit-card icon-md me-3"></i
                          ><span class="flex-grow-1 align-middle">Billing Plan</span>
                          <span class="flex-shrink-0 badge rounded-pill bg-danger">4</span>
                        </span>
                      </a>
                    </li> -->
                    <li>
                      <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="config/login/logout.php">
                        <i class="icon-base bx bx-power-off icon-md me-3"></i><span>Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              
              <?php
                $q_user = $db->prepare("SELECT * FROM rb_users WHERE id_user = :id_user");
                $q_user->bindParam(':id_user', $_SESSION['id_user']);
                $q_user->execute();
                $check_user = $q_user->fetch(PDO::FETCH_ASSOC);
                if(!isset($check_user['telp']) || !isset($check_user['instansi']) || !isset($check_user['alamat'])){
                  $showModal = true;
                }
              ?>
              <?php if (isset($_SESSION['alert'])): ?>
                <div class="alert alert-<?= $_SESSION['alert']['type'] ?> alert-dismissible fade show" role="alert">
                  <?= $_SESSION['alert']['message'] ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['alert']); ?>
              <?php endif; ?>
              <?php
                $role_id = $_SESSION['role_id'];
                $page = isset($_GET['pages']) ? htmlentities($_GET['pages']) : '';

                // Pages allowed for each role
                if ($role_id == 1) {
                    if ($page == "") {
                        include "home.php";
                    } elseif (in_array($page, ['calendar_booking', 'permohonan', 'create_part_2', 'pengajuan_selesai', 'list_booking'])) {
                        include "controller/booking.php";
                    } else {
                        echo "<script>alert('Akses ditolak');history.back();</script>";
                    }
                } elseif ($role_id == 2) {
                    if ($page == "") {
                        include "home_pegawai.php";
                    } elseif (in_array($page, ['users'])) {
                        include "controller/users.php";
                    } elseif (in_array($page, ['list_booking','pengajuan_selesai','approve'])){
                      include 'controller/booking.php';
                    }
                     else {
                        echo "<script>alert('Akses ditolak');history.back();</script>";
                    }
                } else {
                    echo "<script>alert('Akses tidak diijinkan');history.back();</script>";
                }
              ?>

              <!-- Modal -->
              <div class="modal fade" id="basicModalprofil" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="controller/profil.php" method="get">
                      <div class="modal-body">
                        <div class="row">
                          <div class="col mb-3">
                            <label for="nameBasic" class="form-label">Nama</label>
                            <input type="text" id="nameBasic" name="name" class="form-control" placeholder="Masukan Nama" value="<?=$check_user['name']?>" required>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col mb-3">
                            <label for="nameBasic" class="form-label">Instansi</label>
                            <input type="text" id="nameBasic" name="instansi" class="form-control" placeholder="Masukan Nama Instansi" value="<?=$check_user['instansi']?>" required>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col mb-3">
                            <label for="nameBasic" class="form-label">No Telp</label>
                            <input type="text" id="nameBasic"  name="telp" class="form-control" placeholder="Masukan No Telp" value="<?=$check_user['telp']?>" required>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col mb-3">
                            <label for="nameBasic" class="form-label">Alamat</label>
                            <input type="text" id="nameBasic"  name="alamat" class="form-control" placeholder="Masukan Alamat" value="<?=$check_user['alamat']?>" required>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id_user" value="<?=$check_user['id_user']?>">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              
              <!-- Auto-show modal if $showModal is true -->
              <?php if (isset($showModal)): ?>
              <script>
                document.addEventListener('DOMContentLoaded', function () {
                  var myModal = new bootstrap.Modal(document.getElementById('basicModalprofil'));
                  myModal.show();
                });
              </script>
              <?php endif; ?>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                  <div class="mb-2 mb-md-0">
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    , made with ❤️ by
                    <a href="https://themeselection.com" target="_blank" class="footer-link">ThemeSelection</a>
                  </div>
                  <div class="d-none d-lg-inline-block">
                    <a
                      href="https://themeselection.com/item/category/admin-templates/"
                      target="_blank"
                      class="footer-link me-4"
                      >Admin Templates</a
                    >

                    <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                    <a
                      href="https://themeselection.com/item/category/bootstrap-admin-templates/"
                      target="_blank"
                      class="footer-link me-4"
                      >Bootstrap Dashboard</a
                    >

                    <a
                      href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/"
                      target="_blank"
                      class="footer-link me-4"
                      >Documentation</a
                    >

                    <a
                      href="https://github.com/themeselection/sneat-bootstrap-html-admin-template-free/issues"
                      target="_blank"
                      class="footer-link"
                      >Support</a
                    >
                  </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->

    <script src="assets/sneat/assets/vendor/libs/jquery/jquery.js"></script>

    <script src="assets/sneat/assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/sneat/assets/vendor/js/bootstrap.js"></script>

    <script src="assets/sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/sneat/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="assets/sneat/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->

    <script src="assets/sneat/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/sneat/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    
    <script>
      new DataTable('#example');
    </script>
  </body>
</html>

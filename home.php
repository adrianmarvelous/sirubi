<?php
    $id_user = $_SESSION['id_user'];
    $q_total_peminjaman = $db->prepare("SELECT COUNT(*) as total FROM rb_booking WHERE id_user = :id_user");
    $q_total_peminjaman->bindParam(':id_user', $id_user);
    $q_total_peminjaman->execute();
    $total_peminjaman = $q_total_peminjaman->fetch(PDO::FETCH_ASSOC)['total'];

    $q_booking_terakhir = $db->prepare("SELECT * FROM rb_booking WHERE id_user = :id_user ORDER BY created_at DESC LIMIT 1");
    $q_booking_terakhir->bindParam(':id_user', $id_user);
    $q_booking_terakhir->execute();
    $booking_terakhir = $q_booking_terakhir->fetch(PDO::FETCH_ASSOC);

    $q_total_posisi_berkas = $db->prepare("SELECT COUNT(*) as total FROM rb_posisi_berkas");
    $q_total_posisi_berkas->execute();
    $total_posisi_berkas = $q_total_posisi_berkas->fetch(PDO::FETCH_ASSOC)['total'];
    
    $progress = $booking_terakhir['id_posisi_berkas']/$total_posisi_berkas*100;
    
    // Option 1: Round to nearest whole number
    $progress = round($progress);
?>
<style>
  .fab {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 150px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    z-index: 999;
  }

  .fab:hover {
    transform: scale(1.05);
  }
</style>
<div class="row">
  
    <!-- Modal -->
    <div class="modal fade" id="basicModalprofil" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Lengkapi Data Diri</h5>
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
                <?php if (isset($showModal)): ?>
                // Misal modal lain punya id = 'dateModal'
                var otherModal = document.getElementById('disclaimerModal');

                if (otherModal) {
                    otherModal.addEventListener('hidden.bs.modal', function () {
                    var myModal = new bootstrap.Modal(document.getElementById('basicModalprofil'));
                    myModal.show();
                    });
                } else {
                    // Kalau tidak ada modal lain, langsung show
                    var myModal = new bootstrap.Modal(document.getElementById('basicModalprofil'));
                    myModal.show();
                }
                <?php endif; ?>
            });
        </script>

    <?php endif; ?>
    <!-- <div class="col-xl-4 col-md-12 mb-4 animate__animated animate__fadeInDown" style="animation-delay: 0.1s;">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Peminjaman
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total_peminjaman?> Kali</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-12 mb-4 animate__animated animate__fadeInDown" style="animation-delay: 0.3s;">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Tutorial Peminnjaman</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-12 mb-4 animate__animated animate__fadeInDown" style="animation-delay: 0.5s;">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Progres Peminjaman Terakhir
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=$progress?>%</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: <?=$progress?>%" aria-valuenow="<?=$progress?>" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="col-xl-6 col-md-6 mb-4 animate__animated animate__fadeInDown"  style="animation-delay: 0.7s;">
        <div class="card shadow p-3">
            <video width="100%" controls>
                <source src="assets/video/0731.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
    <div class="col-xl-6 col-md-6 mb-4 animate__animated animate__fadeInDown" style="animation-delay: 0.9s;">
        <div class="card shadow p-3">
            
            <div class="container py-5">
            <div id="photoSlider" class="carousel slide shadow-lg rounded" data-bs-ride="carousel">
                
                <!-- Indicators -->
                <div class="carousel-indicators">
                <button type="button" data-bs-target="#photoSlider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#photoSlider" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#photoSlider" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#photoSlider" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#photoSlider" data-bs-slide-to="4" aria-label="Slide 5"></button>
                <button type="button" data-bs-target="#photoSlider" data-bs-slide-to="5" aria-label="Slide 6"></button>
                <button type="button" data-bs-target="#photoSlider" data-bs-slide-to="6" aria-label="Slide 7"></button>
                <button type="button" data-bs-target="#photoSlider" data-bs-slide-to="7" aria-label="Slide 8"></button>
                <button type="button" data-bs-target="#photoSlider" data-bs-slide-to="8" aria-label="Slide 9"></button>
                <button type="button" data-bs-target="#photoSlider" data-bs-slide-to="9" aria-label="Slide 10"></button>
                <button type="button" data-bs-target="#photoSlider" data-bs-slide-to="10" aria-label="Slide 11"></button>
                <button type="button" data-bs-target="#photoSlider" data-bs-slide-to="11" aria-label="Slide 12"></button>
                <button type="button" data-bs-target="#photoSlider" data-bs-slide-to="12" aria-label="Slide 13"></button>
                <button type="button" data-bs-target="#photoSlider" data-bs-slide-to="13" aria-label="Slide 13"></button>
                </div>

                <!-- Slides -->
                <div class="carousel-inner rounded">
                    <div class="carousel-item active">
                        <img src="assets/slider/1.jpeg" class="d-block w-100" alt="Photo 1">
                        <div class="carousel-caption d-none d-md-block">
                        <h5>First Slide</h5>
                        <p>This is a description for the first photo.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/slider/2.jpeg" class="d-block w-100" alt="Photo 2">
                        <div class="carousel-caption d-none d-md-block">
                        <h5>Second Slide</h5>
                        <p>Description for the second photo.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/slider/3.jpeg" class="d-block w-100" alt="Photo 3">
                        <div class="carousel-caption d-none d-md-block">
                        <h5>Third Slide</h5>
                        <p>Description for the third photo.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/slider/4.jpeg" class="d-block w-100" alt="Photo 4">
                        <div class="carousel-caption d-none d-md-block">
                        <h5>Third Slide</h5>
                        <p>Description for the third photo.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/slider/5.jpeg" class="d-block w-100" alt="Photo 5">
                        <div class="carousel-caption d-none d-md-block">
                        <h5>Third Slide</h5>
                        <p>Description for the third photo.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/slider/6.jpeg" class="d-block w-100" alt="Photo 6">
                        <div class="carousel-caption d-none d-md-block">
                        <h5>Third Slide</h5>
                        <p>Description for the third photo.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/slider/7.jpeg" class="d-block w-100" alt="Photo 7">
                        <div class="carousel-caption d-none d-md-block">
                        <h5>Third Slide</h5>
                        <p>Description for the third photo.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/slider/8.jpeg" class="d-block w-100" alt="Photo 8">
                        <div class="carousel-caption d-none d-md-block">
                        <h5>Third Slide</h5>
                        <p>Description for the third photo.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/slider/9.jpeg" class="d-block w-100" alt="Photo 9">
                        <div class="carousel-caption d-none d-md-block">
                        <h5>Third Slide</h5>
                        <p>Description for the third photo.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/slider/10.jpeg" class="d-block w-100" alt="Photo 10">
                        <div class="carousel-caption d-none d-md-block">
                        <h5>Third Slide</h5>
                        <p>Description for the third photo.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/slider/11.jpeg" class="d-block w-100" alt="Photo 11">
                        <div class="carousel-caption d-none d-md-block">
                        <h5>Third Slide</h5>
                        <p>Description for the third photo.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/slider/12.jpeg" class="d-block w-100" alt="Photo 12">
                        <div class="carousel-caption d-none d-md-block">
                        <h5>Third Slide</h5>
                        <p>Description for the third photo.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/slider/12.jpeg" class="d-block w-100" alt="Photo 12">
                        <div class="carousel-caption d-none d-md-block">
                        <h5>Third Slide</h5>
                        <p>Description for the third photo.</p>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#photoSlider" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#photoSlider" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
                </button>
            </div>
            </div>

        </div>
    </div>
    <!-- Floating Action Button -->
    <a href="index.php?pages=calendar_booking" class="btn btn-primary fab animate__animated animate__fadeInDown"s tyle="animation-delay: 0.9s;">
        Booking sekarang <i class="bx bx-plus"></i> <!-- Use any icon -->
    </a>
</div>
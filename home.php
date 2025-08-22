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
    <div class="col-xl-4 col-md-12 mb-4 animate__animated animate__fadeInDown" style="animation-delay: 0.1s;">
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
    </div>
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
            <video width="100%" controls>
                <source src="assets/video/0731.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
    <!-- Floating Action Button -->
    <a href="index.php?pages=calendar_booking" class="btn btn-primary fab animate__animated animate__fadeInDown"s tyle="animation-delay: 0.9s;">
        Booking sekarang <i class="bx bx-plus"></i> <!-- Use any icon -->
    </a>
</div>
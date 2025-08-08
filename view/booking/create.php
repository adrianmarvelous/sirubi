<div class="card">
    <h1 class="text-center">Buat Permohonan Baru</h1>
    <div class="container">
        <form action="controller/booking.php" method="post" enctype="multipart/form-data">
            <div class="border border-3 rounded p-3">
                <h4 class="fw-bold" style="color: #737c85;">Data Diri</h2>
                <!-- Other inputs -->
                 <div class="row mt-3">
                    <div class="col-lg-3">
                        <label class="fw-bold">Gunakan</label>
                    </div>
                    <div class="col-lg-9">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkboxAtasNama" checked>
                            <label class="form-check-label" for="checkboxAtasNama" chec>Data Diri Sendiri</label>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label class="fw-bold" for="">Nama</label>
                    </div>
                    <div class="col-lg-9">
                        <input id="inputNama" type="text" class="form-control" name="name" value="<?=$check_user['name']?>" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label class="fw-bold" for="">Instansi</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" id="inputInstansi" class="form-control" name="instansi"   value="<?=$check_user['instansi']?>" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label class="fw-bold" for="">Telp</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" id="inputTelp" class="form-control" name="telp" value="<?=$check_user['telp']?>" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label class="fw-bold" for="">Alamat</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" id="inputAlamat" class="form-control" name="alamat" value="<?=$check_user['alamat']?>" required>
                    </div>
                </div>
            </div>
            
            <div class="border border-3 rounded p-3 mt-3">
                <h4 class="fw-bold" style="color: #737c85;">Data Permohonan</h2>
                <!-- Container to hold all tanggal peminjaman rows -->
                    <div class="row mt-3">
                        <div class="col-lg-3">
                            <label class="fw-bold" for="">Nama Kegiatan</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="nama_kegiatan"  required>
                        </div>
                    </div>
                    <div id="tanggal-container">
                        <div class="border border-3 rounded p-3 mt-3">
                            <div class="row mt-3 tanggal-row">
                                <div class="col-lg-3">
                                    <label class="fw-bold" for="">Tanggal Peminjaman</label>
                                </div>
                                <div class="col-lg-9">
                                    <input type="date" name="tanggal_peminjaman[]" class="form-control" value="<?= $tanggal_mulai ?>" required readonly>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-3">
                                    <label class="fw-bold" for="">Pukul Mulai</label>
                                </div>
                                <div class="col-lg-2">
                                    <input type="time" name="pukul_mulai[]" class="form-control" required>
                                </div>
                                <div class="col-lg-2">
                                    <label class="fw-bold" for="">Pukul Selesai</label>
                                </div>
                                <div class="col-lg-2">
                                    <input type="time" name="pukul_selesai[]" class="form-control" required>
                                </div>
                                <div class="col-lg-3">
                                    <button type="button" class="btn btn-danger btn-delete-tanggal w-100">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Button to add more date inputs -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary" id="add-tanggal" required>Tambah Tanggal</button>
                        </div>
                    </div>
            </div>
            
            <div class="border border-3 rounded p-3 mt-3">
                <h4 class="fw-bold" style="color: #737c85;">Data Pendukung</h2>
                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label class="fw-bold" for="">Nomer Surat Permohonan</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="nomor_surat_permohonan" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label class="fw-bold" for="">Tanggal Surat Permohonan</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="date" class="form-control" name="tanggal_surat_permohonan" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label class="fw-bold" for="">Upload Surat Permohonan</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="file" class="form-control" name="surat_permohonan" accept="application/pdf" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label class="fw-bold" for="">Upload Proposal / Rundown Acara</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="file" class="form-control" name="proposal" accept="application/pdf" required>
                    </div>
                </div>
            </div>
            <div>
                <input type="hidden" name="action" value="create">
                <div class="d-flex justify-content-end mt-3 mb-3">
                    <button class="btn btn-primary">Next</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('add-tanggal').addEventListener('click', function () {
        const container = document.getElementById('tanggal-container');

        const group = document.createElement('div');
        group.className = 'border border-3 rounded p-3 mt-3';
        group.innerHTML = `
            <div class="row mt-3 tanggal-row">
                <div class="col-lg-3">
                    <label class="fw-bold" for="">Tanggal Peminjaman</label>
                </div>
                <div class="col-lg-9">
                    <input type="date" name="tanggal_peminjaman[]" class="form-control" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-3">
                    <label class="fw-bold" for="">Pukul Mulai</label>
                </div>
                <div class="col-lg-2">
                    <input type="time" name="pukul_mulai[]" class="form-control" required>
                </div>
                <div class="col-lg-2">
                    <label class="fw-bold" for="">Pukul Selesai</label>
                </div>
                <div class="col-lg-2">
                    <input type="time" name="pukul_selesai[]" class="form-control" required>
                </div>
                <div class="col-lg-3">
                    <button type="button" class="btn btn-danger btn-delete-tanggal w-100">Hapus</button>
                </div>
            </div>
        `;

        container.appendChild(group);
    });

    // Delete entire group when "Hapus" button clicked
    document.getElementById('tanggal-container').addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-delete-tanggal')) {
            const group = e.target.closest('.border');
            if (group) group.remove();
        }
    });
</script>
<script>
    const userData = {
        name: "<?= $check_user['name'] ?>",
        instansi: "<?= $check_user['instansi'] ?>",
        telp: "<?= $check_user['telp'] ?>",
        alamat: "<?= $check_user['alamat'] ?>"
    };

    const checkbox = document.getElementById('checkboxAtasNama');
    const inputNama = document.getElementById('inputNama');
    const inputInstansi = document.getElementById('inputInstansi');
    const inputTelp = document.getElementById('inputTelp');
    const inputAlamat = document.getElementById('inputAlamat');

    function updateFields() {
        if (checkbox.checked) {
            inputNama.value = userData.name;
            inputInstansi.value = userData.instansi;
            inputTelp.value = userData.telp;
            inputAlamat.value = userData.alamat;
        } else {
            inputNama.value = '';
            inputInstansi.value = '';
            inputTelp.value = '';
            inputAlamat.value = '';
        }
    }

    checkbox.addEventListener('change', updateFields);

    // Run on page load
    window.addEventListener('DOMContentLoaded', updateFields);
</script>







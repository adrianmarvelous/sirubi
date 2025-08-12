<div class="card">
    <h1 class="text-center">Buat Permohonan Baru</h1>
    <div class="container">
        <form action="controller/booking.php" method="post" enctype="multipart/form-data">
            <div class="border border-3 rounded p-3">
                <h4 class="fw-bold" style="color: #737c85;">Data Diri</h2>

                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label class="fw-bold" for="">Nama</label>
                    </div>
                    <div class="col-lg-9">
                        <input id="inputNama" type="text" class="form-control" name="name" value="<?=$data_permohonan['name']?>" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label class="fw-bold" for="">Instansi</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" id="inputInstansi" class="form-control" name="instansi" value="<?=$data_permohonan['instansi']?>" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label class="fw-bold" for="">Telp</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" id="inputTelp" class="form-control" name="telp" value="<?=$data_permohonan['telp']?>" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label class="fw-bold" for="">Alamat</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" id="inputAlamat" class="form-control" name="alamat" value="<?=$data_permohonan['alamat']?>" required>
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
                            <input type="text" class="form-control" name="nama_kegiatan" value="<?=$data_permohonan['nama_kegiatan']?>"  required>
                        </div>
                    </div>
                    <div id="tanggal-container">
                        <?php
                            foreach ($data_tanggal as $key => $tanggal) {
                        ?>
                        
                            <div class="border border-3 rounded p-3 mt-3">
                        <input type="hidden" name="id_tanggal_booking[]" value="<?=$tanggal['id_tanggal_booking']?>">
                                <div class="row mt-3 tanggal-row">
                                    <div class="col-lg-3">
                                        <label class="fw-bold" for="">Tanggal Peminjaman</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="date" name="tanggal_peminjaman[]" class="form-control" value="<?= $tanggal['tanggal'] ?>" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-3">
                                        <label class="fw-bold" for="">Pukul Mulai</label>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="time" name="pukul_mulai[]" class="form-control" value="<?=$tanggal['pukul_mulai']?>" required>
                                    </div>
                                    <div class="col-lg-2">
                                        <label class="fw-bold" for="">Pukul Selesai</label>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="time" name="pukul_selesai[]" class="form-control" value="<?=$tanggal['pukul_selesai']?>" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <button type="button" class="btn btn-danger btn-delete-tanggal w-100">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
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
                        <input type="text" class="form-control" name="nomor_surat_permohonan" value="<?=$data_permohonan['nomor_surat_permohonan']?>"  required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label class="fw-bold" for="">Tanggal Surat Permohonan</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="date" class="form-control" name="tanggal_surat_permohonan" value="<?=$data_permohonan['tanggal_surat_permohonan']?>"  required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label class="fw-bold" for="">Perihal Surat Permohonan</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="perihal_surat_permohonan" value="<?=$data_permohonan['perihal_surat_permohonan']?>"  required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label class="fw-bold" for="">Upload Surat Permohonan</label>
                    </div>
                    <div class="col-lg-1">
                        <a class="btn btn-primary" href="<?=$data_permohonan['upload_surat_permohonan']?>" target="_blank"><i class="bx bxs-file-pdf"></i></a>
                    </div>
                    <div class="col-lg-8">
                        <input type="file" class="form-control" name="surat_permohonan" accept="application/pdf">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label class="fw-bold" for="">Upload Proposal / Rundown Acara</label>
                    </div>
                    <div class="col-lg-1">
                        <a class="btn btn-primary" href="<?=$data_permohonan['upload_proposal_rundown']?>"target="_blank"><i class="bx bxs-file-pdf"></i></a>
                    </div>
                    <div class="col-lg-8">
                        <input type="file" class="form-control" name="proposal" accept="application/pdf">
                    </div>
                </div>
            </div>
            <div>
                <input type="hidden" name="id_booking" value="<?=$data_permohonan['id_booking']?>">
                <input type="hidden" name="action" value="save_edit">
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






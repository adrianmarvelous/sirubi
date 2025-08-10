<div class="card">
    <h1 class="text-center p-3">Bukti Pengajuan Permohonan</h1>
    <div class="container">
        <div class="border border-3 rounded p-3 mt-3">
            <h4 style="color: #737c85;">Data Diri</h2>
            <div class="row">
                <div class="col-lg-3">
                    <label for="" class="fw-bold">Nama</label>
                </div>
                <div class="col-lg-9">
                    <p><?=$data_permohonan['name']?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <label for="" class="fw-bold">Instansi</label>
                </div>
                <div class="col-lg-9">
                    <p><?=$data_permohonan['instansi']?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <label for="" class="fw-bold">No Telp</label>
                </div>
                <div class="col-lg-9">
                    <p><?=$data_permohonan['telp']?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <label for="" class="fw-bold">Alamat</label>
                </div>
                <div class="col-lg-9">
                    <p><?=$data_permohonan['alamat']?></p>
                </div>
            </div>
        </div>
        
        <div class="border border-3 rounded p-3 mt-3">
            <h4 style="color: #737c85;">Data Permohonan</h2>
            <div class="row">
                <div class="col-lg-3">
                    <label for="" class="fw-bold">Nama Kegiatan</label>
                </div>
                <div class="col-lg-9">
                    <p><?=$data_permohonan['nama_kegiatan']?></p>
                </div>
            </div>
            <?php
                foreach ($data_permohonan['tanggal'] as $key => $value) {
            ?>
                <div class="row">
                    <div class="col-lg-3">
                        <label for="" class="fw-bold">Tanggal <?=$key+1?></label>
                    </div>
                    <div class="col-lg-9">
                        <p><?=date('d-M-Y',strtotime($value['tanggal']))?> Pukul <?=date('H:i',strtotime($value['pukul_mulai']))?> - <?=date('H:i',strtotime($value['pukul_selesai']))?></p>
                    </div>
                </div>
            <?php }?>
        </div>
        <div class="border border-3 rounded p-3 mt-3 mb-3">
            <h4 style="color: #737c85;">Data Pendukung</h2>
            <div class="row">
                <div class="col-lg-3">
                    <label for="" class="fw-bold">Nomor Surat Permohonan</label>
                </div>
                <div class="col-lg-9">
                    <p><?=$data_permohonan['nomor_surat_permohonan']?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <label for="" class="fw-bold">Tanggal Surat Permohonan</label>
                </div>
                <div class="col-lg-9">
                    <p><?=date('d-M-Y',strtotime($data_permohonan['tanggal_surat_permohonan']))?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <label for="" class="fw-bold">Perihal Surat Permohonan</label>
                </div>
                <div class="col-lg-9">
                    <p><?=$data_permohonan['perihal_surat_permohonan']?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <label for="" class="fw-bold">Surat Pernyataan</label>
                </div>
                <div class="col-lg-9">
                    <a class="btn btn-primary" href="?pages=create_part_2&id_booking=<?=$data_permohonan['id_booking']?>">View</a>
                    <!-- <a class="btn btn-primary" href="<?=$data_permohonan['upload_surat_permohonan']?>" target="_blank"><i class="bx bxs-file-pdf"></i></a> -->
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-3">
                    <label for="" class="fw-bold">Surat Permohonan</label>
                </div>
                <div class="col-lg-9">
                    <a class="btn btn-primary" href="<?=$data_permohonan['upload_surat_permohonan']?>" target="_blank"><i class="bx bxs-file-pdf"></i></a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-3">
                    <label for="" class="fw-bold">Proposal / Rundown Acara</label>
                </div>
                <div class="col-lg-9">
                    <a class="btn btn-primary" href="<?=$data_permohonan['upload_proposal_rundown']?>" target="_blank"><i class="bx bxs-file-pdf"></i></a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-3">
                    <label for="" class="fw-bold">Posisi Berkas</label>
                </div>
                <div class="col-lg-9">
                    <p>
                        <?php
                        if($data_permohonan['id_posisi_berkas'] != 7)
                        {
                            echo $data_permohonan['posisi'];
                        }else{?>
                            <a class="btn btn-primary" href="print/surat_ijin.php?id=<?=$data_permohonan['id_booking']?>">Surat Balasan</a>
                        <?php }
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <?php
            if(htmlentities(isset($balasan))){
        ?>
        <div class="border border-3 rounded p-3 mt-3 mb-3">
            <h4 style="color: #737c85;">History Balasan</h2>
            <?php
                foreach ($balasan as $key_balasan => $value_balasan) {
            ?>
                <h5>Balasan ke <?=$key_balasan+1?></h5>
                <div class="row">
                    <div class="col-lg-3">
                        <label for="" class="fw-bold">Tanggal</label>
                    </div>
                    <div class="col-lg-9">
                        <p><?=date('d-M-Y H:i',strtotime($value_balasan['created_at']))?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <label for="" class="fw-bold">Alasan</label>
                    </div>
                    <div class="col-lg-9">
                        <p><?=$value_balasan['alasan']?></p>
                    </div>
                </div>
            <?php }?>
        </div>
        <?php }?>
        <div class="d-flex">
            <?php
                if(htmlentities($_SESSION['role_id']) == 1){
            ?>
                <a class="btn btn-success w-100 m-3" href=""><i class="bx bx-bxl-whatsapp"></i></a>
                <a class="btn btn-info w-100 m-3" href="print/bukti_pengajuan.php?id_booking=<?=$data_permohonan['id_booking']?>" target="_blank"><i class="bx bx-printer"></i></a>
            <?php }else{
                    if(htmlentities($_SESSION['role_id']) == $data_permohonan['id_posisi_berkas']){    
            ?>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger w-100 m-3" data-bs-toggle="modal" data-bs-target="#basicModalditolak">
                Tolak
                </button>
                <!-- Modal -->
                <div class="modal fade" id="basicModalditolak" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Berikan Alasan Ditolak</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="controller/booking.php" method="get">
                                <div class="modal-body">
                                    <div class="row">
                                        <textarea name="alasan" class="form-control w-100 o" id=""></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="id_booking" value="<?=$data_permohonan['id_booking']?>">
                                    <input type="hidden" name="pages" value="ditolak">
                                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary w-100 m-3" data-bs-toggle="modal" data-bs-target="#basicModalApprove">
                Approve
                </button>
                <!-- Button trigger modal -->

                <!-- Modal -->
                <div class="modal fade" id="basicModalApprove" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Apakah Anda Yakin?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="get">
                            <div class="modal-body">
                                <div class="row">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="id_booking" value="<?=$data_permohonan['id_booking']?>">
                                <input type="hidden" name="id_posisi_berkas" value="<?=$data_permohonan['id_posisi_berkas']?>">
                                <input type="hidden" name="pages" value="approve">
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Approve</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            <?php }elseif(htmlentities($_SESSION['role_id']) == 2 && $data_permohonan['id_posisi_berkas'] == 6){?>

                <button type="button" class="btn btn-primary w-100 m-3" data-bs-toggle="modal" data-bs-target="#basicModalnomor_surat">
                Masukan Nomor Surat
                </button>
                <!-- Button trigger modal -->

                <!-- Modal -->
                <div class="modal fade" id="basicModalnomor_surat" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Masukan Nomor Surat</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="get">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="" class="fw-bold">Masukan Nomor Surat Balasan</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" name="nomor_surat_balasan" required>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-lg-12">
                                            <label for="" class="fw-bold">Masukan Tanggal Surat Balasan</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <input type="date" class="form-control" name="tanggal_surat_balasan" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="id_booking" value="<?=$data_permohonan['id_booking']?>">
                                    <input type="hidden" name="id_posisi_berkas" value="<?=$data_permohonan['id_posisi_berkas']?>">
                                    <input type="hidden" name="pages" value="approve">
                                    <input type="hidden" name="sub_pages" value="input_nomor_surat">
                                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php }}?>
        </div>
    </div>
</div>
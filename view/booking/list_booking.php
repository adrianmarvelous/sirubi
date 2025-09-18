<div class="card p-3">
    <h1 class="text-center">Daftar Pengajuan</h1>
    <div class="table-responsive">
        <table class="table" id="example">
            <thead>
                <tr class="table-primary">
                    <td>No</td>
                    <td>Tanggal Pengajuan</td>
                    <td>Tanggal Peminjaman</td>
                    <td>Nama Kegiatan</td>
                    <td>Instansi</td>
                    <td>Posisi Berkas</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0; 
                    foreach ($permohonan as $key => $value) { $i++;
                ?>
                <tr class="<?= $value['id_posisi_berkas'] < 7 ? 'table-danger' : 'table-success' ?>">
                        <td class="text-center"><?=$key+1?></td>
                        <td><?=date('d-M-Y',strtotime($value['created_at']))?></td>
                        <td>
                            <?php
                                foreach ($value['tanggal'] as $key => $tanggal) {
                                    echo date('d-M-Y',strtotime( $tanggal['tanggal'])); echo '<br>';
                                }
                            ?>
                        </td>
                        <td><?=$value['nama_kegiatan']?></td>
                        <td><?=$value['instansi']?></td>
                        <td><?=$value['posisi']?></td>
                        <td>
                            <div class="d-flex flex-column">
                                <a class="btn btn-primary m-1" href="?pages=pengajuan_selesai&id=<?= $value['id_booking'] ?>">Detail</a>
                                <?php
                                    if($value['id_posisi_berkas'] == 7){
                                        if(htmlentities($_SESSION['role_id']) == 1){
                                ?>
                                <a class="btn btn-info m-1" href="?pages=laporan&id=<?=$value['id_booking']?>">Laporan</a>
                                <?php 
                                    }else{
                                        $q_laporan = $db->prepare("SELECT * FROM rb_laporan WHERE id_booking = :id");
                                        $q_laporan->bindParam(':id', $value['id_booking']);
                                        $q_laporan->execute();
                                        if($q_laporan->rowCount() > 0){?>
                                <a class="btn btn-info m-1" href="?pages=laporan&id=<?=$value['id_booking']?>">Laporan</a>
                                    <?php }}
                                }
                                ?>
                                <?php
                                    if(htmlentities($_SESSION['role_id']) == 2){
                                ?>
                                <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger m-1" data-bs-toggle="modal" data-bs-target="#exampleModal<?=$i?>">
                                    Hapus
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal<?=$i?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Pengajuan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah anda yakin ingin mengapus pengajuan dari <?=$value['instansi']?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <a href="index.php?pages=hapus&id=<?=$value['id_booking']?>" class="btn btn-danger">
                                                    Hapus
                                                </a>

                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }?>
                            </div>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
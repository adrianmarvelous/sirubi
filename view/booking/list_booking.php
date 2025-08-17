<div class="card p-3">
    <h1 class="text-center">Daftar Pengajuan</h1>
    <div class="table-responsive">
        <table class="table">
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
                    foreach ($permohonan as $key => $value) {
                ?>
                <tr class="<?= $value['id_posisi_berkas'] < 7 ? 'table-danger' : 'table-success' ?>">
                        <td><?=$key+1?></td>
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
                            <a class="btn btn-primary" href="?pages=pengajuan_selesai&id=<?= $value['id_booking'] ?>">Detail</a>
                            <?php
                                if($value['id_posisi_berkas'] == 7){
                                    if(htmlentities($_SESSION['role_id']) == 1){
                            ?>
                            <a class="btn btn-info" href="?pages=laporan&id=<?=$value['id_booking']?>">Laporan</a>
                            <?php 
                                }else{
                                    $q_laporan = $db->prepare("SELECT * FROM rb_laporan WHERE id_booking = :id");
                                    $q_laporan->bindParam(':id', $value['id_booking']);
                                    $q_laporan->execute();
                                    if($q_laporan->rowCount() > 0){?>
                            <a class="btn btn-info" href="?pages=laporan&id=<?=$value['id_booking']?>">Laporan</a>
                                <?php }}
                            }
                            ?>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
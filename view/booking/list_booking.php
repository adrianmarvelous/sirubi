<div class="card p-3">
    <h1 class="text-center">Daftar Pengajuan</h1>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr class="table-primary">
                    <td>No</td>
                    <td>Tanggal</td>
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
                    <tr>
                        <td><?=$key+1?></td>
                        <td>
                            <?php
                                foreach ($value['tanggal'] as $key => $tanggal) {
                                    echo $tanggal['tanggal']; echo '<br>';
                                }
                            ?>
                        </td>
                        <td><?=$value['nama_kegiatan']?></td>
                        <td><?=$value['instansi']?></td>
                        <td><?=$value['posisi']?></td>
                        <td><a class="btn btn-primary" href="?pages=pengajuan_selesai&id=<?=$value['id_booking']?>">Detail</a></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
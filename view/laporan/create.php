<div class="card p-3">
    <h1 class="text-center">Laporan Kegiatan</h1>
    
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
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="border border-3 rounded p-3 mt-3">
            <h4 style="color: #737c85;">Upload Foto Kegiatan</h2>
            <div class="row">
                <div class="col-lg-3">
                    <label for="" class="fw-bold">Upload Foto</label>
                </div>
                <div class="col-lg-9">
                    <input type="file" class="form-control" name="foto_kegiatan[]" accept="image/*" multiple required>
                </div>
            </div>
        </div>
        <div class="border border-3 rounded p-3 mt-3">
            <h4 style="color: #737c85;">Survei Kepuasan Peminjaman Sirubi</h4>
            
            <?php
                $options = [
                    5 => "Sangat Mudah",
                    4 => "Mudah",
                    3 => "Cukup",
                    2 => "Sulit",
                    1 => "Sangat Sulit"
                ];

                $pertanyaan = [
                    'q1' => 'Bagaimana kemudahan Anda dalam mengakses dan menggunakan sistem peminjaman SiRUBI?',
                    'q2' => 'Bagaimana Anda menilai kejelasan alur atau prosedur peminjaman melalui SiRUBI?',
                    'q3' => 'Apakah informasi yang tersedia di dalam sistem (jadwal, prosedur, syarat peminjaman) sudah jelas dan mudah dipahami?',
                    'q4' => 'Sejauh mana fasilitas Rumah Bhinneka yang Anda pinjam sesuai dengan deskripsi dan kebutuhan kegiatan Anda?',
                    'q5' => 'Secara keseluruhan, bagaimana tingkat kepuasan Anda terhadap proses peminjaman melalui SiRUBI?'
                ];

                for ($q = 1; $q <= 5; $q++) {
                    $questionText = $pertanyaan['q' . $q]; // get custom question text

                    echo '<div class="mb-3 mt-5">';
                    echo '<label class="form-label fw-bold">' . $q . '. ' . $questionText . '</label>';

                    foreach ($options as $value => $label) {
                        $id = $q . '.' . $value; // unique id like 1.5
                        echo '<div class="form-check">';
                        echo '<input class="form-check-input" type="radio" name="pertanyaan_' . $q . '" id="' . $id . '" value="' . $value . '" required>';
                        echo '<label class="form-check-label" for="' . $id . '">' . $label . '</label>';
                        echo '</div>';
                    }

                    echo '</div>';
                }
            ?>



        </div>
        <div class="d-flex justify-content-end mt-3">
            <input type="hidden" name="pages" value="simpan_laporan">
            <input type="hidden" name="id_booking" value="<?=$data_permohonan['id_booking']?>">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>

</div>
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
        
        <!-- Question 1 -->
        <div class="mb-3">
            <label class="form-label fw-bold">1. Bagaimana kemudahan Anda dalam mengakses dan menggunakan sistem peminjaman SiRUBI?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="q1_service_satisfaction" id="q1_verySatisfied" value="very_satisfied">
                <label class="form-check-label" for="q1_verySatisfied">Sangat Mudah</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="q1_service_satisfaction" id="q1_satisfied" value="satisfied">
                <label class="form-check-label" for="q1_satisfied">Mudah</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="q1_service_satisfaction" id="q1_neutral" value="neutral">
                <label class="form-check-label" for="q1_neutral">Cukup</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="q1_service_satisfaction" id="q1_unsatisfied" value="unsatisfied">
                <label class="form-check-label" for="q1_unsatisfied">Sulit</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="q1_service_satisfaction" id="q1_unsatisfieds" value="unsatisfied">
                <label class="form-check-label" for="q1_unsatisfieds">Sangat Sulit</label>
            </div>
        </div>

        <!-- Question 2 -->
        <div class="mb-3">
            <label class="form-label fw-bold">2. How clear was the borrowing procedure?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="q2_procedure_clarity" id="q2_veryClear" value="very_clear">
                <label class="form-check-label" for="q2_veryClear">Very Clear & Structured</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="q2_procedure_clarity" id="q2_clear" value="clear">
                <label class="form-check-label" for="q2_clear">Clear</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="q2_procedure_clarity" id="q2_quiteClear" value="quite_clear">
                <label class="form-check-label" for="q2_quiteClear">Quite Clear</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="q2_procedure_clarity" id="q2_unclear" value="unclear">
                <label class="form-check-label" for="q2_unclear">Unclear</label>
            </div>
        </div>
    </div>

</div>
<div class="card">
    <h1 class="text-center">Buat Permohonan Baru</h1>
    <div class="container">
        <!-- Container to hold all tanggal peminjaman rows -->
        <form action="controller/calendar.php" method="post" enctype="multipart/form-data">
            <div id="tanggal-container">
                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label for="">Tanggal Peminjaman</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="date" name="tanggal_peminjaman[]" class="form-control" value="<?= $tanggal_mulai ?>">
                    </div>
                </div>
            </div>

            <!-- Button to add more date inputs -->
            <div class="row mt-3">
                <div class="col-12">
                    <button type="button" class="btn btn-primary" id="add-tanggal" required>Tambah Tanggal</button>
                </div>
            </div>

            <!-- Other inputs -->
            <div class="row mt-3">
                <div class="col-lg-3">
                    <label for="">Nama</label>
                </div>
                <div class="col-lg-9">
                    <input type="text" class="form-control" name="name" value="<?=$check_user['name']?>" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-3">
                    <label for="">Instansi</label>
                </div>
                <div class="col-lg-9">
                    <input type="text" class="form-control" name="instansi" value="<?=$check_user['instansi']?>" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-3">
                    <label for="">Telp</label>
                </div>
                <div class="col-lg-9">
                    <input type="text" class="form-control" name="telp" value="<?=$check_user['telp']?>" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-3">
                    <label for="">Upload Surat Permohonan</label>
                </div>
                <div class="col-lg-9">
                    <input type="file" class="form-control" name="surat_permohonan" accept="application/pdf" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-3">
                    <label for="">Upload Proposal / Rundown Acara</label>
                </div>
                <div class="col-lg-9">
                    <input type="file" class="form-control" name="proposal" accept="application/pdf" required>
                </div>
            </div>
            <input type="hidden" name="action" value="create">
            <div class="d-flex justify-content-end mt-3 mb-3">
                <button class="btn btn-primary">Next</button>
            </div>
        </form>
    </div>
</div>

<!-- Include JS -->
<script>
document.getElementById('add-tanggal').addEventListener('click', function () {
    const container = document.getElementById('tanggal-container');

    const row = document.createElement('div');
    row.className = 'row mt-3';

    row.innerHTML = `
        <div class="col-lg-3">
            <label for="">Tanggal Peminjaman</label>
        </div>
        <div class="col-lg-9">
            <input type="date" name="tanggal_peminjaman[]" class="form-control" required>
        </div>
    `;

    container.appendChild(row);
});
</script>

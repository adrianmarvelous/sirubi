<div class="card p-3">
    <h1 class="text-center">Surat Pernyataan Kesanggupan</h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-12">
                <label for="">Nama</label>
            </div>
            <div class="col-lg-9 col-sm-12">
                <p><?=htmlentities($_SESSION['temp']['name'])?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-12">
                <label for="">Instansi</label>
            </div>
            <div class="col-lg-9 col-sm-12">
                <p><?=htmlentities($_SESSION['temp']['instansi'])?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-12">
                <label for="">No Telp</label>
            </div>
            <div class="col-lg-9 col-sm-12">
                <p><?=htmlentities($_SESSION['temp']['telp'])?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-12">
                <label for="">Alamat</label>
            </div>
            <div class="col-lg-9 col-sm-12">
                <p><?=htmlentities($_SESSION['temp']['alamat'])?></p>
            </div>
        </div>
    </div>
</div>
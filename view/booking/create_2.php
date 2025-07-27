 <style>
    #signature-pad {
      border: 1px solid #ccc;
      border-radius: 8px;
      width: 100%;
      max-width: 500px;
      height: 200px;
      touch-action: none;
    }
    .buttons {
      margin-top: 10px;
    }
    button {
      padding: 6px 12px;
      margin-right: 5px;
    }
  </style>
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
        <p style="text-align: justify;">
            Dengan ini menyatakan bahwa kami menyetujui seluruh syarat dan ketentuan peminjaman Rumah Bhinneka yang berlokasi di Jalan Nginden Baru 6 No. 28, Kecamatan Sukolilo, Kota Surabaya, dengan ketentuan sebagai berikut:
        </p>
        <ol style="text-align: justify;">
            <li>
                Kegiatan yang dilaksanakan akan mengacu sepenuhnya pada isi Surat Permohonan Peminjaman yang telah diajukan kepada Bakesbangpol Kota Surabaya.
            </li>
            <li>
                Kami bertanggung jawab menjaga kebersihan, ketertiban, dan keamanan seluruh area, fasilitas, dan sarana prasarana Rumah Bhinneka selama kegiatan berlangsung.
            </li>
            <li>
                Rumah Bhinneka tidak akan digunakan untuk kegiatan politik, kampanye, atau aktivitas yang berafiliasi dengan partai politik.
            </li>
            <li>
                Jumlah peserta yang hadir akan sesuai dengan data yang tercantum dalam Surat Permohonan, dan tidak membawa pihak di luar yang telah didaftarkan, kecuali seizin Bakesbangpol.
            </li>
            <li>
                Tidak melakukan perbuatan atau kegiatan yang bertentangan dengan norma, etika, dan peraturan hukum yang berlaku.
            </li>
            <li>
                Tidak melakukan kegiatan promosi atau penawaran produk/jasa komersial yang dapat menimbulkan kerugian materiil maupun non-materiil kepada pihak lain maupun Pemerintah Kota Surabaya.
            </li>
            <li>
                Kegiatan akan dilaksanakan sesuai dengan rundown atau susunan acara yang telah disusun dan disampaikan sebelumnya.
            </li>
            <li>
                Bertanggung jawab atas kerusakan atau kehilangan fasilitas Rumah Bhinneka selama masa pemakaian, dan bersedia memperbaiki atau mengganti kerusakan tersebut sesuai ketentuan.
            </li>
            <li>
                Bersedia melapor kepada petugas yang berada di Rumah Bhinneka apabila terjadi hal-hal yang perlu penanganan, termasuk saat akan meninggalkan lokasi kegiatan.
            </li>
            <li>
                Bakesbangpol Kota Surabaya berhak membatalkan peminjaman sewaktu-waktu jika Rumah Bhinneka dibutuhkan untuk kegiatan kedinasan yang bersifat mendesak, dengan pemberitahuan melalui surat atau media elektronik.
            </li>
            <li>
                Dalam hal pembatalan sebagaimana ketentuan nomor 10 (sepuluh), pemohon dapat mengajukan penjadwalan ulang kegiatan sesuai ketentuan yang berlaku di lingkungan Bakesbangpol Kota Surabaya.
            </li>
            <li>
                Pemerintah Kota Surabaya berhak untuk mengambil tindakan hukum apabila terdapat pelanggaran atas pernyataan dan ketentuan yang telah disepakati.
            </li>
        </ol>
        <p style="text-align: justify;">
            Demikian surat pernyataan ini kami buat secara jujur dan sukarela. Kami berkomitmen untuk menaati seluruh ketentuan yang berlaku dan bersedia menerima sanksi apabila terjadi pelanggaran, termasuk penghentian kegiatan atas kebijakan Pemerintah Kota Surabaya.
        </p>
        <!-- <table style="width: 100%;">
            <tr>
                <td style="width: 50%;"></td>
                <td class="text-center" style="width: 50%;">Surabaya, .....................</td>
            </tr>
            <tr>
                <td style="width: 50%;"></td>
                <td class="text-center" style="width: 50%;">Hormat Saya</td>
            </tr>
            <tr>
                <td style="width: 50%;"></td>
                <td class="text-center" style="width: 50%;height:30px">
                    <div>
                        <canvas id="signature-pad"></canvas>
                        <div class="buttons">
                            <button class="btn btn-danger" onclick="clearSignature()">Clear</button>
                            <button  class="btn btn-primary" onclick="saveSignature()">Save</button>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 50%;"></td>
                <td class="text-center" style="width: 50%;"><?=htmlentities($_SESSION['temp']['name'])?></td>
            </tr>
        </table> -->
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12"></div>
                <div class="col-lg-6 col-md-6 col-12 text-center">Surabaya, .....................</div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12"></div>
                <div class="col-lg-6 col-md-6 col-12 text-center">Hormat Saya</div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12"></div>
                <div class="col-lg-6 col-md-6 col-12 text-center">
                    <div>
                        <form action="controller/booking.php" method="post">
                            <canvas id="signature-pad"></canvas>
                            <div class="buttons">
                                <input type="hidden" name="action" value="save">
                                <input type="hidden" name="signature_image" id="signature-data">
                                <img id="signature-preview" style="margin-top: 10px; display:none;" />
                                <button class="btn btn-danger" onclick="clearSignature()">Clear</button>
                                <button type="submit" class="btn btn-primary" onclick="saveSignature()">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12"></div>
                <div class="col-lg-6 col-md-6 col-12 text-center"><?=htmlentities($_SESSION['temp']['name'])?></div>
            </div>
        </div>
    </div>
</div>
<script>
const canvas = document.getElementById('signature-pad');
const ctx = canvas.getContext('2d');
const hiddenInput = document.getElementById('signature-data');
const imgPreview = document.getElementById('signature-preview');
let drawing = false;

// Resize canvas to element size
function resizeCanvas() {
    const rect = canvas.getBoundingClientRect();
    canvas.width = rect.width;
    canvas.height = rect.height;
}
resizeCanvas();

// Draw with mouse
canvas.addEventListener('mousedown', (e) => {
    drawing = true;
    ctx.beginPath();
    ctx.moveTo(e.offsetX, e.offsetY);
});
canvas.addEventListener('mousemove', (e) => {
    if (!drawing) return;
    ctx.lineTo(e.offsetX, e.offsetY);
    ctx.stroke();
});
canvas.addEventListener('mouseup', () => drawing = false);
canvas.addEventListener('mouseleave', () => drawing = false);

// Draw with touch
canvas.addEventListener('touchstart', (e) => {
    e.preventDefault();
    const touch = e.touches[0];
    const rect = canvas.getBoundingClientRect();
    ctx.beginPath();
    ctx.moveTo(touch.clientX - rect.left, touch.clientY - rect.top);
    drawing = true;
});
canvas.addEventListener('touchmove', (e) => {
    e.preventDefault();
    if (!drawing) return;
    const touch = e.touches[0];
    const rect = canvas.getBoundingClientRect();
    ctx.lineTo(touch.clientX - rect.left, touch.clientY - rect.top);
    ctx.stroke();
});
canvas.addEventListener('touchend', () => drawing = false);

// Clear signature
function clearSignature() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    hiddenInput.value = '';
    imgPreview.style.display = 'none';
}

// Save and submit
function submitSignature() {
    const dataURL = canvas.toDataURL('image/png');
    hiddenInput.value = dataURL;
    imgPreview.src = dataURL;
    imgPreview.style.display = 'block';

    // Manually submit form
    hiddenInput.form.submit();
}

// Redraw signature after resize
window.addEventListener('resize', () => {
    const saved = canvas.toDataURL();
    resizeCanvas();
    const image = new Image();
    image.onload = () => ctx.drawImage(image, 0, 0);
    image.src = saved;
});
function saveSignature() {
  const dataURL = canvas.toDataURL('image/png');
  hiddenInput.value = dataURL;
}

</script>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Keterangan</title>
  <style>
    body {
      font-family: "Times New Roman", serif;
      font-size: 14px;
      margin: 40px;
      line-height: 1.6;
    }
    .header {
      text-align: center;
      font-weight: bold;
    }
    .instansi {
      font-size: 16px;
      margin-bottom: 10px;
      text-align: left;
    }
    .logo {
      width: 80px;
      position: absolute;
      align-items: center;
      top: 40px;
      left: 50%;
      transform: translateX(-50%);
    }
    .title {
      font-weight: bold;
      text-align: center;
      font-size: 16px;
      margin-top: 20px;
      text-decoration: underline;
      padding-top: 25px;
    }
    .nomor {
      text-align: center;
      margin-bottom: 20px;
    }
    .content {
      text-align: justify;
    }
    .identitas {
      margin-left: 20px;
    }
    ul {
      list-style-type: none;
      padding-left: 0;
    }
    .ttd {
      float: right;
      text-align: center;
      margin-top: 40px;
    }
    .clear {
      clear: both;
    }
    /* Tombol cetak */
    .btn-print {
      display: inline-block;
      background: #007bff;
      color: #fff;
      padding: 8px 15px;
      text-decoration: none;
      border-radius: 5px;
      font-size: 14px;
      margin-bottom: 20px;
    }
    .btn-print:hover {
      background: #0056b3;
    }

    /* Sembunyikan tombol saat print */
    @media print {
      .btn-print {
        display: none;
      }
    }
  </style>
</head>
<body>

  <!-- Tombol Cetak -->
   <div style="float: right;" class="cetak">
  <a href="#" class="btn-print" onclick="window.print()">🖨 Cetak Surat</a>

   </div>

  <div class="header" >
    <div class="instansi">POLRI DAERAH METRO JAYA<br>DIREKTORAT LALU LINTAS</div>
    <img src="<?= base_url('uploads/polri.png') ?>" alt="Logo" class="logo" height="80">
  </div>

  <div class="title">SURAT KETERANGAN</div>
  <div class="nomor">Nomor : Sket / <?= date('m') ?> / <?= date('Y') ?> / Dit Lantas</div>

  <div class="content">
    <p><strong>1. Rujukan</strong><br>
      a. Pasal 64 Undang-Undang Nomor 22 Tahun 2009 tentang Lalu Lintas dan Angkutan jalan;<br>
      b. Pasal 18 Peraturan Kepala Kepolisian Negara Republik Indonesia Nomor 5 Tahun 2012 tentang Registrasi dan Identifikasi Kendaraan Bermotor.
    </p>

    <p><strong>2.</strong> Dalam rangka pengoperasionalkan kendaraan bermotor sebelum terbitnya faktur dan dokumen pendukung sebagai persyaratan kelengkapan pendaftaran kendaraan bermotor pada KB. Samsat maka perlu diterbitkan surat keterangan yang dipergunakan sebagai bukti sahnya pengoperasionalan kendaraan bermotor dijalan.</p>

    <p><strong>3.</strong> Surat keterangan ini menerangkan identitas pemilik dan identitas kendaraan bermotor sebagai berikut:</p>

    <div class="identitas">
      <p><strong>a. Identitas Pemilik:</strong><br>
        1) Nama : <?= esc($pengajuan['nama_pemilik']) ?><br>
        2) Alamat : <?= esc($pengajuan['alamat'] ?? '-') ?>
      </p>

      <p><strong>b. Identitas Kendaraan:</strong><br>
        1) Nomor Registrasi : <?= esc($pengajuan['nomor_registrasi']) ?><br>
        2) Merk Kendaraan : <?= esc($pengajuan['merk_kendaraan']) ?><br>
        3) Tipe Kendaraan : <?= esc($pengajuan['tipe_kendaraan']) ?><br>
        4) Jenis Kendaraan : <?= esc($pengajuan['jenis_kendaraan_detail']) ?><br>
        5) Model Kendaraan : <?= esc($pengajuan['model_kendaraan']) ?><br>
        6) Tahun Pembuatan : <?= esc($pengajuan['tahun_pembuatan']) ?><br>
        7) Isi Silinder : <?= esc($pengajuan['isi_silinder']) ?> cc<br>
        8) Nomor Rangka : <?= esc($pengajuan['nomor_rangka']) ?><br>
        9) Nomor Mesin : <?= esc($pengajuan['nomor_mesin']) ?><br>
        10) Warna Kendaraan : <?= esc($pengajuan['warna_kendaraan']) ?>
      </p>
    </div>

    <p><strong>4.</strong> Surat keterangan ini bukan sebagai pengganti STNK diberikan kepada Badan Usaha di bidang penjualan kendaraan bermotor baru milik pribadi dan tidak berlaku untuk angkutan umum/angkutan barang, dan berlaku selama 30 (tiga puluh) hari sejak tanggal _______ dan tidak dapat diperpanjang.</p>

    <p><strong>5.</strong> Demikian untuk menjadi maklum.</p>
    <div class="ttd">
      <p>Dikeluarkan di : Jakarta<br>
         Pada tanggal : <?= date('d-m-Y') ?></p>

      <p>DIREKTUR LALULINTAS POLDA METRO JAYA<br>
         KASUBDITREGIDENT<br>
         <strong>KASI STNK</strong></p>

      <br><br><br>
      <p><strong>MUH ARDILA AMRY, S.H., S.I.K., M.Si</strong><br>
         KOMISARIS POLISI NRP 86091781</p>
    </div>

    <div class="clear"></div>
  </div>

</body>
</html>

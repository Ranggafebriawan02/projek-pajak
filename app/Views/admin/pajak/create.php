<?= $this->include('admin/layout/header') ?>

<style>
  .card {
    border-radius: 8px;
  }

  .form-section-title {
    border-bottom: 2px solid #0d6efd;
    padding-bottom: 5px;
    color: #0d6efd;
    margin-bottom: 20px;
    font-weight: 600;
    font-size: 1.1rem;
  }

  .plat-group {
    display: flex;
    gap: 8px;
  }

  .plat-group .plat-awal,
  .plat-group .plat-akhir {
    max-width: 80px;
    text-transform: uppercase;
  }

  .plat-group .plat-nomor {
    max-width: 150px;
  }

  #form_cicilan {
    display: none;
  }

  #samsat_field {
    display: none;
  }
</style>

<div class="container mt-5 mb-5">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0">Form Pengajuan Pajak Kendaraan</h5>
    </div>
    <div class="card-body">
      <form action="<?= base_url('admin/pajak/simpan') ?>" method="post" enctype="multipart/form-data">
        <div class="row">
          <!-- Bagian Kiri: Data Pengajuan Pajak -->
          <div class="col-md-6 pe-md-4 border-end">
            <div class="form-section-title">Data Pengajuan Pajak</div>
            <div class="mb-3">
              <label class="form-label">Nama Pemilik</label>
              <input type="text" name="nama_pemilik" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Alamat</label>
              <textarea name="alamat" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
              <label for="no_whatsapp" class="form-label">Nomor WhatsApp</label>
              <input type="text" name="no_whatsapp" class="form-control" placeholder="08xxxxxxxxxx" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Jenis Kendaraan</label>
              <select name="jenis_kendaraan" id="jenis_kendaraan" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="motor">Motor</option>
                <option value="mobil">Mobil</option>
              </select>
            </div>
            <div class="mb-3" id="jenis_motor_mobil"></div>
            <div class="mb-3">
              <label class="form-label">Provinsi</label>
              <select name="wilayah" id="provinsi" class="form-select" required>
                <option value="">-- Pilih Provinsi --</option>
                <option value="Jakarta">Jakarta</option>
                <option value="Bandung">Bandung</option>
                <option value="Surabaya">Surabaya</option>
                <option value="Semarang">Semarang</option>
                <option value="Yogyakarta">Yogyakarta</option>
                <option value="Medan">Medan</option>
                <option value="Palembang">Palembang</option>
                <option value="Pekanbaru">Pekanbaru</option>
                <option value="Lampung">Lampung</option>
                <option value="Padang">Padang</option>
              </select>
            </div>
            <div class="mb-3" id="samsat_field">
              <label class="form-label">Pilih Samsat</label>
              <select name="samsat" id="samsat" class="form-select">
                <option value="">-- Pilih Samsat --</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Nomor Polisi</label>
              <div class="plat-group">
                <input type="text" id="plat_awal" name="plat_awal" class="form-control plat-awal" readonly>
                <input type="text" name="plat_nomor" class="form-control plat-nomor" placeholder="1234" required>
                <input type="text" name="plat_akhir" class="form-control plat-akhir" placeholder="XY" maxlength="2" required>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Jenis Pajak</label>
              <select name="jenis_pajak" class="form-select" required>
                <option value="">-- Pilih Jenis Pajak --</option>
                <option value="Tahunan">Tahunan</option>
                <option value="5 Tahunan">5 Tahunan</option>
                <option value="Balik Nama">Balik Nama</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Biaya</label>
              <input type="number" name="estimasi_biaya" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Metode Pembayaran</label>
              <select name="metode_pembayaran" id="metode_pembayaran" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="lunas">Lunas</option>
                <option value="cicilan">Cicilan</option>
              </select>
            </div>
            <div class="mb-3" id="form_cicilan">
              <label class="form-label">Upload KTP (Scan)</label>
              <input type="file" name="scan_ktp" class="form-control" accept="image/*">
            </div>
            <div class="mb-3">
              <label class="form-label">Jumlah Pembayaran (Rp)</label>
              <input type="number" name="jumlah_pembayaran" class="form-control" required>
            </div>
          </div>
          <!-- Bagian Kanan: Data Kendaraan -->
          <div class="col-md-6 ps-md-4">
            <div class="form-section-title">Data Kendaraan (Surat Pengganti STNK)</div>
            <div class="mb-3">
              <label class="form-label">Nomor Registrasi</label>
              <input type="text" name="nomor_registrasi" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Merk Kendaraan</label>
              <input type="text" name="merk_kendaraan" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Tipe Kendaraan</label>
              <input type="text" name="tipe_kendaraan" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Jenis</label>
              <input type="text" name="jenis_kendaraan_detail" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Model</label>
              <input type="text" name="model_kendaraan" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Tahun Pembuatan</label>
              <input type="text" name="tahun_pembuatan" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Isi Silinder (cc)</label>
              <input type="number" name="isi_silinder" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Nomor Rangka</label>
              <input type="text" name="nomor_rangka" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Nomor Mesin</label>
              <input type="text" name="nomor_mesin" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Warna Kendaraan</label>
              <input type="text" name="warna_kendaraan" class="form-control" required>
            </div>
          </div>
        </div>
        <input type="hidden" name="status" value="Proses">
        <div class="mt-4">
          <button type="submit" style="float: right;" class="btn btn-success w-100 ">Simpan Pengajuan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  document.getElementById('jenis_kendaraan').addEventListener('change', function() {
    const jenisDiv = document.getElementById('jenis_motor_mobil');
    let html = '';
    if (this.value === 'motor') {
      html = `<label class="form-label">Kategori Motor</label><select name="kategori_kendaraan" class="form-select" required><option value="matic">Matic</option><option value="bebek">Bebek</option><option value="sport">Sport</option></select>`;
    } else if (this.value === 'mobil') {
      html = `<label class="form-label">Kategori Mobil</label><select name="kategori_kendaraan" class="form-select" required><option value="sedan">Sedan</option><option value="suv">SUV</option><option value="pickup">Pick-up</option></select>`;
    }
    jenisDiv.innerHTML = html;
  });

  const kodePlatWilayah = {
    "Jakarta": "B",
    "Bandung": "D",
    "Surabaya": "L",
    "Semarang": "H",
    "Yogyakarta": "AB",
    "Medan": "BK",
    "Palembang": "BG",
    "Pekanbaru": "BM",
    "Lampung": "BE",
    "Padang": "BA"
  };

  document.getElementById('provinsi').addEventListener('change', function() {
    const samsatField = document.getElementById('samsat_field');
    const samsatSelect = document.getElementById('samsat');
    const wilayah = this.value;
    document.getElementById('plat_awal').value = kodePlatWilayah[wilayah] || '';
    const samsatList = {
      "Jakarta": [" Jakarta Pusat", " Jakarta Barat", " Jakarta Selatan", " Jakarta Timur", " Jakarta Utara"],
      "Bandung": [" Bandung Kota", " Bandung Barat", " Ujungberung"],
      "Surabaya": [" Surabaya Selatan", " Surabaya Barat", " Surabaya Timur"],
      "Semarang": [" Semarang Barat", " Semarang Tengah", " Semarang Timur"],
      "Yogyakarta": [" Kota Yogyakarta", " Sleman", " Bantul"],
      "Medan": [" Medan Kota", " Medan Timur", " Medan Utara"],
      "Palembang": [" Kantor Bersama Samsat Palembang I", "  Kantor Bersama Samsat Palembang II", "  Kantor Bersama Samsat Palembang III", " Kantor Bersama Samsat Palembang IV", "Samsat Corner Palembang Indah Mall", "Kantor Bersama Pelayanan Samsat Palembang IV"],
      "Pekanbaru": [" Pekanbaru Kota", " Tampan", " Tenayan Raya"],
      "Lampung": [" Bandar Lampung", " Metro", " Kotabumi", " Kalianda",
        " Way Kanan", " Kotabumi", " Menggala", " Sukadana", " Liwa", " Tanggamus", " Mesuji"
      ],
      "Padang": [" Padang Barat", " Padang Timur", " Bukittinggi"]
    };

    if (samsatList[wilayah]) {
      samsatField.style.display = 'block';
      samsatSelect.innerHTML = '<option value="">-- Pilih Samsat --</option>';
      samsatList[wilayah].forEach(function(item) {
        samsatSelect.innerHTML += `<option value="${item}">${item}</option>`;
      });
    } else {
      samsatField.style.display = 'none';
      samsatSelect.innerHTML = '';
    }
  });

  document.getElementById('metode_pembayaran').addEventListener('change', function() {
    const cicilanForm = document.getElementById('form_cicilan');
    if (this.value === 'cicilan') {
      cicilanForm.style.display = 'block';
    } else {
      cicilanForm.style.display = 'none';
    }
  });
</script>
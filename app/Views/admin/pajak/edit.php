<?= $this->include('admin/layout/header'); ?>

<style>
  .card { border-radius: 8px; }
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
  #form_cicilan { display: none; }
  #samsat_field { display: none; }
</style>

<div class="container mt-5 mb-5">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0">Edit Pengajuan Pajak Kendaraan</h5>
    </div>
    <div class="card-body">
      <form action="<?= base_url('admin/pajak/update/' . $pengajuan['id']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="row">
          <!-- Kolom Kiri -->
          <div class="col-md-6 pe-md-4 border-end">
            <div class="form-section-title">Data Pengajuan Pajak</div>
            <div class="mb-3">
              <label class="form-label">Nama Pemilik</label>
              <input type="text" name="nama_pemilik" class="form-control" value="<?= esc($pengajuan['nama_pemilik']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Alamat Pemilik</label>
              <textarea name="alamat" class="form-control" rows="3" required><?= esc($pengajuan['alamat']) ?></textarea>
            </div>
            <div class="mb-3">
              <label for="no_whatsapp">Nomor WhatsApp</label>
              <input type="text" name="no_whatsapp" class="form-control" value="<?= esc($pengajuan['no_whatsapp']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Jenis Kendaraan</label>
              <select name="jenis_kendaraan" id="jenis_kendaraan" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="motor" <?= $pengajuan['jenis_kendaraan'] == 'motor' ? 'selected' : '' ?>>Motor</option>
                <option value="mobil" <?= $pengajuan['jenis_kendaraan'] == 'mobil' ? 'selected' : '' ?>>Mobil</option>
              </select>
            </div>
            <div class="mb-3" id="jenis_motor_mobil"></div>
            <div class="mb-3">
              <label class="form-label">Provinsi</label>
              <select name="wilayah" id="provinsi" class="form-select" required>
                <option value="">-- Pilih Provinsi --</option>
                <?php
                $provinsiList = ['Jakarta', 'Bandung', 'Surabaya', 'Semarang', 'Yogyakarta', 'Medan', 'Palembang', 'Pekanbaru', 'Lampung', 'Padang'];
                foreach ($provinsiList as $prov) {
                  $sel = ($pengajuan['wilayah'] == $prov) ? 'selected' : '';
                  echo "<option value='$prov' $sel>$prov</option>";
                }
                ?>
              </select>
            </div>
            <div class="mb-3" id="samsat_field">
              <label class="form-label">Pilih Samsat</label>
              <select name="samsat" id="samsat" class="form-select">
                <option value="<?= esc($pengajuan['samsat']) ?>"><?= esc($pengajuan['samsat']) ?></option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Nomor Polisi</label>
              <div class="plat-group">
                <input type="text" id="plat_awal" name="plat_awal" class="form-control plat-awal" value="<?= esc($pengajuan['plat_awal']) ?>" readonly>
                <input type="text" name="plat_nomor" class="form-control plat-nomor" value="<?= esc($pengajuan['plat_nomor']) ?>" required>
                <input type="text" name="plat_akhir" class="form-control plat-akhir" value="<?= esc($pengajuan['plat_akhir']) ?>" maxlength="2" required>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Jenis Pajak</label>
              <select name="jenis_pajak" class="form-select" required>
                <option value="">-- Pilih Jenis Pajak --</option>
                <option value="Tahunan" <?= $pengajuan['jenis_pajak'] == 'Tahunan' ? 'selected' : '' ?>>Tahunan</option>
                <option value="5 Tahunan" <?= $pengajuan['jenis_pajak'] == '5 Tahunan' ? 'selected' : '' ?>>5 Tahunan</option>
                <option value="Balik Nama" <?= $pengajuan['jenis_pajak'] == 'Balik Nama' ? 'selected' : '' ?>>Balik Nama</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Estimasi Biaya (Rp)</label>
              <input type="number" name="estimasi_biaya" class="form-control" value="<?= esc($pengajuan['estimasi_biaya']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Metode Pembayaran</label>
              <select name="metode_pembayaran" id="metode_pembayaran" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="lunas" <?= $pengajuan['metode_pembayaran'] == 'lunas' ? 'selected' : '' ?>>Lunas</option>
                <option value="cicilan" <?= $pengajuan['metode_pembayaran'] == 'cicilan' ? 'selected' : '' ?>>Cicilan</option>
              </select>
            </div>
            <div class="mb-3" id="form_cicilan" style="<?= $pengajuan['metode_pembayaran'] == 'cicilan' ? 'display:block' : 'display:none' ?>">
              <label class="form-label">Foto KTP (Scan)</label>
              <?php if (!empty($pengajuan['scan_ktp'])): ?>
                <div class="mb-2">
                  <img src="<?= base_url('uploads/ktp/' . $pengajuan['scan_ktp']) ?>" alt="KTP" class="img-thumbnail" style="max-height: 150px;">
                </div>
                <small class="text-muted d-block">Foto KTP yang tersimpan di sistem. Jika tidak ingin mengganti, biarkan kosong.</small>
              <?php endif; ?>
              <input type="file" name="scan_ktp" class="form-control" accept="image/*">
            </div>
            <div class="mb-3">
              <label class="form-label">Jumlah Pembayaran (Rp)</label>
              <input type="number" name="jumlah_pembayaran" class="form-control" value="<?= esc($pengajuan['jumlah_pembayaran']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Status</label>
              <select name="status" class="form-select" required>
                <option value="Proses" <?= $pengajuan['status'] == 'Proses' ? 'selected' : '' ?>>Proses</option>
                <option value="Selesai" <?= $pengajuan['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
              </select>
            </div>
           
          </div>
          <!-- Kolom Kanan -->
          <div class="col-md-6 ps-md-4">
            <div class="form-section-title">Data Kendaraan (Surat Pengganti STNK)</div>
            <div class="mb-3">
              <label class="form-label">Nomor Registrasi</label>
              <input type="text" name="nomor_registrasi" class="form-control" value="<?= esc($pengajuan['nomor_registrasi']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Merk Kendaraan</label>
              <input type="text" name="merk_kendaraan" class="form-control" value="<?= esc($pengajuan['merk_kendaraan']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Tipe Kendaraan</label>
              <input type="text" name="tipe_kendaraan" class="form-control" value="<?= esc($pengajuan['tipe_kendaraan']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Jenis</label>
              <input type="text" name="jenis_kendaraan_detail" class="form-control" value="<?= esc($pengajuan['jenis_kendaraan_detail']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Model</label>
              <input type="text" name="model_kendaraan" class="form-control" value="<?= esc($pengajuan['model_kendaraan']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Tahun Pembuatan</label>
              <input type="text" name="tahun_pembuatan" class="form-control" value="<?= esc($pengajuan['tahun_pembuatan']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Isi Silinder (cc)</label>
              <input type="number" name="isi_silinder" class="form-control" value="<?= esc($pengajuan['isi_silinder']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Nomor Rangka</label>
              <input type="text" name="nomor_rangka" class="form-control" value="<?= esc($pengajuan['nomor_rangka']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Nomor Mesin</label>
              <input type="text" name="nomor_mesin" class="form-control" value="<?= esc($pengajuan['nomor_mesin']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Warna Kendaraan</label>
              <input type="text" name="warna_kendaraan" class="form-control" value="<?= esc($pengajuan['warna_kendaraan']) ?>" required>
            </div>
             <div class="mb-3">
              <label class="form-label">Tugaskan ke Petugas</label>
              <select name="petugas_id" class="form-select">
                <option value="">-- Pilih Petugas --</option>
                <?php foreach ($petugasList as $p): ?>
                  <option value="<?= $p['id'] ?>" <?= $pengajuan['id_petugas'] == $p['id'] ? 'selected' : '' ?>>
                    <?= esc($p['nama']) ?> (<?= esc($p['wilayah']) ?>)
                  </option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          
        </div>
        
        <div class="mt-4">
          <button type="submit" class="btn btn-success w-100">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Render kategori sesuai jenis kendaraan
  const jenisDiv = document.getElementById('jenis_motor_mobil');
  const pengajuanKategori = '<?= esc($pengajuan['kategori_kendaraan'] ?? '') ?>';
  const jenisKendaraan = document.getElementById('jenis_kendaraan').value;

  function renderJenisKategori(jenis) {
    let html = '';
    if (jenis === 'motor') {
      html = `<label class="form-label">Kategori Motor</label>
        <select name="kategori_kendaraan" class="form-select" required>
          <option value="matic" ${pengajuanKategori === 'matic' ? 'selected' : ''}>Matic</option>
          <option value="bebek" ${pengajuanKategori === 'bebek' ? 'selected' : ''}>Bebek</option>
          <option value="sport" ${pengajuanKategori === 'sport' ? 'selected' : ''}>Sport</option>
        </select>`;
    } else if (jenis === 'mobil') {
      html = `<label class="form-label">Kategori Mobil</label>
        <select name="kategori_kendaraan" class="form-select" required>
          <option value="sedan" ${pengajuanKategori === 'sedan' ? 'selected' : ''}>Sedan</option>
          <option value="suv" ${pengajuanKategori === 'suv' ? 'selected' : ''}>SUV</option>
          <option value="pickup" ${pengajuanKategori === 'pickup' ? 'selected' : ''}>Pick-up</option>
        </select>`;
    }
    jenisDiv.innerHTML = html;
  }

  document.getElementById('jenis_kendaraan').addEventListener('change', function() {
    renderJenisKategori(this.value);
  });

  renderJenisKategori(jenisKendaraan);

  // Toggle form cicilan
  document.getElementById('metode_pembayaran').addEventListener('change', function() {
    const cicilanForm = document.getElementById('form_cicilan');
    cicilanForm.style.display = (this.value === 'cicilan') ? 'block' : 'none';
  });
</script>

<?
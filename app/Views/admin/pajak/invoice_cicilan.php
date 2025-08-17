<?= $this->include('admin/layout/header') ?>
<div class="container mt-4">
    <h3>Invoice Pembayaran Cicilan</h3>
    <p><strong>Nama Pemilik:</strong> <?= esc($data['nama_pemilik']) ?></p>
    <p><strong>Jenis Kendaraan:</strong> <?= esc($data['jenis_kendaraan']) ?></p>
    <p><strong>Metode Pembayaran:</strong> <?= esc($data['metode_pembayaran']) ?></p>
    <!-- Tambahkan detail lain sesuai kebutuhan -->
</div>
<?= $this->include('admin/layout/footer') ?>

<?= $this->include('admin/layout/header') ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Data Cicilan Pajak</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Pemohon</th>
                    <th>Total Cicilan</th>
                    <th>Jumlah Bayar</th>
                    <th>Sisa Cicilan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($list)): ?>
                    <?php $no = 1;
                    foreach ($list as $item): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($item['nama_pemilik']) ?></td>
                            <td>Rp <?= number_format($item['estimasi_biaya'], 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($item['jumlah_pembayaran'], 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($item['estimasi_biaya'] - $item['jumlah_pembayaran'], 0, ',', '.') ?></td>
                            <td><?= esc($item['status']) ?></td>
                            <td>
                                <a href="https://wa.me/62<?= substr($item['no_whatsapp'], 1) ?>?text=<?= urlencode('Proses perpanjangan pajak anda sudah selesai dan bisa diambil di kantor. Untuk pengambilan dokumen diharapkan saudara segera melunasi kekurangannya di kantor. Terima kasih.') ?>"
                                    class="btn btn-success btn-sm" target="_blank">
                                    Hubungi
                                </a>

                                <?php if ($item['sudah_dihubungi']): ?>
                                    <span class="badge bg-success ms-2">✅ Sudah Dihubungi</span>
                                <?php else: ?>
                                    <form action="<?= base_url('admin/cicilan/ditandai_dihubungi/' . $item['id']) ?>" method="post" style="display:inline;">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-outline-success btn-sm">Tandai Sudah Dihubungi</button>
                                    </form>

                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data cicilan.</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->include('admin/layout/footer') ?>
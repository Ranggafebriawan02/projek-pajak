<?= $this->include('admin/layout/header') ?>

<style>
    /* Badge Status Modern */
    .status-badge {
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    }
    .status-lunas {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        color: #155724;
    }
    .status-belum {
        background: linear-gradient(135deg, #fff3cd, #ffeeba);
        color: #856404;
    }
    .status-menunggak {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        color: #721c24;
    }

    /* Tabel lebih elegan */
    .table-custom {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .table-custom thead {
        background: #f8f9fa;
    }
    .table-custom tbody tr:hover {
        background: #f1f3f5;
    }
</style>

<div class="container mt-5">
    <h2 class="text-center mb-4 text-primary fw-bold">Data Cicilan Pajak</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle table-custom">
            <thead class="table-light text-center">
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
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= esc($item['nama_pemilik']) ?></td>
                            <td>Rp <?= number_format($item['estimasi_biaya'], 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($item['jumlah_pembayaran'], 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($item['estimasi_biaya'] - $item['jumlah_pembayaran'], 0, ',', '.') ?></td>
                            <td class="text-center">
                                <?php 
                                $status = strtolower($item['status']);
                                if ($status == 'lunas') {
                                    echo '<span class="status-badge status-lunas"><i class="bi bi-check-circle-fill"></i> Lunas</span>';
                                } elseif ($status == 'belum lunas') {
                                    echo '<span class="status-badge status-belum"><i class="bi bi-hourglass-split"></i> Belum Lunas</span>';
                                } elseif ($status == 'menunggak') {
                                    echo '<span class="status-badge status-menunggak"><i class="bi bi-x-circle-fill"></i> Menunggak</span>';
                                } else {
                                    echo esc($item['status']);
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <a href="https://wa.me/62<?= substr($item['no_whatsapp'], 1) ?>?text=<?= urlencode('Proses perpanjangan pajak anda sudah selesai dan bisa diambil di kantor. Untuk pengambilan dokumen diharapkan saudara segera melunasi kekurangannya di kantor. Terima kasih.') ?>"
                                    class="btn btn-outline-success btn-sm" target="_blank">
                                    <i class="bi bi-whatsapp"></i> Hubungi
                                </a>

                                <?php if ($item['sudah_dihubungi']): ?>
                                    <span class="badge bg-success ms-2">✅ Sudah Dihubungi</span>
                                <?php else: ?>
                                    <form action="<?= base_url('admin/cicilan/ditandai_dihubungi/' . $item['id']) ?>" method="post" style="display:inline;">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-check2-circle"></i> Tandai
                                        </button>
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

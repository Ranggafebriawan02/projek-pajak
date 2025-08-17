<?= $this->include('admin/layout/header'); ?>

<style>
    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    .status-diproses {
        background-color: #ffc107;
        color: #fff;
    }
    .status-pengantaran {
        background-color: #17a2b8;
        color: #fff;
    }
    .status-selesai {
        background-color: #28a745;
        color: #fff;
    }
    .card-track {
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        padding: 25px;
        margin-bottom: 25px;
    }
    .label {
        font-weight: bold;
        color: #555;
    }
    .value {
        color: #212529;
    }
</style>

<div class="container my-5">
    <h2 class="text-center mb-4">🔎 Tracking Proses Pajak Kendaraan</h2>

    <!-- Form Pencarian -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <form method="get" action="<?= base_url('admin/tracking') ?>" class="row g-3">
                <div class="col-md-9">
                    <input type="text" name="plat" class="form-control" placeholder="Masukkan Plat Nomor (Contoh: B 1234 ABC)" required>
                </div>
                <div class="col-md-3 d-grid">
                    <button type="submit" class="btn btn-dark">Cari & Lacak</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Hasil Tracking -->
    <?php if (isset($data)): ?>
        <div class="card-track bg-white">
            <h5 class="mb-4 text-primary">📄 Detail Informasi Pajak</h5>
            <div class="row mb-2">
                <div class="col-md-4"><span class="label">Nama Pemilik:</span></div>
                <div class="col-md-8"><span class="value"><?= esc($data['nama_pemilik']) ?></span></div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4"><span class="label">Jenis Kendaraan:</span></div>
                <div class="col-md-8"><span class="value"><?= esc($data['jenis_kendaraan']) ?></span></div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4"><span class="label">Jenis Pajak:</span></div>
                <div class="col-md-8"><span class="value"><?= esc($data['jenis_pajak']) ?></span></div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4"><span class="label">Wilayah Samsat:</span></div>
                <div class="col-md-8"><span class="value"><?= esc($data['wilayah']) ?></span></div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4"><span class="label">Status:</span></div>
                <div class="col-md-8">
                    <?php
                        $status = strtolower($data['status_tracking']);
                        $badgeClass = match($status) {
                            'diproses' => 'status-diproses',
                            'pengantaran ke samsat' => 'status-pengantaran',
                            'selesai - dokumen siap diambil' => 'status-selesai',
                            default => 'bg-secondary'
                        };
                    ?>
                    <span class="status-badge <?= $badgeClass ?>"><?= esc($data['status_tracking']) ?></span>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4"><span class="label">Lokasi Terakhir:</span></div>
                <div class="col-md-8"><span class="value"><?= esc($data['lokasi_terakhir'] ?? '-') ?></span></div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4"><span class="label">Update Terakhir:</span></div>
                <div class="col-md-8"><span class="value"><?= date('d M Y H:i', strtotime($data['updated_at'])) ?></span></div>
            </div>
        </div>
    <?php elseif (isset($not_found)): ?>
        <div class="alert alert-warning text-center mt-4">🚫 Data tidak ditemukan untuk plat tersebut.</div>
    <?php endif; ?>
</div>

<?= $this->include('admin/layout/footer'); ?>

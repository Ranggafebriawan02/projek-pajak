<?= $this->include('admin/layout/header') ?>

<style>
    /* Tombol aksi */
    .aksi-btn-group {
        display: flex;
        justify-content: center;
        gap: 6px;
        flex-wrap: nowrap;
    }
    .aksi-btn-group .btn {
        min-width: 70px;
        font-weight: 500;
        border-radius: 6px;
    }

    /* Floating alert */
    .floating-alert {
        position: fixed;
        top: 30px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 9999;
        min-width: 300px;
        max-width: 90vw;
        padding: 14px 20px;
        border-radius: 10px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        font-size: 0.95rem;
        font-weight: 500;
        text-align: center;
        opacity: 1;
        transition: opacity 0.5s;
    }

    /* Badge status dengan warna soft */
    .status-badge {
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }
    .status-diproses { background: #ffeeba; color: #856404; }
    .status-selesai  { background: #c3e6cb; color: #155724; }
    .status-ditolak  { background: #f5c6cb; color: #721c24; }

    /* Highlight pencarian */
    .highlight {
        background-color: #0d6efd;
        color: #fff;
        padding: 0 2px;
        border-radius: 3px;
    }

    /* Tabel lebih elegan */
    table.table {
        border-radius: 8px;
        overflow: hidden;
    }
    table.table thead {
        background: #f8f9fa;
        color: #495057;
        font-size: 0.95rem;
    }
    table.table tbody tr:hover {
        background: #f1f3f5;
    }
</style>

<?php if (session()->getFlashdata('success')): ?>
    <div id="floatingAlert" class="alert alert-success floating-alert">
        <?= session()->getFlashdata('success') ?>
    </div>
    <script>
        setTimeout(function() {
            var alert = document.getElementById('floatingAlert');
            if(alert) {
                alert.style.opacity = '0';
                setTimeout(function(){ alert.remove(); }, 500);
            }
        }, 3000);
    </script>
<?php endif; ?>

<div class="container mt-4">
    <h2 class="text-center mb-4 text-primary fw-bold">Daftar Pengajuan Pajak Kendaraan</h2>
    <a href="<?= base_url('admin/pajak/create') ?>" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i> Tambah Pengajuan
    </a>

    <!-- Filter -->
    <form method="get" class="row g-2 mb-3">
        <div class="col-md-3">
            <input type="date" name="tanggal_mulai" class="form-control" 
                   value="<?= esc($_GET['tanggal_mulai'] ?? '') ?>">
        </div>
        <div class="col-md-3">
            <input type="date" name="tanggal_selesai" class="form-control" 
                   value="<?= esc($_GET['tanggal_selesai'] ?? '') ?>">
        </div>
        <div class="col-md-3">
            <select name="wilayah" class="form-select">
                <option value="">-- Semua Wilayah --</option>
                <option value="Lampung">Lampung</option>
                <option value="Jakarta">Jakarta</option>
                <option value="Bandung">Bandung</option>
            </select>
        </div>
        <div class="col-md-3 d-grid">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-funnel"></i> Tampilkan
            </button>
        </div>
    </form>

    <!-- Pencarian Cepat -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" 
               placeholder="Cari nama pemilik atau plat kendaraan...">
    </div>

    <!-- Tabel -->
    <div class="table-responsive">
        <table id="pengajuanTable" class="table table-bordered align-middle">
            <thead class="text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Pemilik</th>
                    <th>Kendaraan</th>
                    <th>Plat</th>
                    <th>Jenis Pajak</th>
                    <th>Provinsi</th>
                    <th>Metode Pembayaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                    <th>Petugas</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($pengajuan as $item): ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= esc($item['nama_pemilik']) ?></td>
                    <td><?= esc($item['jenis_kendaraan']) ?></td>
                    <td><?= esc($item['plat_awal'].' '.$item['plat_nomor'].' '.$item['plat_akhir']) ?></td>
                    <td><?= esc($item['jenis_pajak']) ?></td>
                    <td><?= esc($item['wilayah']) ?></td>
                    <td><?= esc(ucfirst($item['metode_pembayaran'])) ?></td>
                    <td class="text-center">
                        <?php 
                        $status = strtolower($item['status_tracking']);
                        if ($status == 'diproses') {
                            echo '<span class="status-badge status-diproses">Diproses</span>';
                        } elseif ($status == 'selesai') {
                            echo '<span class="status-badge status-selesai">Selesai</span>';
                        } elseif ($status == 'ditolak') {
                            echo '<span class="status-badge status-ditolak">Ditolak</span>';
                        } else {
                            echo esc($item['status_tracking']);
                        }
                        ?>
                    </td>
                    <td>
                        <div class="aksi-btn-group">
                            <a href="<?= base_url('admin/pajak/edit/'.$item['id']) ?>" 
                               class="btn btn-sm btn-outline-primary">Lihat</a>
                            <a href="<?= base_url('admin/pajak/delete/'.$item['id']) ?>" 
                               class="btn btn-sm btn-outline-danger"
                               onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                            <a href="<?= base_url('admin/pajak/surat_keterangan/'.$item['id']) ?>" 
                               target="_blank" class="btn btn-sm btn-outline-success">Cetak</a>
                        </div>
                    </td>
                    <td><?= esc($item['nama'] ?? '-') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Script pencarian cepat -->
<script>
document.getElementById("searchInput").addEventListener("keyup", function() {
    var value = this.value.toLowerCase();
    var rows = document.querySelectorAll("#pengajuanTable tbody tr");

    rows.forEach(function(row) {
        var text = row.textContent.toLowerCase();
        if (text.indexOf(value) > -1) {
            row.style.display = "";
            row.querySelectorAll("td").forEach(function(cell) {
                cell.innerHTML = cell.textContent;
            });
            if (value) {
                let cell = row.cells[1];
                let regex = new RegExp("(" + value + ")", "gi");
                cell.innerHTML = cell.textContent.replace(regex, "<span class='highlight'>$1</span>");
            }
        } else {
            row.style.display = "none";
        }
    });
});
</script>

<?= $this->include('admin/layout/footer') ?>

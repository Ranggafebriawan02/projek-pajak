<div class="container mt-4">
    <h3>Update Status Pengajuan</h3>
    <form action="<?= base_url('petugas/tracking/update/'.$pengajuan['id']) ?>" method="post">
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Diproses" <?= $pengajuan['status']=='Diproses'?'selected':'' ?>>Diproses</option>
                <option value="Pengantaran ke Samsat" <?= $pengajuan['status']=='Pengantaran ke Samsat'?'selected':'' ?>>Pengantaran ke Samsat</option>
                <option value="Selesai" <?= $pengajuan['status']=='Selesai'?'selected':'' ?>>Selesai - Dokumen Siap Diambil</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= base_url('petugas/tracking') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

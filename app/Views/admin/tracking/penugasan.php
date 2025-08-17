<?= $this->include('admin/layout/header') ?>

<div class="container mt-4">
    <h3>Penugasan Petugas Pengantar</h3>

    <form action="<?= base_url('admin/tracking/simpanPenugasan/' . $tracking['id']) ?>" method="post">
        <div class="form-group">
            <label for="petugas_pengantar_id">Pilih Petugas</label>
            <select name="petugas_pengantar_id" class="form-control" required>
                <option value="">-- Pilih Petugas --</option>
                <?php foreach ($petugas as $p): ?>
                    <option value="<?= $p['id'] ?>" <?= ($tracking['petugas_pengantar_id'] == $p['id']) ? 'selected' : '' ?>>
                        <?= $p['nama'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Simpan Penugasan</button>
        <a href="<?= base_url('admin/tracking') ?>" class="btn btn-secondary mt-2">Batal</a>
    </form>
</div>

<?= $this->include('admin/layout/footer') ?>

<div class="container mt-4">
    <h3>Daftar Pengajuan Ditugaskan</h3>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemohon</th>
                <th>Wilayah</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($pengajuan as $p): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $p['nama'] ?></td>
                <td><?= $p['wilayah'] ?></td>
                <td>
                    <span class="badge 
                        <?= $p['status']=='Selesai'?'bg-success':($p['status']=='Diproses'?'bg-warning':'bg-info') ?>">
                        <?= $p['status'] ?>
                    </span>
                </td>
                <td>
                    <a href="<?= base_url('petugas/tracking/edit/'.$p['id']) ?>" class="btn btn-sm btn-primary">Update</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

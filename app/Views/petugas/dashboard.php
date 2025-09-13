<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

<style>
  body {
    background: #f9fafb;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
  .stat-card {
    border-radius: 0.75rem;
    padding: 1rem;
    background: #fff;
    text-align: center;
  }
  .stat-card .number {
    font-size: 1.4rem;
    font-weight: 700;
  }
  .stat-card small {
    color: #6c757d;
  }
  .card {
    border-radius: 0.75rem;
  }
  .card-header {
    font-weight: 600;
    background: #fff !important;
    border-bottom: 1px solid #f1f1f1;
  }
  table {
    font-size: 0.9rem;
  }
  .badge-status {
    font-size: 0.75rem;
    border-radius: 0.5rem;
    padding: 0.35em 0.6em;
  }
</style>

<div class="container my-4">
  <h4 class="fw-bold mb-3">Dashboard Petugas</h4>

  <!-- filter -->
  <form class="d-flex align-items-center gap-2 filter-form" style="float :right" method="get" action="<?= base_url('petugas') ?>">
  <input 
      type="date" 
      class="form-control form-control-sm" 
      name="tanggal" 
      value="<?= esc($tanggal ?? '') ?>" 
      style="max-width: 180px;"
  />
  <select 
      class="form-select form-select-sm" 
      name="filter" 
      style="max-width: 150px;"
  >
    <option value="hari" <?= ($filter ?? '') == 'hari' ? 'selected' : '' ?>>Hari Ini</option>
    <option value="minggu" <?= ($filter ?? '') == 'minggu' ? 'selected' : '' ?>>Minggu Ini</option>
    <option value="bulan" <?= ($filter ?? '') == 'bulan' ? 'selected' : '' ?>>Bulan Ini</option>
  </select>
  <button class="btn btn-primary btn-sm px-3" type="submit">
    Filter
  </button>
</form>


  <!-- Statistik Ringkas -->
  <div class="row g-3 mb-3">
    <div class="col-6 col-md-3">
      <div class="stat-card shadow-sm">
        <div class="number text-primary"><?= $totalPengajuan ?></div>
        <small>Total Pengajuan</small>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="stat-card shadow-sm">
        <div class="number text-warning"><?= $diproses ?></div>
        <small>Diproses</small>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="stat-card shadow-sm">
        <div class="number text-success"><?= $selesai ?></div>
        <small>Selesai</small>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="stat-card shadow-sm">
        <div class="number text-info"><?= $wilayah ?></div>
        <small>Wilayah</small>
      </div>
    </div>
  </div>

  <!-- Chart + Table -->
  <div class="row g-3">
    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header">Distribusi Tugas</div>
        <div class="card-body">
          <canvas id="pieChart"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header">Daftar Pengajuan Terbaru</div>
        <div class="card-body table-responsive">
          <table class="table table-sm table-hover mb-0">
            <thead class="table-light">
              <tr>
                <th>No</th>
                <th>Pemohon</th>
                <th>Wilayah</th>
                <th>Status</th>
                <th>Tanggal</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($pengajuan)): ?>
                <?php foreach ($pengajuan as $i => $p): ?>
                  <tr>
                    <td><?= $i+1 ?></td>
                    <td><?= esc($p['nama_pemohon']) ?></td>
                    <td><?= esc($p['wilayah']) ?></td>
                    <td>
                      <?php
                        $status = $p['status'];
                        $badgeClass = 'bg-secondary';
                        if ($status === 'Diproses') $badgeClass = 'bg-warning text-dark';
                        else if ($status === 'Selesai') $badgeClass = 'bg-success';
                      ?>
                      <span class="badge badge-status <?= $badgeClass ?>"><?= esc($status) ?></span>
                    </td>
                    <td><?= date('d M Y', strtotime($p['created_at'])) ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr><td colspan="5" class="text-center text-muted">Belum ada data</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap & Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  new Chart(document.getElementById('pieChart'), {
    type: 'pie',
    data: {
      labels: ['Diproses', 'Selesai', 'Lainnya'],
      datasets: [{
        data: [<?= $diproses ?>, <?= $selesai ?>, <?= $totalPengajuan - $diproses - $selesai ?>],
        backgroundColor: ['#ffc107','#198754','#6c757d']
      }]
    },
    options: { plugins: { legend: { position: 'bottom' } } }
  });
</script>

<?= $this->include('admin/layout/header') ?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Dashboard Admin Pajak Kendaraan</h2>
    <p class="text-center">Selamat datang di sistem manajemen biro jasa pajak kendaraan bermotor.</p>

    <div class="row text-center mb-5">
        <div class="col-md-3">
            <div class="border rounded p-3 bg-light">
                <h4><?= $total_pengajuan ?></h4>
                <p>Total Pengajuan</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="border rounded p-3 bg-light">
                <h4><?= $total_cicilan ?></h4>
                <p>Pembayaran Cicilan</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="border rounded p-3 bg-light">
                <h4><?= $total_selesai ?></h4>
                <p>Pengajuan Selesai</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="border rounded p-3 bg-light">
                <h4><?= $total_wilayah ?></h4>
                <p>Wilayah Terdaftar</p>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Grafik Status Pajak -->
        <div class="col-md-6 mb-4">
            <h5 class="text-center">Grafik Status Pengajuan</h5>
            <canvas id="statusChart"></canvas>
        </div>

        <!-- Ringkasan Wilayah -->
        <div class="col-md-6 mb-4">
            <h5 class="text-center">Pengajuan per Wilayah</h5>
            <canvas id="wilayahChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Grafik Status Pengajuan
    const statusChart = new Chart(document.getElementById('statusChart'), {
        type: 'bar',
        data: {
            labels: ['Diproses', 'Pengantaran', 'Selesai'],
            datasets: [{
                label: 'Jumlah Pengajuan',
                data: [<?= $count_diproses ?>, <?= $count_pengantaran ?>, <?= $count_selesai ?>],
                backgroundColor: ['#ffc107', '#17a2b8', '#28a745']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Grafik Wilayah Terbanyak
    const wilayahChart = new Chart(document.getElementById('wilayahChart'), {
        type: 'pie',
        data: {
            labels: <?= json_encode(array_keys($wilayah_summary)) ?>,
            datasets: [{
                data: <?= json_encode(array_values($wilayah_summary)) ?>,
                backgroundColor: ['#007bff', '#6610f2', '#e83e8c', '#fd7e14', '#20c997']
            }]
        },
        options: {
            responsive: true
        }
    });
</script>

<?= $this->include('admin/layout/footer') ?>

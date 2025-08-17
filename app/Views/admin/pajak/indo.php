<?= $this->include('admin/layout/header') ?>

<style>
    .card {
        border-radius: 8px;
    }
    
    .form-section-title {
        border-bottom: 2px solid #0d6efd;
        padding-bottom: 5px;
        color: #0d6efd;
        margin-bottom: 20px;
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .info-box {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .info-item {
        margin-bottom: 10px;
    }
    
    .info-label {
        font-weight: bold;
        color: #495057;
    }
    
    .tax-calculation {
        background-color: #e7f3ff;
        border-left: 4px solid #0d6efd;
        padding: 15px;
        margin: 15px 0;
    }
    
    .total-section {
        background-color: #d1ecf1;
        border: 1px solid #bee5eb;
        border-radius: 8px;
        padding: 15px;
        margin-top: 20px;
    }
    
    .total-amount {
        font-size: 1.5rem;
        font-weight: bold;
        color: #0c5460;
    }
</style>

<div class="container mt-5 mb-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Pajak Kendaraan Indonesia</h5>
        </div>
        <div class="card-body">
            
            <!-- Informasi Umum -->
            <div class="form-section-title">Informasi Umum Pajak Kendaraan</div>
            
            <div class="info-box">
                <h6>Peraturan Pajak Kendaraan di Indonesia</h6>
                <p>Pajak kendaraan di Indonesia diatur oleh beberapa peraturan:</p>
                <ul>
                    <li><strong>PP No. 65 Tahun 2015</strong> tentang Jenis dan Tarif atas Jenis Penerimaan Negara Bukan Pajak</li>
                    <li><strong>PP No. 73 Tahun 2019</strong> tentang Jenis dan Tarif atas Jenis Penerimaan Negara Bukan Pajak</li>
                    <li><strong>Peraturan Menteri Keuangan</strong> terkait implementasi pajak kendaraan</li>
                </ul>
            </div>

            <!-- Jenis-Jenis Pajak -->
            <div class="form-section-title">Jenis-Jenis Pajak Kendaraan</div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="info-box">
                        <h6>Pajak Kendaraan Bermotor (PKB)</h6>
                        <p>Pajak tahunan yang dikenakan atas kepemilikan kendaraan bermotor.</p>
                        <div class="info-item">
                            <span class="info-label">Dasar Pengenaan:</span> Nilai Jual Kendaraan Bermotor (NJKB)
                        </div>
                        <div class="info-item">
                            <span class="info-label">Tarif:</span> 1.5% - 2% dari NJKB
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="info-box">
                        <h6>Bea Balik Nama Kendaraan Bermotor (BBNKB)</h6>
                        <p>Pajak yang dikenakan atas perpindahan kepemilikan kendaraan.</p>
                        <div class="info-item">
                            <span class="info-label">Dasar Pengenaan:</span> Nilai Jual Kendaraan Bermotor (NJKB)
                        </div>
                        <div class="info-item">
                            <span class="info-label">Tarif:</span> 10% dari NJKB
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kategori Kendaraan -->
            <div class="form-section-title">Kategori dan Tarif Pajak</div>
            
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Kategori Kendaraan</th>
                            <th>Tarif PKB</th>
                            <th>Tarif BBNKB</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Sepeda Motor</td>
                            <td>Rp 200.000 - Rp 1.500.000</td>
                            <td>10% dari NJKB</td>
                            <td>Tergantung CC dan wilayah</td>
                        </tr>
                        <tr>
                            <td>Mobil Pribadi</td>
                            <td>Rp 1.500.000 - Rp 15.000.000</td>
                            <td>10% dari NJKB</td>
                            <td>Tergantung CC dan wilayah</td>
                        </tr>
                        <tr>
                            <td>Mobil Niaga</td>
                            <td>Rp 2.000.000 - Rp 20.000.000</td>
                            <td>10% dari NJKB</td>
                            <td>Tergantung jenis dan wilayah</td>
                        </tr>
                        <tr>
                            <td>Bus</td>
                            <td>Rp 5.000.000 - Rp 50.000.000</td>
                            <td>10% dari NJKB</td>
                            <td>Tergantung kapasitas dan wilayah</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Kalkulator Pajak -->
            <div class="form-section-title">Kalkulator Estimasi Pajak</div>
            
            <div class="tax-calculation">
                <h6>Hitung Estimasi Pajak Anda</h6>
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Jenis Kendaraan</label>
                        <select class="form-select" id="jenis_kendaraan_calc">
                            <option value="">-- Pilih --</option>
                            <option value="motor">Sepeda Motor</option>
                            <option value="mobil">Mobil Pribadi</option>
                            <option value="niaga">Mobil Niaga</option>
                            <option value="bus">Bus</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">CC Kendaraan</label>
                        <input type="number" class="form-control" id="cc_kendaraan" placeholder="Masukkan CC">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Wilayah</label>
                        <select class="form-select" id="wilayah_calc">
                            <option value="">-- Pilih --</option>
                            <option value="jakarta">DKI Jakarta</option>
                            <option value="bandung">Bandung</option>
                            <option value="surabaya">Surabaya</option>
                            <option value="lampung">Lampung</option>
                        </select>
                    </div>
                </div>
                
                <div class="total-section">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Estimasi PKB:</strong>
                            <div class="total-amount" id="estimasi_pkb">Rp 0</div>
                        </div>
                        <div class="col-md-6">
                            <strong>Estimasi BBNKB:</strong>
                            <div class="total-amount" id="estimasi_bbnkb">Rp 0</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Pembayaran -->
            <div class="form-section-title">Informasi Pembayaran</div>
            
            <div class="info-box">
                <h6>Cara Pembayaran Pajak Kendaraan</h6>
                <p>Pajak kendaraan dapat dibayarkan melalui beberapa cara:</p>
                <ol>
                    <li><strong>Samsat Corner:</strong> Loket pembayaran pajak di mal atau tempat umum</li>
                    <li><strong>Bank Persepsi:</strong> Bank yang ditunjuk untuk menerima pembayaran pajak</li>
                    <li><strong>Online:</strong> Melalui aplikasi atau website resmi</li>
                    <li><strong>Mobile Samsat:</strong> Layanan samsat berkeliling</li>
                </ol>
            </div>

            <!-- Syarat dan Ketentuan -->
            <div class="form-section-title">Syarat dan Ketentuan</div>
            
            <div class="info-box">
                <h6>Persyaratan Pembayaran Pajak</h6>
                <ul>
                    <li>KTP asli dan fotokopi</li>
                    <li>Buku atau fotokopi STNK</li>
                    <li>Surat-surat kendaraan (jika ada perubahan)</li>
                    <li>Uang pembayaran sesuai dengan tagihan</li>
                </ul>
                
                <h6 class="mt-3">Ketentuan Penting</h6>
                <ul>
                    <li>Pajak kendaraan harus dibayar tepat waktu untuk menghindari denda</li>
                    <li>Denda keterlambatan: 25% per tahun dari PKB yang terhutang</li>
                    <li>Pajak yang sudah dibayar tidak dapat dikembalikan</li>
                </ul>
            </div>

        </div>
    </div>
</div>

<script>
// Simple tax calculator
document.getElementById('jenis_kendaraan_calc').addEventListener('change', calculateTax);
document.getElementById('cc_kendaraan').addEventListener('input', calculateTax);
document.getElementById('wilayah_calc').addEventListener('change', calculateTax);

function calculateTax() {
    const jenis = document.getElementById('jenis_kendaraan_calc').value;
    const cc = parseInt(document.getElementById('cc_kendaraan').value) || 0;
    const wilayah = document.getElementById('wilayah_calc').value;
    
    let pkb = 0;
    let bbnkb = 0;
    
    if (jenis && cc > 0 && wilayah) {
        // Simplified calculation based on type and CC
        if (jenis === 'motor') {
            pkb = Math.max(200000, cc * 500);
            bbnkb = cc * 1000;
        } else if (jenis === 'mobil') {
            pkb = Math.max(1500000, cc * 1000);
            bbnkb = cc * 2000;
        } else if (jenis === 'niaga') {
            pkb = Math.max(2000000, cc * 1500);
            bbnkb = cc * 2500;
        } else if (jenis === 'bus') {
            pkb = Math.max(5000000, cc * 2000);
            bbnkb = cc * 3000;
        }
        
        // Regional multiplier
        const multiplier = {
            'jakarta': 1.2,
            'bandung': 1.0,
            'surabaya': 1.1,
            'lampung': 0.9
        };
        
        pkb *= multiplier[wilayah] || 1;
        bbnkb *= multiplier[wilayah] || 1;
    }
    
    document.getElementById('estimasi_pkb').textContent = 'Rp ' + pkb.toLocaleString('id-ID');
    document.getElementById('estimasi_bbnkb').textContent = 'Rp ' + bbnkb.toLocaleString('id-ID');
}
</script>

<?= $this->include('admin/layout/footer') ?>

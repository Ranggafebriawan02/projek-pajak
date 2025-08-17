<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanModel extends Model
{
    protected $table = 'pengajuan_pajak';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 'nama_pemilik', 'no_polisi', 'jenis_kendaraan',
        'kota_pengurusan', 'metode_pembayaran', 'status', 'tracking_kode',
        'bukti_pembayaran', 'created_at'
    ];
}

<?php
namespace App\Models;

use CodeIgniter\Model;

class PajakModel extends Model
{
    protected $table = 'pengajuan_pajak';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_pemilik',
        'alamat',
        'no_whatsapp',
        'jenis_kendaraan',
        'kategori_kendaraan',
        'wilayah',
         'wilayah',
        'samsat',
        'plat_awal',
        'plat_nomor',
        'plat_akhir',
        'jenis_pajak',
        'estimasi_biaya',
        'metode_pembayaran',
        'jumlah_pembayaran',
        'nomor_registrasi',
        'merk_kendaraan',
        'tipe_kendaraan',
        'jenis_kendaraan_detail',
        'model_kendaraan',
        'tahun_pembuatan',
        'isi_silinder',
        'nomor_rangka',
        'nomor_mesin',
        'warna_kendaraan',       
        'status',
        'sudah_dihubungi',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;

}

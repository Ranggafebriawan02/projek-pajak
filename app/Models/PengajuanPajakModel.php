<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanPajakModel extends Model
{
    protected $table            = 'pengajuan_pajak';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'id_user',
        'id_petugas',
        'nama_pemohon',
        'nomor_polisi',
        'wilayah_samsat',
        'status_tracking',
        'estimasi_selesai',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Ambil total tugas per petugas
    public function getTotalTugas($id_petugas)
    {
        return $this->where('id_petugas', $id_petugas)->countAllResults();
    }

    // Hitung berdasarkan status tertentu
    public function getCountByStatus($id_petugas, $status)
    {
        return $this->where('id_petugas', $id_petugas)
                    ->where('status_tracking', $status)
                    ->countAllResults();
    }

    // Ambil daftar pengajuan pajak untuk petugas
    public function getTugasByPetugas($id_petugas)
    {
        return $this->where('id_petugas', $id_petugas)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }
}

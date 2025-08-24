<?php

namespace App\Controllers\Petugas;

use App\Controllers\BaseController;
use App\Models\PengajuanPajakModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $pengajuanModel = new PengajuanPajakModel();

        // Ambil id_petugas dari session (login petugas)
        $id_petugas = session()->get('id_petugas');

        // Hitung data untuk dashboard
        $totalTugas = $pengajuanModel->getTotalTugas($id_petugas);
        $diproses   = $pengajuanModel->getCountByStatus($id_petugas, 'Diproses');
        $pengantaran = $pengajuanModel->getCountByStatus($id_petugas, 'Pengantaran ke Samsat');
        $selesai    = $pengajuanModel->getCountByStatus($id_petugas, 'Selesai - Dokumen Siap Diambil');

        // Ambil daftar tugas terbaru
        $tugasTerbaru = $pengajuanModel->getTugasByPetugas($id_petugas);

        return view('petugas/dashboard', [
            'totalTugas'  => $totalTugas,
            'diproses'    => $diproses,
            'pengantaran' => $pengantaran,
            'selesai'     => $selesai,
            'tugasTerbaru'=> $tugasTerbaru
        ]);
    }
}

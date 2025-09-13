<?php

namespace App\Controllers\Petugas;

use App\Controllers\BaseController;
use App\Models\PengajuanModel;
use App\Models\PetugasModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // Ambil id petugas dari session bila ada, kalau tidak pakai 2 (sementara)
        $idPetugas = session()->get('id_petugas') ?? 2;

        $pengajuanModel = new PengajuanModel();
        $petugasModel   = new PetugasModel();

        // Hitung statistik pengajuan untuk petugas ini
        $totalPengajuan = $pengajuanModel->where('id_petugas', $idPetugas)->countAllResults();
        $diproses       = $pengajuanModel->where(['id_petugas' => $idPetugas, 'status' => 'Diproses'])->countAllResults();
        $selesai        = $pengajuanModel->where(['id_petugas' => $idPetugas, 'status' => 'Selesai'])->countAllResults();

        // Ambil data petugas (bisa return array atau object tergantung PetugasModel::$returnType)
        $petugas = $petugasModel->find($idPetugas);

        // Ambil nilai wilayah & nama secara aman (mendukung array atau object, dan null)
        $wilayah = '-';
        $namaPetugas = 'Petugas';
        if ($petugas) {
            if (is_array($petugas)) {
                $wilayah = $petugas['wilayah'] ?? '-';
                $namaPetugas = $petugas['nama'] ?? 'Petugas';
            } else { // object
                $wilayah = $petugas->wilayah ?? '-';
                $namaPetugas = $petugas->nama ?? 'Petugas';
            }
        }

        // Ambil daftar pengajuan terbaru (misal 20 teratas)
        $pengajuan = $pengajuanModel
                      ->where('id_petugas', $idPetugas)
                      ->orderBy('created_at', 'DESC')
                      ->findAll(20);

        $data = [
            'totalPengajuan' => $totalPengajuan,
            'diproses'       => $diproses,
            'selesai'        => $selesai,
            'wilayah'        => $wilayah,
            'namaPetugas'    => $namaPetugas,
            'pengajuan'      => $pengajuan,
        ];

        return view('petugas/dashboard', $data);
    }
}

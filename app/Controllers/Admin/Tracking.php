<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PajakModel;
use App\Models\TrackingModel;

class Tracking extends BaseController
{
    public function index()
    {
        $plat = $this->request->getGet('plat');
        $data = [];

        if ($plat) {
            $pajakModel = new PajakModel();
            $trackingModel = new TrackingModel();

            // Pisahkan input plat nomor (contoh: "B 1234 AB")
            $pecah = explode(' ', strtoupper(trim($plat)));
            $plat_awal  = $pecah[0] ?? '';
            $plat_nomor = $pecah[1] ?? '';
            $plat_akhir = $pecah[2] ?? '';

            // Cari data pengajuan berdasarkan plat
            $pengajuan = $pajakModel->where([
                'plat_awal'  => $plat_awal,
                'plat_nomor' => $plat_nomor,
                'plat_akhir' => $plat_akhir,
            ])->first();

            if ($pengajuan) {
                // Ambil data lokasi tracking terakhir
                $tracking = $trackingModel
                    ->where('pengajuan_id', $pengajuan['id'])
                    ->orderBy('updated_at', 'DESC')
                    ->first();

                // Gabungkan semua data yang dibutuhkan
                $data['data'] = array_merge($pengajuan, [
                    'lokasi_terakhir' => $tracking['lokasi'] ?? null,
                    'updated_at'      => $tracking['updated_at'] ?? null,
                ]);
            } else {
                $data['not_found'] = true;
            }
        }

        return view('admin/tracking/index', $data);
    }
}

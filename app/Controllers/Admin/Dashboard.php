<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PengajuanModel;
use App\Models\UserModel;
use App\Models\PajakModel;

class Dashboard extends BaseController
{
   public function index()
{
    $model = new PajakModel();

    $data['total_pengajuan'] = $model->countAll();
    $data['total_cicilan'] = $model->where('metode_pembayaran', 'cicilan')->countAllResults();
    $data['total_selesai'] = $model->where('status_tracking', 'Selesai - Dokumen Siap Diambil')->countAllResults();
    $data['total_wilayah'] = $model->distinct()->countAllResults('wilayah');

    $data['count_diproses'] = $model->where('status_tracking', 'Diproses')->countAllResults();
    $data['count_pengantaran'] = $model->where('status_tracking', 'Pengantaran ke Samsat')->countAllResults();
    $data['count_selesai'] = $model->where('status_tracking', 'Selesai - Dokumen Siap Diambil')->countAllResults();

    // Data untuk grafik pie per wilayah
    $wilayah_data = $model->select('wilayah, COUNT(*) as total')->groupBy('wilayah')->findAll();
    $wilayah_summary = [];
    foreach ($wilayah_data as $row) {
        $wilayah_summary[$row['wilayah']] = $row['total'];
    }
    $data['wilayah_summary'] = $wilayah_summary;

    return view('admin/dashboard', $data);
}

}

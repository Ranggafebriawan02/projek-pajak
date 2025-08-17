<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PajakModel;

class Cicilan extends BaseController
{
    protected $pajakModel;

    public function __construct()
    {
        $this->pajakModel = new PajakModel();
    }

    public function index()
    {
        $data['list'] = $this->pajakModel
            ->where('metode_pembayaran', 'cicilan')
            ->findAll();

        return view('admin/cicilan/index', $data);
    }

    public function kirim_pesan($id)
    {
        $pesan = $this->request->getPost('pesan');
        // Optional: simpan ke log / database jika perlu

        session()->setFlashdata('success', 'Pesan berhasil dikirim ke pemohon.');
        return redirect()->to(base_url('admin/cicilan'));
    }

    public function ditandai_dihubungi($id)
    {
        // Validasi apakah ID ada
        $pengajuan = $this->pajakModel->find($id);
        if (!$pengajuan) {
            return redirect()->back()->with('error', 'Data pengajuan tidak ditemukan.');
        }

        // Update status
        $this->pajakModel->update($id, ['sudah_dihubungi' => 1]);

        return redirect()->back()->with('success', 'Status pemohon berhasil ditandai sebagai sudah dihubungi.');
    }
}

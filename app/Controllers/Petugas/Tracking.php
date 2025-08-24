<?php

namespace App\Controllers\Petugas;

use App\Controllers\BaseController;
use App\Models\PengajuanModel;

class Tracking extends BaseController
{
    protected $pengajuanModel;

    public function __construct()
    {
        $this->pengajuanModel = new PengajuanModel();
    }

    public function index()
    {
        $idPetugas = session()->get('id');

        $pengajuan = $this->pengajuanModel
            ->where('id_petugas', $idPetugas)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('petugas/layout/header')
            . view('petugas/tracking/index', ['pengajuan' => $pengajuan])
            . view('petugas/layout/footer');
    }

    public function edit($id)
    {
        $pengajuan = $this->pengajuanModel->find($id);

        return view('petugas/layout/header')
            . view('petugas/tracking/edit', ['pengajuan' => $pengajuan])
            . view('petugas/layout/footer');
    }

    public function update($id)
    {
        $status = $this->request->getPost('status');

        $this->pengajuanModel->update($id, [
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to(base_url('petugas/tracking'))->with('success', 'Status berhasil diperbarui');
    }
}

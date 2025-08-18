<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PajakModel;
use App\Models\PetugasModel;

class Pajak extends BaseController
{
    protected $pajakModel;

    public function __construct()
    {
        $this->pajakModel = new PajakModel();
    }

    /** Tampilkan data pengajuan dengan filter */
    public function index()
{
    $wilayah = $this->request->getGet('wilayah');
    $tanggalMulai = $this->request->getGet('tanggal_mulai');
    $tanggalSelesai = $this->request->getGet('tanggal_selesai');

    $query = $this->pajakModel
        ->select('pengajuan_pajak.*, petugas.nama as nama')
        ->join('petugas', 'petugas.id = pengajuan_pajak.id_petugas', 'left');


    if ($wilayah) {
        $query = $query->where('pengajuan_pajak.wilayah', $wilayah);
    }

    if ($tanggalMulai && $tanggalSelesai) {
        $query = $query->where("DATE(pengajuan_pajak.created_at) BETWEEN '$tanggalMulai' AND '$tanggalSelesai'");
    }

    $data['pengajuan'] = $query->orderBy('pengajuan_pajak.created_at', 'DESC')->findAll();

    return view('admin/pajak/index', $data);
}


    /** Tampilkan form tambah */
    public function create()
    {
        return view('admin/pajak/create');
    }

    /** Simpan data baru */
    public function simpan()
    {
        $data = $this->request->getPost([
            'nama_pemilik', 'alamat', 'no_whatsapp', 'jenis_kendaraan', 'kategori_kendaraan', 'wilayah', 'samsat',
            'plat_awal', 'plat_nomor', 'plat_akhir', 'jenis_pajak', 'estimasi_biaya',
            'metode_pembayaran', 'jumlah_pembayaran', 'nomor_registrasi', 'merk_kendaraan',
            'tipe_kendaraan', 'jenis_kendaraan_detail', 'model_kendaraan', 'tahun_pembuatan',
            'isi_silinder', 'nomor_rangka', 'nomor_mesin', 'warna_kendaraan', 'idpetugas'
        ]);

        $data['status'] = 'Proses';

        // Upload KTP jika cicilan
        if ($data['metode_pembayaran'] === 'cicilan') {
            $file = $this->request->getFile('scan_ktp');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(FCPATH . 'uploads/ktp', $newName);
                $data['scan_ktp'] = $newName;
            }
        }

        $this->pajakModel->insert($data);

        return redirect()->to('/admin/pajak')->with('success', 'Pengajuan pajak berhasil ditambahkan.');
    }

    /** Tampilkan form edit */
    public function edit($id)
    {
        $data['pengajuan'] = $this->pajakModel->find($id);

        if (!$data['pengajuan']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }

        // Ambil daftar petugas sesuai wilayah
        $petugasModel = new PetugasModel();
        $data['petugasList'] = $petugasModel->where('wilayah', $data['pengajuan']['wilayah'])->findAll();

        return view('admin/pajak/edit', $data);
    }

    /** Proses update data */
    public function update($id)
    {
        $pengajuan = $this->pajakModel->find($id);

        if (!$pengajuan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }

        $data = $this->request->getPost([
            'nama_pemilik', 'alamat', 'jenis_kendaraan', 'kategori_kendaraan', 'wilayah', 'samsat',
            'plat_awal', 'plat_nomor', 'plat_akhir', 'jenis_pajak', 'estimasi_biaya',
            'metode_pembayaran', 'jumlah_pembayaran', 'nomor_registrasi', 'merk_kendaraan',
            'tipe_kendaraan', 'jenis_kendaraan_detail', 'model_kendaraan', 'tahun_pembuatan',
            'isi_silinder', 'nomor_rangka', 'nomor_mesin', 'warna_kendaraan', 'status', 'id_petugas'
        ]);

        // Upload ulang KTP jika metode cicilan
        if ($data['metode_pembayaran'] === 'cicilan') {
            $file = $this->request->getFile('scan_ktp');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(FCPATH . 'uploads/ktp', $newName);

                // Hapus file lama
                if (!empty($pengajuan['scan_ktp'])) {
                    $path = FCPATH . 'uploads/ktp/' . $pengajuan['scan_ktp'];
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }

                $data['scan_ktp'] = $newName;
            } else {
                $data['scan_ktp'] = $pengajuan['scan_ktp'];
            }
        } else {
            $data['scan_ktp'] = null;
        }

        $this->pajakModel->update($id, $data);

        return redirect()->to('/admin/pajak')->with('success', 'Data berhasil diperbarui.');
    }

    /** Tampilkan invoice */
    public function invoice($id)
    {
        $data = $this->pajakModel->find($id);

        if (!$data) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data tidak ditemukan");
        }

        $view = $data['metode_pembayaran'] === 'cicilan'
            ? 'admin/pajak/invoice_cicilan'
            : 'admin/pajak/invoice_lunas';

        return view($view, ['data' => $data]);
    }

    /** Surat Keterangan */
    public function surat_keterangan($id)
    {
        $data['pengajuan'] = $this->pajakModel->find($id);

        if (!$data['pengajuan']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }

        return view('admin/pajak/surat_keterangan', $data);
    }

    /** Hapus data pengajuan */
    public function delete($id)
    {
        $pengajuan = $this->pajakModel->find($id);

        if (!$pengajuan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }

        if (!empty($pengajuan['scan_ktp'])) {
            $path = FCPATH . 'uploads/ktp/' . $pengajuan['scan_ktp'];
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $this->pajakModel->delete($id);

        return redirect()->to('/admin/pajak')->with('success', 'Pengajuan pajak berhasil dihapus.');
    }
}

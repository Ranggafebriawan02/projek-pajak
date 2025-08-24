<?php

namespace App\Controllers\Petugas;

use App\Controllers\BaseController; // <-- tambahkan ini
use App\Models\PetugasModel;

class AuthPetugas extends BaseController
{
    public function login()
    {
        return view('petugas/login');
    }

    public function prosesLogin()
    {
        $session = session();
        $petugasModel = new PetugasModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $petugas = $petugasModel->login($username, $password);

        if ($petugas) {
            $session->set([
                'id_petugas' => $petugas['id_petugas'],
                'nama'       => $petugas['nama'],
                'username'   => $petugas['username'],
                'logged_in'  => true
            ]);

            return redirect()->to('/petugas/dashboard');
        } else {
            $session->setFlashdata('error', 'Username atau Password salah!');
            return redirect()->to('/petugas/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/petugas/login');
    }
}

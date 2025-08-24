<?php

namespace App\Models;

use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';
    protected $allowedFields = ['nama', 'username', 'password'];

    // fungsi untuk cek login
    public function login($username, $password)
    {
        return $this->where('username', $username)
                    ->where('password', $password) // plaintext
                    ->first();
    }
}

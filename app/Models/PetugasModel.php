<?php
namespace App\Models;

use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama', 
        'username', 
        'password', 
        'wilayah', 
        'no_telepon', 
        'created_at', 
        'updated_at'
    ];

    public function getByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}

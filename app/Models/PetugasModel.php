<?php
namespace App\Models;

use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'wilayah', 'no_telepon'];
}

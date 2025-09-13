<?php

namespace App\Models;

use CodeIgniter\Model;

class TugasModel extends Model
{
    protected $table = 'tugas';
    protected $primaryKey = 'id_tugas';
    protected $allowedFields = ['id_petugas', 'deskripsi', 'status', 'created_at'];
}

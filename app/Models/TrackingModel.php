<?php
namespace App\Models;

use CodeIgniter\Model;

class TrackingModel extends Model
{
    protected $table = 'tracking';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pengajuan_id', 'lokasi', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}

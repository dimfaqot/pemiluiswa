<?php

namespace App\Models;

use CodeIgniter\Model;

class Capres extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'capres';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tahun', 'pondok', 'no_partai', 'partai', 'singkatan_partai', 'logo_partai', 'capres', 'riwayat_capres', 'cawapres', 'riwayat_cawapres', 'visi', 'misi', 'kategori', 'absen', 'selesai', 'suara'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function cols()
    {
        return $this->allowedFields;
    }
}

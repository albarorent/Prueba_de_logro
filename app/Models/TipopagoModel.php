<?php

namespace App\Models;

use CodeIgniter\Model;

class TipopagoModel extends Model
{

    protected $table      = 'tipopago';
    protected $primaryKey = 'idtipopago';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['tipopago','status'];

    protected $useTimestamps = true;
    protected $createdField  = false;
    protected $updatedField  = null;
    protected $deletedField  = null;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

}
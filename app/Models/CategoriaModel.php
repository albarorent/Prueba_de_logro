<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{

    protected $table      = 'categoria';
    protected $primaryKey = 'idcategoria';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre','descripcion'];

    protected $useTimestamps = true;
    protected $createdField  = 'datecreated';
    protected $updatedField  = null;
    protected $deletedField  = null;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

}
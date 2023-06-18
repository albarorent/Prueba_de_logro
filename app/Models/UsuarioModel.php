<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{

    protected $table      = 'persona';
    protected $primaryKey = 'idpersona';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'dni',
        'nombres',
        'apellidos',
        'imagen',
        'telefono',
        'email_user',
        'password',
        'direccion',
        'genero',
        'rol',
        'status',
    ];

    protected $useTimestamps = true;
    protected $createdField  = null;
    protected $updatedField  = null;
    protected $deletedField  = null;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function cantUsuarios()
    {
        $this->select("count(idpersona) as cant");
        $this->where("rol != ", 3);
        $query = $this->first();
        return $query['cant'];
    }

    public function cantClientes()
    {
        $this->select("count(idpersona) as cant");
        $this->where("rol = ", 3);
        $query = $this->first();
        return $query['cant'];
    }

    
    public function getPersona(int $id)
    {
        $this->select("persona.idpersona,
                       persona.nombres,
                       persona.dni,
                       persona.telefono,
                       persona.rol,
                       persona.genero");

        $this->where("rol = ", $id);

        $query = $this->findAll();
        return $query;
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{

    protected $table      = 'producto';
    protected $primaryKey = 'idproducto';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['categoriaid', 'codigo', 'nombre', 'descripcion', 'precio', 'stock', 'imagen', 'datecreated', 'status'];

    protected $useTimestamps = true;
    protected $createdField  = 'datecreated';
    protected $updatedField  = null;
    protected $deletedField  = null;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getProducto($stock)
    {
        $this->select("
                        producto.idproducto,
                        producto.codigo,
                        producto.nombre,
                        producto.descripcion,
                        producto.precio,
                        producto.stock,
                        producto.imagen,
                        producto.status,
                        categoria.nombre as nombreCategoria");
        $this->join("categoria", "categoria.idcategoria = producto.categoriaid");
        $this->where('producto.stock >=', $stock);

        $query = $this->findAll();
        return $query;
    }

    public function getProductoPDF()
    {
        $this->select("
                        producto.idproducto,
                        producto.codigo,
                        producto.nombre,
                        producto.descripcion,
                        producto.precio,
                        producto.stock,
                        producto.imagen,
                        producto.status,
                        categoria.nombre as nombreCategoria");
        $this->join("categoria", "categoria.idcategoria = producto.categoriaid");

        $query = $this->findAll();
        return $query;
    }

    public function cantProductos()
    {
        $this->select("count(idproducto) as cant");
        $this->where('producto.status != ', 2);
        $query = $this->first();
        return $query['cant'];
    }
}

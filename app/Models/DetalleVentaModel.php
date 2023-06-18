<?php

namespace App\Models;

use CodeIgniter\Model;

class DetalleVentaModel extends Model
{

    protected $table      = 'detalleventa';
    protected $primaryKey = 'iddetalleventa';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idventa','idproducto','precio','cantidad'];

    protected $useTimestamps = true;
    protected $createdField  = false;
    protected $updatedField  = null;
    protected $deletedField  = null;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getDetalleVenta(int $id){
        $this->select("detalleventa.iddetalleventa,
                       venta.idventa,
                       venta.comprobante,
                       venta.subTotal,
                       venta.Total,
                       venta.fecha_registro,
                       tipopago.tipopago,
                       producto.nombre,
                       detalleventa.cantidad,
                       producto.precio,
                       persona.nombres,
                       persona.telefono,
                       persona.email_user");
        $this->join("venta", "venta.idVenta = detalleventa.idventa");
        $this->join("producto", "producto.idproducto = detalleventa.idproducto");
        $this->join("tipopago", "tipopago.idtipopago = venta.idtipopago");
        $this->join("persona", "persona.idpersona = venta.idpersona");
        $this->where("detalleventa.idventa",$id);

        $query = $this->findAll();
        return $query;
            
    }

}
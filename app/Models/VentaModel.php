<?php

namespace App\Models;

use CodeIgniter\Model;

class VentaModel extends Model
{

    protected $table      = 'venta';
    protected $primaryKey = 'idVenta';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['comprobante','subTotal','Total','idpersona','idtipopago'];

    protected $useTimestamps = true;
    protected $createdField  = 'fecha_registro';
    protected $updatedField  = null;
    protected $deletedField  = null;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

 

   public function cantVentas()
    {
        //  $sql = "SELECT COUNT(*) as total FROM pedido ";
        $this->select("count(idVenta) as cant");
        $query = $this->first();
        return $query['cant'];
    }

    public function getVenta()
    {
        //  $sql = "SELECT COUNT(*) as total FROM pedido ";
        $this->select("venta.idVenta,
                       venta.comprobante,
                       venta.subTotal,
                       venta.Total,
                       venta.fecha_registro,
                       persona.nombres,
                       tipopago.tipopago");
        $this->join("persona", "persona.idpersona = venta.idpersona");
        $this->join("tipopago", "tipopago.idtipopago = venta.idtipopago");


        $query = $this->findAll();
        return $query;
    }

    public function getIdVenta($id)
    {
        //  $sql = "SELECT COUNT(*) as total FROM pedido ";
        $this->select("venta.idVenta,
                       venta.comprobante,
                       venta.subTotal,
                       venta.Total,
                       venta.fecha_registro,
                       persona.nombres,
                       tipopago.tipopago");
        $this->join("persona", "persona.idpersona = venta.idpersona");
        $this->join("tipopago", "tipopago.idtipopago = venta.idtipopago");
        $this->where("idVenta",$id);


        $query = $this->findAll();
        return $query;
    }

    public function getVentasbyDate($fechaincio, $fechafin)
    {
        $this->select("
        venta.idVenta,
                       venta.comprobante,
                       venta.subTotal,
                       venta.Total,
                       venta.fecha_registro,
                       persona.nombres,
                       tipopago.tipopago,
        ");

        $this->join("persona", "persona.idpersona = venta.idpersona");
        $this->join("tipopago", "tipopago.idtipopago = venta.idtipopago");
        if ($fechaincio && $fechafin) {
            $this->where('venta.fecha_registro >=', $fechaincio);
            $this->where('venta.fecha_registro <=', $fechafin);
            echo "Filtrando por fechas";
        } else {
            echo "No se han proporcionado fechas";
        }

        $query = $this->findAll();
        return $query;
    }

    public function selectVentasDia($day,$anio,$mes)
    {
       $this->select("DAY(venta.fecha_registro) as dia, SUM(venta.Total) as total");
       $this->where('DAY(venta.fecha_registro)',$day);
       $this->where('MONTH(venta.fecha_registro)',$mes);
       $this->where('YEAR(venta.fecha_registro)',$anio);
       $this->groupBY('DAY(venta.fecha_registro)');
       $query = $this->findAll();
        return $query;
    }
    public function selectVentasMes($anio,$mes)
    {
        $this->select("DAY(venta.fecha_registro) as dia, SUM(venta.Total) as total");
        $this->where('MONTH(venta.fecha_registro)',$mes);
       $this->where('YEAR(venta.fecha_registro)',$anio);
       $this->groupBY('DAY(venta.fecha_registro)');
       $query = $this->findAll();
        return $query;
        
    }
    public function selectVentasAnio(int $anio){
        
        $this->select("SUM(venta.Total) as total,MONTH(venta.fecha_registro) as mes"); 
        $this->where('YEAR(venta.fecha_registro)',$anio);  
        $this->groupBY('MONTH(venta.fecha_registro)');
        $query = $this->findAll();

        return $query;
    }
}
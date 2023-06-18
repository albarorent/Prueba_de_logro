<?php

namespace App\Controllers;

use App\Models\VentaModel;
use App\Models\ProductoModel;
use App\Models\UsuarioModel;
use App\Models\TipopagoModel;
use App\Models\DetalleVentaModel;


class Venta extends BaseController
{

    protected $venta;
    protected $detalleVenta;
    protected $producto;
    protected $persona;
    protected $tipopago;
    protected $validacion;
    protected $rules_venta;

    public function __construct()
    {
        if (empty(session('loggin_in'))) {
             header('Location: ' . base_url() . '/login');
             die();
         }

        $this->validacion = \Config\Services::validation();
        $this->venta = new VentaModel();
        $this->producto = new ProductoModel();
        $this->persona = new UsuarioModel();
        $this->tipopago = new TipopagoModel();
        $this->detalleVenta = new DetalleVentaModel();
    }

    public function index()
    {
        $data["venta"] = $this->venta->findAll();
        $data["producto"] = $this->producto->findAll();
        $data["persona"] = $this->persona->getPersona(3);
        $data["tipopago"] = $this->tipopago->findAll();
        $data["detalleventa"] = $this->detalleVenta->findAll();
        $data['contenido'] = 'venta/venta';
        $data["titulo"] = "Ventas";

        return view('index', $data);
    }

    public function reglas()
    {
        $this->rules_venta = [
            "comprobante" => [
                "rules" => "required|is_unique[venta.comprobante,venta.idVenta,{id_}]",
                "errors" => [
                    "required" => "No se aceptan valores vacios.",
                    "is_unique" => "Ya existe un registro",
                ]
            ],
            "listTipopago" => [
                "rules" => "is_not_unique[tipopago.idtipopago]",
                "errors" => [
                    "is_not_unique" => "Valores no permitidos",
                ]
            ],
            "listCliente" => [
                "rules" => "is_not_unique[persona.idpersona]",
                "errors" => [
                    "is_not_unique" => "Valores no permitidos",
                ]
            ]
        ];

        return $this->rules_venta;
    }
    
    public function registrarDatos()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas()) ) {

            $comprobante = $this->request->getPost("comprobante");
            $listTipopago = $this->request->getPost("listTipopago");
            $listCliente = $this->request->getPost("listCliente");
            $subtotal = $this->request->getPost("subtotal");
            $total = $this->request->getPost("total");
            
            

            $idpro = $this->request->getPost("txtidproducto");
            $cantidad = $this->request->getPost("txtcantidad");
            $stock = $this->request->getPost("stock");
            $precio = $this->request->getPost("precio");


            $data = [
                "comprobante" => $comprobante,
                "subTotal" =>  $subtotal,
                "Total" =>  $total,
                "idpersona" =>  $listCliente,
                "idtipopago" =>  $listTipopago

            ];
            $this->venta->save($data);


            $ultimaventa = $this->venta->orderBy("idVenta", "DESC")->limit(1)->find();
            
            for ($i=0; $i < count($idpro) ; $i++) { 

                $dataDetalle = array(
                    "idventa" => $ultimaventa[0]["idVenta"],
                    "idproducto" => $idpro[$i],
                    "precio" => $precio[$i],
                    $cantidad == "" ? 1 : "cantidad" => $cantidad[$i],
                );

                $this->detalleVenta->save($dataDetalle);
                
                $resta = $stock[$i]-$cantidad[$i];
                $proData = array (
                    "stock" => $resta
                );

                $data = $this->producto->update($idpro[$i],$proData);

            }

            $this->session->setFlashdata('mensaje', '1');
            $this->session->setFlashdata('texto', 'Venta realizada correctamente');
            $arrResponse = array("statusCode" => 200, "msg" => 'Se registro correctamente');

        }else{
            $arrResponse = array("statusCode" => 500, "errors" =>$this->validacion->getErrors());
        }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

    }


    public function listarVenta(){
        $fechainicio  = $this->request->getPost("fechainicio");
        $fechafin  = $this->request->getPost("fechafin");

        if ($this->request->getPost("buscar")) {
            $cajaRes = $this->venta->getVentasbyDate($fechainicio, $fechafin);
        } else {
            $cajaRes = $this->venta->getVenta();
        }

        $data["venta"] = $cajaRes;
        $data["fechainicio"] = $fechainicio;
        $data["fechafin"] = $fechafin;
        $data["persona"] = $this->persona->findAll();
        $data["tipopago"] = $this->tipopago->findAll();
        $data['contenido'] = 'venta/listarventa';
        $data["titulo"] = "Ventas";

        return view('index', $data);
    }

    public function verVenta($id){
        $data["venta"] = $this->venta->getIdVenta($id);
        $data["persona"] = $this->persona->findAll();
        $data["tipopago"] = $this->tipopago->findAll();
        $data["detalleventa"] = $this->detalleVenta->getDetalleVenta($id);
        $data['contenido'] = 'venta/reporteventa';
        $data["titulo"] = "REPORTE DE VENTA";

        return view('index', $data);
    }
}

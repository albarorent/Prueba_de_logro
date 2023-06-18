<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\ProductoModel;
use App\Models\VentaModel;

class Inicio extends BaseController
{
	protected $session;
	protected $usuario;
	protected $producto;
	protected $venta;

	public function __construct()
	{
		if (empty(session('loggin_in'))) {
			header('Location: ' . base_url() . '/login');
			die();
		}

		$this->usuario = new UsuarioModel();
		$this->producto = new ProductoModel();
		$this->venta = new VentaModel();

		$this->session = \Config\Services::session();
	}

	public function index()
	{
		$data["contenido"] = "dashboard/dashboard";
		$data['cant_usuarios'] = $this->usuario->cantUsuarios();
		$data['cant_clientes'] = $this->usuario->cantClientes();
		$data['cant_producto'] = $this->producto->cantProductos();
		$data['cant_ventas'] = $this->venta->cantVentas();
		$data["usuario"] = $this->usuario->findAll();

		return view('index', $data);
	}

	public function ventasDiarias()
	{
		if ($_POST) {
			$grafica = "ventasDiarias";
			$nFecha = str_replace(" ", "", $_POST['fecha_registro']);
			$arrFecha = explode('-', $nFecha);
			$day = $arrFecha[0];
			$mes = $arrFecha[1];
			$anio = $arrFecha[2];

			$horaInicial = strtotime('midnight', strtotime($nFecha));
			$horaFinal = strtotime('tomorrow', $horaInicial) - 1;

			// Recorrer el día en intervalos de 1 hora
			for ($hora = $horaInicial; $hora <= $horaFinal; $hora += 3600) {
				$horaActual = date('H:i:s', $hora);
				echo "Hora: $horaActual\n";
				var_dump($horaActual);

			}
			$pagos = $this->venta->selectVentasDia($day, $anio, $mes);


			die();
		}
	}
	public function ventasMes()
	{
		if ($_POST) {
			$grafica = "ventasMes";
			$nFecha = str_replace(" ", "", $_POST['fecha_registro']);
			$arrFecha = explode('-', $nFecha);
			$mes = $arrFecha[0];
			$anio = $arrFecha[1];
			$pagos = $this->venta->selectVentasMes($anio, $mes);
			$dias = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
			$datagrafica = array();
			$datagrafica['montoTotal'] = 0.00;
			$dia = array();
			$total = array();
			$y = 0;
			for ($i = 1; $i <= $dias; $i++) {
				$dia[] = $i;
				$total[$y] = 0.00;
				$datagrafica['dias'][$i] = 0.00;
				foreach ($pagos as $k => $v) {
					if ($v['dia'] == $i) {
						$total[$y] = floatval($v['total']);
						$datagrafica['montoTotal'] += $v['total'];
					}
				}
				$y = $y + 1;
			}
			$datagrafica['dias'] = $dia;
			$datagrafica['total'] = $total;
			echo json_encode($datagrafica, JSON_UNESCAPED_UNICODE);

			die();
		}
	}
	public function ventasAnio()
	{
		if ($_POST) {
			$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
			$grafica = "ventasAnio";
			$anio = intval($_POST['anio']);
			$pagos = $this->venta->selectVentasAnio($anio);
			$datagrafica  = array();
			$x = 0;
			for ($i = 0; $i < 12; $i++) {

				$datagrafica[$x] = 0.00;
				foreach ($pagos as $k => $v) {
					if (($i + 1) == $v['mes']) {
						$datagrafica[$x] = floatval($v['total']);
					}
				}

				$x++;
			}
			//"["+value['mes']+","+value['total']+"],"
			echo json_encode($datagrafica, JSON_UNESCAPED_UNICODE);
			die();
		}
	}
}

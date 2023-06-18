<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuarioModel;

class PdfController extends BaseController
{

    protected $usuario;

    public function __construct()
    {
        if (empty(session('loggin_in'))) {
            header('Location: ' . base_url() . '/login');
            die();
        }
        $this->usuario = new UsuarioModel();
    }

    public function index()
    {
        $data["usuario"] = $this->usuario->findAll();
        $data["contenido"] = "clientes/reporte";
        $data["usuario"] = $this->usuario->findAll();
        return view("index", $data);
    }

    function htmlToPDF()
    {
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml(view('clientes/reporte'));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
    }
}

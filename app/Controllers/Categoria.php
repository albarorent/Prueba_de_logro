<?php

namespace App\Controllers;

use App\Models\CategoriaModel;

class Categoria extends BaseController
{
    protected $categoria;
    protected $validacion;
    protected $rules_categoria;
    protected $session;


    public function __construct()
    {
        if (empty(session('loggin_in'))) {
            header('Location: ' . base_url() . '/login');
            die();
        }

        $this->validacion = \Config\Services::validation();
        $this->categoria = new CategoriaModel();
        $this->session = \Config\Services::session();

    }

    public function index()
    {
        $data["categoria"] = $this->categoria->findAll();
        $data['contenido'] = 'categoria/categoria';
        $data["titulo"] = "Categorias";

        return view('index', $data);
    }

    public function reglas()
    {
        $this->rules_categoria = [
            "nombre" => [
                "rules" => "required|is_unique[categoria.nombre,categoria.idcategoria,{id_}]",
                "errors" => [
                    "required" => "No se aceptan valores vacios.",
                    'is_unique' => "Esta categoria ya esta registrada",
                ]
            ],
            "txtDescripcion" => [
                "rules" => "required|min_length[10]|max_length[30]",
                "errors" => [
                    "required" => "No se aceptan valores vacios.",
                    "min_length" => "Cant. m�nima de caracteres: [10]",
                    "max_length" => "Cant. m�xima de caracteres: [30]",
                ]
            ]
        ];

        return $this->rules_categoria;
    }

    public function registrar()
    {
        $data["categoria"] = $this->categoria->findAll();
        $data["contenido"] = "categoria/registrar";
        return view("index", $data);
    }


    public function registrarDatos()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas())) {

            $nombreEsp = $this->request->getPost("nombre");
            $descripcion = $this->request->getPost("txtDescripcion");

            $data = [
                "nombre" => $nombreEsp,
                "descripcion" =>  $descripcion
            ];
            
            $this->categoria->save($data);

            $this->session->setFlashdata('mensaje', '1');
            $this->session->setFlashdata('texto', 'Datos registrados correctamente');
            return redirect()->to(base_url() . "/categoria");
        } else {
            $data["categoria"] = $this->categoria->findAll();
            $data["titulo"] = "Categoria";
            $data["contenido"] = "categoria/registrar";
            $data["validation"] = $this->validator;
            return view("index", $data);
        }
    }

    public function verRegistro($id)
    {
        $data["categoria"] = $this->categoria->where("idcategoria", $id)->first();
        $data["contenido"] = "categoria/actualizar";
        return view("index", $data);
    }


    public function actualizarDatos($id)
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas())) {

            $id = $this->request->getPost("id_");

            $nombreEsp = $this->request->getPost("nombre");
            $descripcion = $this->request->getPost("txtDescripcion");

            $data = [
                "nombre" => $nombreEsp,
                "descripcion" =>  $descripcion
            ];

            $this->categoria->update($id, $data);

            $this->session->setFlashdata('mensaje', '1');
            $this->session->setFlashdata('texto', 'Datos Actualizados correctamente');
            return redirect()->to(base_url() . "/categoria");
        } else {
            $data["categoria"] = $this->categoria->where("idcategoria", $id)->first();
            $data["titulo"] = "Categoria";
            $data["contenido"] = "categoria/actualizar";
            $data["validation"] = $this->validator;
            return view("index", $data);
        }
    }

    public function eliminarRegistro($id)
    {
        try {
            $this->categoria->where('idcategoria', $id);
            $this->categoria->delete();
            $this->session->setFlashdata('mensaje', '1');
            $this->session->setFlashdata('texto', 'Datos eliminados correctamente');
            return redirect()->to(base_url() . '/Categoria');
        } catch (\Exception $e) {
            $this->session->setFlashdata('mensaje', '0');
            $this->session->setFlashdata('texto', 'Dicha categoria ya tiene registros asociados');
            return redirect()->to(base_url() . '/Categoria');
        }
    }

    // GENERAR PDF

    public function muestraClientePdf()
    {
        $data["categoria"] = $this->categoria->findAll();
        echo view('categoria/reporte', $data);
    }

    public function generarClientePdf()
    {
        $cat = $this->categoria->findAll();

        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 12);
        $pdf->SetTitle(utf8_decode("Reporte de Categorias"));
        $pdf->SetFont('Arial', 'B', 12);

        $pdf->Cell(195, 5, utf8_decode("Reporte de las Categorías"), 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 9);

        $pdf->Image(base_url() . '/public/images/logo.jpg', 185, 10, 20, 20, 'JPG');

        $pdf->Cell(50, 5, utf8_decode("Cafetería Raider"), 0, 1, 'L');
        $pdf->Cell(50, 5, "Chiclayo", 0, 1, 'L');
        $pdf->Cell(50, 5, "Fecha: " . date('d/m/y'), 0, 1, 'L');
        $pdf->Cell(50, 5, "Hora: " . date('H:i:s'), 0, 1, 'L');

        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(180, 5, utf8_decode("Detalle de las Categorías"), 1, 1, 'C', 1);

        $pdf->SetTextColor(0, 0, 0);
        // $pdf->Cell(14, 5,  utf8_decode('N°'), 1, 0, 'L');
        $pdf->Cell(10, 5, utf8_decode('N°'), 1, 0, 'C');
        $pdf->Cell(40, 5, 'Nombre', 1, 0, 'C');
        $pdf->Cell(130, 5, utf8_decode('Descripción'), 1, 0, 'C');

        $pdf->SetFont('Arial', '', 8);

        $count = 1;
        foreach ($cat as $row) {
            $pdf->Cell(0, 5, "", 0, 1, 'C');
            $pdf->Cell(10, 5, $count++, 1, 0, 'C');
            $pdf->Cell(40, 5, utf8_decode($row['nombre']), 1, 0, 'C');
            $pdf->Cell(130, 5, utf8_decode($row['descripcion']), 1, 0, 'C');
        }

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("Categoria.pdf", "I");
    }
}

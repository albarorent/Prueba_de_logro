<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use App\Models\CategoriaModel;


class Producto extends BaseController
{
    protected $producto;
    protected $categoria;
    protected $validacion;
    protected $session;
    protected $rules_Pro;

    public function __construct()
    {
        if (empty(session('loggin_in'))) {
            header('Location: ' . base_url() . '/login');
            die();
        }

        $this->validacion = \Config\Services::validation();
        $this->producto = new ProductoModel();
        $this->categoria = new CategoriaModel();
        $this->session = \Config\Services::session();

    }

    public function index()
    {
        $data["producto"] = $this->producto->getProducto(1);
        $data["categoria"] = $this->categoria->findAll();
        $data['contenido'] = 'producto/producto';
        $data["titulo"] = "Productos";

        return view('index', $data);
    }

    public function reglas()
    {
        $this->rules_Pro = [
            "nombre" => [
                "rules" => "required|is_unique[producto.nombre,producto.idproducto,{id_}]",
                "errors" => [
                    "required" => "No se aceptan valores vacios.",
                    "is_unique" => "Ya existe un registro",
                ]
            ],
            "txtDescripcion" => [
                "rules" => "required|min_length[10]|max_length[20]",
                "errors" => [
                    "required" => "No se aceptan valores vacios.",
                    "min_length" => "Cant. mínima de caracteres: [10]",
                    "max_length" => "Cant. máxima de caracteres: [20]",
                ]
            ],
            "codigo" => [
                "rules" => "required|min_length[8]|max_length[8]|is_unique[producto.codigo,producto.idproducto,{id_}]",
                "errors" => [
                    "required" => "No se aceptan valores vacios.",
                    "min_length" => "Cant. mínima de caracteres: [8]",
                    "max_length" => "Cant. máxima de caracteres: [8]",
                    "is_unique" => "Ya existe un registro",
                ]
            ],
            "precio" => [
                "rules" => "required",
                "errors" => [
                    "required" => "No se aceptan valores vacios.",
                ]
            ],
            "stock" => [
                "rules" => "required",
                "errors" => [
                    "required" => "No se aceptan valores vacios.",
                ]
            ],
            "listStatus" => [
                "rules" => "in_list[1,2]",
                "errors" => [
                    "in_list" => "Valores no permitidos",
                ]
            ],
            "txtImagen" => [
                "rules" => "uploaded[imagen]"
                    . "|mime_in[imagen,image/jpg,image/jpeg,image/gif,image/png]"
                    . "|max_size[imagen,1048]",
                "errors" => [
                    "uploaded" => "Debe ser requerido este campo",
                    "mime_in"  => "Solo se aceptan valores: .jpg, .jpeg, .gif, .jpeg",
                    "max_size" => "Peso máximo permitido: 1048 MB"
                ]
            ],
            "listCategoria" => [
                "rules" => "is_not_unique[categoria.idcategoria]",
                "errors" => [
                    "is_not_unique" => "Valores no permitidos",
                ]
            ]
        ];

        return $this->rules_Pro;
    }

    public function registrar()
    {
        $data["producto"] = $this->producto->findAll();
        $data["categoria"] = $this->categoria->findAll();
        $data["contenido"] = "producto/registrar";
        return view("index", $data);
    }

    public function registrarDatos()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas())) {

            $categoria = $this->request->getPost("listCategoria");
            $codigo = $this->request->getPost("codigo");
            $nombre = $this->request->getPost("nombre");
            $descripcion = $this->request->getPost("txtDescripcion");
            $precio = $this->request->getPost("precio");
            $stock = $this->request->getPost("stock");
            $status = $this->request->getPost("listStatus");

            $imagen = $this->request->getFile("imagen");
            $newName = $imagen->getRandomName();
            $imagen->move("./public/productos/", $newName);

            $data = [
                "categoriaid" => $categoria,
                "codigo" =>  $codigo,
                "nombre" =>  $nombre,
                "descripcion" =>  $descripcion,
                "precio" =>  $precio,
                "stock" =>  $stock,
                "imagen" =>  $newName,
                "status" =>  $status

            ];
            $this->producto->save($data);
            //print_r($data);

            $this->session->setFlashdata('mensaje', '1');
            $this->session->setFlashdata('texto', 'Datos registrados correctamente');
            return redirect()->to(base_url() . "/producto");
        } else {
            $data["producto"] = $this->producto->findAll();
            $data["categoria"] = $this->categoria->findAll();
            $data["contenido"] = "producto/registrar";
            $data["validation"] = $this->validator;
            return view("index", $data);
        }
    }

    public function verRegistro($id)
    {
        $data["producto"] = $this->producto->where("idproducto", $id)->first();
        $data["categoria"] = $this->categoria->findAll();
        $data["contenido"] = "producto/actualizar";
        return view("index", $data);
    }

    public function actualizarDatos($id)
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas())) {

            $id = $this->request->getPost("id_");
            $img = $this->request->getPost("txtImg");

            $categoria = $this->request->getPost("listCategoria");
            $codigo = $this->request->getPost("codigo");
            $nombre = $this->request->getPost("nombre");
            $descripcion = $this->request->getPost("txtDescripcion");
            $precio = $this->request->getPost("precio");
            $stock = $this->request->getPost("stock");
            $status = $this->request->getPost("listStatus");

            $imagen = $this->request->getFile("imagen");
            $newName = $imagen->getRandomName();

            $archivo = "./public/productos/" . $img;

            if (is_file($archivo)) {
                unlink($archivo);
                $imagen->move("./public/productos/", $newName);
            } else {
                $imagen->move("./public/productos/", $newName);
            }

            $data = [
                "categoriaid" => $categoria,
                "codigo" =>  $codigo,
                "nombre" =>  $nombre,
                "descripcion" =>  $descripcion,
                "precio" =>  $precio,
                "stock" =>  $stock,
                "imagen" =>  $newName,
                "status" =>  $status

            ];
            $this->producto->update($id, $data);
            //print_r($data);

            $this->session->setFlashdata('mensaje', '1');
            $this->session->setFlashdata('texto', 'Datos Actualizados correctamente');
            return redirect()->to(base_url() . "/producto");
        } else {
            $data["producto"] = $this->producto->where("idproducto", $id)->first();
            $data["categoria"] = $this->categoria->findAll();
            $data["contenido"] = "producto/actualizar";
            $data["validation"] = $this->validator;
            return view("index", $data);
        }
    }


    public function eliminarRegistro($id)
    {
        try {
            $img = $this->producto->select("imagen")->where("idproducto", $id)->first();


            $this->producto->where("idproducto", $id);
            $this->producto->delete();


            $archivo = "./public/productos/" . $img["imagen"];
            if (is_file($archivo)) {
                unlink($archivo);
            }

            $this->session->setFlashdata('mensaje', '1');
            $this->session->setFlashdata('texto', 'Datos eliminados correctamente');

            return redirect()->to(base_url() . '/producto');
        } catch (\Exception $e) {
            $this->session->setFlashdata('mensaje', '0');
            $this->session->setFlashdata('texto', 'Dicha Producto ya tiene registros asociados');
            return redirect()->to(base_url() . '/producto');
        }
    }

    // GENERAR PDF
    public function muestraClientePdf()
    {
        $data["producto"] = $this->producto->getProductoPDF();
        echo view('producto/reporte', $data);
    }

    public function generarClientePdf()
    {
        $prod = $this->producto->findAll();

        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 12);
        $pdf->SetTitle("Reporte de Productos");
        $pdf->SetFont('Arial', 'B', 18);

        $pdf->Cell(195, 5, "Reporte de Productos", 0, 1, 'C');
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
        $pdf->Cell(170, 5, "Detalle de los Productos", 1, 1, 'C', 1);

        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(10, 5,  utf8_decode('N°'), 1, 0, 'C');
        $pdf->Cell(40, 5, 'Nombre', 1, 0, 'C');
        $pdf->Cell(40, 5, utf8_decode('Código'), 1, 0, 'C');
        $pdf->Cell(25, 5, 'Precio', 1, 0, 'C');
        $pdf->Cell(25, 5,  'Stock', 1, 0, 'C');
        $pdf->Cell(30, 5,  utf8_decode('Estado'), 1, 0, 'C');

        $pdf->SetFont('Arial', '', 8);
        $count = 1;
        foreach ($prod as $row) {
            $pdf->Cell(0, 5, "", 0, 1, 'C');
            $pdf->Cell(10, 5, $count++, 1, 0, 'C');
            $pdf->Cell(40, 5, utf8_decode($row['nombre']), 1, 0, 'C');
            $pdf->Cell(40, 5, utf8_decode($row['codigo']), 1, 0, 'C');
            $pdf->Cell(25, 5, $row['precio'], 1, 0, 'C');
            $pdf->Cell(25, 5, $row['stock'], 1, 0, 'C');
            if ($row['status'] == 1) {
                $pdf->SetTextColor(0, 0, 255);
                $pdf->Cell(30, 5, "Activo", 1, 0, 'C');
                $pdf->SetTextColor(0, 0, 0);
            } else {
                $pdf->SetTextColor(255, 0, 0);
                $pdf->Cell(30, 5, ("Inactivo"), 1, 0, 'C');
            }
            // $row['status'] == 1 ? $pdf->Cell(30, 5, "Activo", 1, 0, 'C') : $pdf->Cell(30, 5, ("Inactivo"), 1, 0, 'C');
        }

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("Productos.pdf", "I");
    }
}

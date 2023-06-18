<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Usuarios extends BaseController
{
    protected $usuario;
    protected $validacion;
    protected $session;
    protected $rules_usu;


    public function __construct()
    {
        if (empty(session('loggin_in'))) {
            header('Location: ' . base_url() . '/login');
            die();
        }
        $this->validacion = \Config\Services::validation();
        $this->usuario = new UsuarioModel();
        $this->session = \Config\Services::session();

    }

    public function index()
    {
        $data['titulo'] = "Usuarios";
        $data['contenido'] = 'usuarios/usuarios';
        $data["usuario"] = $this->usuario->findAll();
        return view('index', $data);
    }

    public function registrar()
    {
        $data["titulo"] = "Registrar Nuevo Usuario";
        $data["contenido"] = "usuarios/registrar";
        $data["usuario"] = $this->usuario->findAll();

        return view("index", $data);
    }

    public function reglas()
    {
        $this->rules_usu = [
            "dni" => [
                "rules" => "required",
                "errors" => [
                    "required" => "No se aceptan valores vacios.",
                ]
            ],
            "nombre" => [
                "rules" => "required|max_length[20]",
                "errors" => [
                    "required" => "No se aceptan valores vacios.",
                    "max_length" => "Cant. máxima de caracteres: [20]",
                ]
            ],
            "apellidos" => [
                "rules" => "required|max_length[25]",
                "errors" => [
                    "required" => "No se aceptan valores vacios.",
                    "max_length" => "Cant. máxima de caracteres: [25]",
                ]
            ],
            "telefono" => [
                "rules" => "required|max_length[9]",
                "errors" => [
                    "required" => "No se aceptan valores vacios.",
                    "max_length" => "Cant. máxima de caracteres: [9]",
                ]
            ],
            "email" => [
                "rules" => "required|valid_email",
                "errors" => [
                    "required" => "No se aceptan valores vacios.",
                    "valid_email" => "Ingrese un email valido",
                ]
            ],
            "password" => [
                "rules" => "required",
                "errors" => [
                    "required" => "No se aceptan valores vacios.",
                ]
            ],
            "direccion" => [
                "rules" => "required",
                "errors" => [
                    "required" => "No se aceptan valores vacios.",
                ]
            ],
            "listGenero" => [
                "rules" => "in_list[1,2]",
                "errors" => [
                    "in_list" => "Valores no permitidos",
                ]
            ],
            "listRol" => [
                "rules" => "in_list[1,2]",
                "errors" => [
                    "in_list" => "Valores no permitidos",
                ]
            ],
            "listStatus" => [
                "rules" => "in_list[1,2]",
                "errors" => [
                    "in_list" => "Valores no permitidos",
                ]
            ],
        ];
        return $this->rules_usu;
    }

    // Registrar datos
    public function registrarDatos()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas())) {

            $txtDni = $this->request->getPost("dni");
            $txtNombre = $this->request->getPost("nombre");
            $txtApellidos = $this->request->getPost("apellidos");
            $txtTelefono = $this->request->getPost("telefono");
            $txtEmail = $this->request->getPost("email");
            $txtPassword = $this->request->getPost("password");
            $txtDireccion = $this->request->getPost("direccion");
            $txtGenero = $this->request->getPost("listGenero");
            $txtRol = $this->request->getPost("listRol");
            $txtEstado = $this->request->getPost("listStatus");

            $imagen = $this->request->getFile("imagen");
            $newName = '';
            if ($imagen != '') {
                $newName = $imagen->getRandomName();
                $imagen->move("./public/usuarios/", $newName);
            }


            $data = [
                "dni" => $txtDni,
                "nombres" => $txtNombre,
                "apellidos" => $txtApellidos,
                "imagen" => $newName,
                "telefono" => $txtTelefono,
                "email_user" => $txtEmail,
                "password" => hash("SHA256", $txtPassword),
                "direccion" => $txtDireccion,
                "genero" => $txtGenero,
                "rol" => $txtRol,
                "status" => $txtEstado
            ];

            $this->usuario->save($data);

            $this->session->setFlashdata("mensaje", "1");
            $this->session->setFlashdata("texto", "Datos Registrados Correctamente");

            return redirect()->to(base_url() . "/usuarios");
        } else {
            $data["titulo"] = "Registrar Nuevo Usuario";
            $data["validation"] = $this->validator;
            $data["contenido"] = "usuarios/registrar";
            $data["usuario"] = $this->usuario->findAll();
            return view("index", $data);
        }
    }

    public function verRegistro($id)
    {
        $data["usuario"] = $this->usuario->where('idpersona', $id)->first();
        $data["contenido"] = "usuarios/actualizar";
        $data["titulo"] = "Actualizar Usuario";
        return view("index", $data);
    }

    // Actualizar Usuario
    public function actualizarDatos($id)
    {
        if ($this->request->getMethod() == "post"  && $this->validate($this->reglas())) {

            $img = $this->request->getPost("imagen");
            $txtDni = $this->request->getPost("dni");
            $txtNombre = $this->request->getPost("nombre");
            $txtApellidos = $this->request->getPost("apellidos");
            $txtTelefono = $this->request->getPost("telefono");
            $txtEmail = $this->request->getPost("email");
            $txtPassword = $this->request->getPost("password");
            $txtDireccion = $this->request->getPost("direccion");
            $txtGenero = $this->request->getPost("listGenero");
            $txtRol = $this->request->getPost("listRol");
            $txtEstado = $this->request->getPost("listStatus");

            $imagen = $this->request->getFile("imagen");
            $newName = '';
            if ($imagen != '') {
                $newName = $imagen->getRandomName();
                $archivo = ("./public/usuarios/" . $img);

                if (is_file($archivo)) {
                    unlink($archivo);
                    $imagen->move("./public/usuarios/", $newName);
                } else {
                    $imagen->move("./public/usuarios/", $newName);
                }
            }


            $data = [
                "dni" => $txtDni,
                "nombres" => $txtNombre,
                "apellidos" => $txtApellidos,
                "imagen" => $newName,
                "telefono" => $txtTelefono,
                "email_user" => $txtEmail,
                "password" => hash("SHA256", $txtPassword),
                "direccion" => $txtDireccion,
                "genero" => $txtGenero,
                "rol" => $txtRol,
                "status" => $txtEstado
            ];

            $this->usuario->update($id, $data);
            $this->session->setFlashdata("mensaje", "1");
            $this->session->setFlashdata("texto", "Datos actualizados correctamente");

            return redirect()->to(base_url() . "/usuarios");
        } else {
            $data["validation"] = $this->validator;
            $data["usuario"] = $this->usuario->where('idpersona', $id)->first();
            $data["contenido"] = "usuarios/actualizar";
            $data["titulo"] = "Actualizar Usuario";
            return view("index", $data);
        }
    }

    // Eliminar datos
    public function eliminarRegistro($id)
    {
        try {
            $this->usuario->where("idpersona", $id);
            $this->usuario->delete();

            $this->session->setFlashdata("mensaje", "1");
            $this->session->setFlashdata("texto", "Datos Eliminados Correctamente");

            return redirect()->to(base_url() . "/usuarios");
        } catch (\Exception $e) {
            $this->session->setFlashdata("mensaje", "0");
            $this->session->setFlashdata("texto", "Error al eliminar");

            return redirect()->to(base_url() . "/usuarios");
        }
    }

    // GENERAR PDF

    public function muestraClientePdf()
    {
        $data["usuario"] = $this->usuario->findAll();
        echo view('usuarios/reporte', $data);
    }

    public function generarClientePdf()
    {
        $user = $this->usuario->findAll();

        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 12);
        $pdf->SetTitle("Reporte de Usuarios");
        $pdf->SetFont('Arial', 'B', 12);

        $pdf->Cell(195, 5, "Reporte de Usuarios", 0, 1, 'C');
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
        $pdf->Cell(180, 5, "Detalle de los Usuarios", 1, 1, 'C', 1);

        $pdf->SetTextColor(0, 0, 0);
        // $pdf->Cell(14, 5,  utf8_decode('N°'), 1, 0, 'L');
        $pdf->Cell(30, 5, 'Nombre', 1, 0, 'C');
        $pdf->Cell(40, 5, 'Apellidos', 1, 0, 'C');
        $pdf->Cell(25, 5, 'Telefono', 1, 0, 'C');
        $pdf->Cell(30, 5,  utf8_decode('Correo'), 1, 0, 'C');
        $pdf->Cell(25, 5,  utf8_decode('Género'), 1, 0, 'C');
        $pdf->Cell(30, 5,  'Rol', 1, 0, 'C');

        $pdf->SetFont('Arial', '', 8);

        foreach ($user as $row) {
            if ($row['rol'] != 3) {
                // $pdf->Cell(14, 5, $row['idpersona'], 0, 1, 'C');
                $pdf->Cell(0, 5, "", 0, 1, 'C');
                $pdf->Cell(30, 5, utf8_decode($row['nombres']), 1, 0, 'C');
                $pdf->Cell(40, 5, utf8_decode($row['apellidos']), 1, 0, 'C');
                $pdf->Cell(25, 5, $row['telefono'], 1, 0, 'C');
                $pdf->Cell(30, 5, utf8_decode($row['email_user']), 1, 0, 'C');
                $row['genero'] == 1 ? $pdf->Cell(25, 5, "Masculino", 1, 0, 'C') : $pdf->Cell(25, 5, "Femenino", 1, 0, 'C');
                $row['rol'] == 1 ? $pdf->Cell(30, 5, "Administrador", 1, 0, 'C') : $pdf->Cell(30, 5, "Trabajador", 1, 0, 'C');
            }
        }

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("Usuarios.pdf", "I");
    }
}

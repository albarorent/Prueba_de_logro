<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Login extends BaseController
{
    protected $usuario;
    protected $validacion;
    protected $session;

    public function __construct()
    {
        $this->validacion = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->usuario = new UsuarioModel();
    }

    public function index()
    {
        $data['titulo'] = 'Inicia sesión';

        return view('login/login', $data);
    }

    public function validacion_do()
    {
        if ($this->request->getMethod() == "post") {

            $usuario = $this->request->getPost("txt_usuario");
            $password = $this->request->getPost("password");

            $password = hash("SHA256", $password);

            $query = $this->usuario->where('email_user', $usuario)->where('password', $password)->first();
            if (isset($query) && $query["status"] == 1) {
                $data = [
                    "idUsuario"         => $query["idpersona"],
                    "nombreCompleto"    => $query["nombres"] . " " . $query["apellidos"],
                    "estado"            => $query["status"],
                    "rol"               => $query["rol"],
                    "loggin_in"         => "1"
                ];
                $this->session->set($data);

                return redirect()->to(base_url() . "/Inicio")->with("msj_login", "Acceso concedido");
            } else {
                return redirect()->to(base_url() . "/Login")->with("msj_login", "Datos Incorrectos");
            }
        }
    }

    public function logaut()
    {
        $this->session->destroy();
        return redirect()->to(base_url() . '/login');
    }
}

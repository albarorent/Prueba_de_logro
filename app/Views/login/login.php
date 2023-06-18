<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="shortcut icon" href="<?php echo base_url(); ?>/public/dist/img/icons8-cafe-48.png">
    <title>
        Cafeteria
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="<?php echo base_url(); ?>/public/login/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>/public/login/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?php echo base_url(); ?>/public/login/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
</head>

<body class="bg-gray-200">
    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-100" style="background-image: url('<?php echo base_url(); ?>/public/login/images/fondo.jpg');">
            <span class=" mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-dark shadow-dark border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">
                                        <strong><?php echo $titulo; ?></strong>
                                    </h4>
                                    <div class="row mt-3">
                                        <div class="col-2 text-center ms-auto">
                                            <a class="btn btn-link px-3" href="#">
                                                <i class="fa fa-facebook text-white text-lg"></i>
                                            </a>
                                        </div>
                                        <div class="col-2 text-center px-1">
                                            <a class="btn btn-link px-3" href="#">
                                                <i class="fa fa-instagram text-white text-lg"></i>
                                            </a>
                                        </div>
                                        <div class="col-2 text-center me-auto">
                                            <a class="btn btn-link px-3" href="#">
                                                <i class="fa fa-whatsapp text-white text-lg"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body mt-3 mb-3">
                                <?php error_reporting(0); ?>
                                <?php if (isset($_SESSION["msj_login"])) : ?>
                                    <div class="bg-danger w-100 p-2 text-center text-uppercase border-radius-2xl">
                                        <small class="form-text text-center text-white"><b><?php echo $_SESSION["msj_login"]; ?></b></small>
                                    </div>
                                <?php endif; ?>
                                <form name="formLogin" id="formLogin" action="<?php echo base_url() ?>/login/validacion_do" method="post">

                                    <div class="input-group-outline my-3 d-flex flex-column">
                                        <label class="form-label">Correo</label>
                                        <input type="email" class="border border-darkform-control form-control p-2" id="usuario" name="txt_usuario" placeholder="ejemplo@correo.com" autofocus />
                                        <p id="errCategoria" style="color:red">
                                            <?php echo (isset($validation)) ? $validation->getError('txt_usuario') : ""; ?>
                                        </p>
                                    </div>

                                    <div class="input-group-outline my-3 d-flex flex-column">
                                        <label class="form-label">Contraseña</label>
                                        <input type="password" class="border border-darkform-control form-control p-2" id="password" name="password" placeholder="***********" />
                                        <p id="errCategoria" style="color:red">
                                            <?php echo (isset($validation)) ? $validation->getError('password') : ""; ?>
                                        </p>
                                    </div>

                                    <div class="text-center">
                                        <input type="submit" value="Ingresar" class="btn bg-dark text-white w-100 my-4 mb-2">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>
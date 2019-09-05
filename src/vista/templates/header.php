<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Pera</title>
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/main.css">
    <!--<link rel="stylesheet" href="<?php //echo constant('URL'); ?>public/css/bootstrap.css">-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script type="text/javascript" src="<?php echo constant('URL'); ?>public/js/main.js"></script>
  </head>
  <body>

<div class="bg-ista-blue">

  <div class="container">
    <nav class="navbar navbar-expand-md navbar-dark">
      <a href="/pera-admin"
      class="navbar-brand p-2 text-ista-yellow" >
        <img src="<?php echo constant('URL'); ?>public/img/icons/pera.png" width="40" height="40" class="d-inline-block" alt="">
        <span class="text-dark">Pera</span>
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">

            <!--FORMULARIO -->
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle text-light" data-toggle="dropdown">Formulario Ficha </a>
              <div class="dropdown-menu">
                <a href="<?php echo constant('URL'); ?>seccionficha" class="dropdown-item">Seccion Ficha</a>
                <a href="<?php echo constant('URL'); ?>preguntaficha" class="dropdown-item">Preguntas Ficha</a>
              </div>
            </li>
            <!--/FORMULARIO -->

            <!--PERSONA FICHA-->
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle text-light" data-toggle="dropdown">Personas Ficha </a>
              <div class="dropdown-menu">
                <a href="<?php echo constant('URL'); ?>personaficha" class="dropdown-item">Listar</a>
                <a href="<?php echo constant('URL'); ?>personaficha/guardarpersona" class="dropdown-item">Ingresar</a>
              </div>
            </li>
            <!--/PERSONA FICHA-->

            <!--GRUPO SOCIOECONOMICO-->
              <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle text-light" data-toggle="dropdown">Grupo Socioeconomico </a>
                <div class="dropdown-menu">
                  <a href="<?php echo constant('URL'); ?>gruposocioeconomico" class="dropdown-item">Listar</a>
                  <a href="<?php echo constant('URL'); ?>gruposocioeconomico/guardar" class="dropdown-item">Ingresar</a>
                </div>
              </li>
              <!--/GRUPO SOCIOECONOMICO-->

              <!--PERMISO INGRESO-->
              <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle text-light" data-toggle="dropdown">Permiso Ingreso</a>
                <div class="dropdown-menu">
                  <a href="<?php echo constant('URL'); ?>permisoficha" class="dropdown-item">Listar</a>
                  <a href="<?php echo constant('URL'); ?>permisoficha/guardar" class="dropdown-item">Ingresar</a>
                </div>
              </li>
              <!--/PERMISO INGRESO-->

              <!--TIPO FICHA-->
              <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle text-light" data-toggle="dropdown">Tipo ficha </a>
                <div class="dropdown-menu">
                  <a href="<?php echo constant('URL'); ?>tipoficha" class="dropdown-item">Listar</a>
                  <a href="<?php echo constant('URL'); ?>tipoficha/guardar" class="dropdown-item">Ingresar</a>
                </div>
              </li>
              <!--/TIPO FICHA-->

              <li class="nav-item">
                  <a href="<?php echo constant('URL'); ?>permisoingreso" class="nav-link text-light">Fichas</a>
              </li>

              <form class="form-inline ml-lg-2"
              action="<?php echo constant('URL'); ?>login/salir"
              method="post">
              <button type="submit" name="salir"
              class="btn btn-small rounded-pill bg-danger">
                Salir
              </button>
              </form>
          </ul>
      </div>
    </nav>
  </div>

</div>

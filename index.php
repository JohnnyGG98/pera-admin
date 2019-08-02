<?php
  require_once 'config/config.php';
  require_once 'src/utils/dctr.php';
  require_once 'src/utils/controlador.php';
  require_once 'src/utils/error.php';
  require_once 'src/utils/bd.php';
  require_once 'src/controlador/main.php';
  //Cargamos el usuario
  //Debemos cargar la clase para que la reconosca como un objeto y podamos cargar bien sus atributos
  require_once 'src/modelo/usuario/usuario.php';
  require_once 'src/modelo/clases/personamd.php';
  $usuario = new UsuarioMD();

  //Preguntamos si tenemos el usuario para cargarlo
  if(isset($_COOKIE['usuario'])){
    $usuario = unserialize($_COOKIE['usuario']);
  } else {
    $usuario = null;
  }

  $M = new Main();
  $M->obtenerUrl();
 ?>

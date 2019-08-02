<?php

class Main {
  function __construct(){
  }

  function obtenerUrl(){
    $url = isset($_GET['url']) ? $_GET['url']: NULL;

    if($url != null){
      $url = rtrim($url, '/');
      $url = explode('/', $url);

      if(isset($url[0])){
        $this->cargarClase($url);
      }

    }else{
      //require 'src/vista/static/login.php';
      require 'src/vista/static/home.php';
      //echo "<h1>No tenemos url</h1>";
    }
  }

  function cargarClase($url){
    $nombre = $url[0];

    $dir = 'src/controlador/'.$nombre.'/'.$nombre.'.php';
    if(file_exists($dir)){
      require_once $dir;
      $nombre = $nombre . 'CTR';
      $modelo = new $nombre();

      if(isset($url[1])){
        $this->llamarMetodo($url, $modelo);
      }else{
        $modelo->inicio();
      }
    }else{
        Errores::error404();
        echo "<h1>No pudimos obtener la clase</h1>";
        //header("Location: ".constant('URL'));
    }

  }

  function llamarMetodo($url, $modelo){
    $metodo = $url[1];

    if(isset($url[2])){
      $this->llamarMetodoConParametro($url, $modelo);
    }else{
      try{
        $modelo->{$metodo}();
      }catch(\Exception $e){
        echo "<h1>No pudimos enontrar el metodo </h1>".$e->getMessage();
      }
    }

  }

  function llamarMetodoConParametro($url, $modelo){
    $metodo = $url[1];
    $parametro = $url[2];
    //Preguntamos si existe mas de un parametro
    if (strpos($parametro, '-') !== false) {
      $parametro = explode('-', $parametro);
      //var_dump($parametro);
      $modelo->{$metodo}($parametro);
    }else{
      $modelo->{$metodo}($parametro);
    }
  }
}

 ?>
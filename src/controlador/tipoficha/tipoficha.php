<?php
require_once 'src/modelo/tipoficha/tipofichabd.php';

class TipoFichaCTR extends CTR implements DCTR {

  function __construct(){
    parent::__construct("src/vista/tipoficha/");
  }

  function inicio($mensaje = null){
    $tiposfichas = TipoFichaBD::getAll();
    include $this->cargarVista('index.php');
  }

  function guardar() {
    $tf = $this->tipoFichaFromPOST();
    if($tf == null){
      include $this->cargarVista('guardar.php');
    } else {
      $res = TipoFichaBD::guardar($tf);
      $mensaje = $res ? 'Guardamos correctamente.' : 'No pudimos guardarlo.';
      $this->inicio($mensaje);
    }
  }

  function editar() {
    if(isset($_GET['editar'])){
      $tf = TipoFichaBD::getPorId($_GET['editar']);
      include $this->cargarVista('editar.php');
    } else {
      $tf = $this->tipoFichaFromPOST();

      if ($tf != null) {
        $tf->id = isset($_POST['id']) ? $_POST['id'] : 0;

        $res = TipoFichaBD::editar($tf);

        $mensaje = $res ? 'Editamos correctamente.' : 'No pudimos editarlo.';
        $this->inicio($mensaje);
      } else {
        $this->inicio('No tenemos el tipo de ficha para editarlo');
      }

    }
  }

  private function tipoFichaFromPOST() {
    if(
      isset($_POST['nombreficha']) &&
      isset($_POST['descripcionficha'])
    ){
      // No este nulo y que no este con codigo malisioso
      $tipo = $_POST['nombreficha'];
      $des = $_POST['descripcionficha'];
      if($tipo != '' && $des != ''){

        $tf = [
          'tipo_ficha' => $tipo,
          'tipo_ficha_descripcion' => $des
        ];
        return $tf;
        /*
        $tf = new TipoFichaMD();
        $tf->tipoFicha = $tipo;
        $tf->descripcion = $des;
        return $tf;*/
      }
    }
  }

}

 ?>

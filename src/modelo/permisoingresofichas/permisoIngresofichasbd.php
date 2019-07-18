<?php
require './utils.php';
require_once("permisoingresofichasmd.php");
class PermisoIngresoFichasBD extends PermisoIngresoFichasMD
{ 
    function __construct()
    {
       echo "Ejecutando clase permisoIngresoFichasBD";
    }

    function guardarPermisoIngresoFichas(){
    $sql = '
    INSERT INTO public."PermisoIngresoFichas"(
    id_prd_lectivo, id_tipo_ficha, permiso_ingreso_fecha_inicio, permiso_ingreso_fecha_fin)
    VALUES (:idPeriodo, :idTipoFicha, :fechaInicio, :fechaFin);
    ';

    $ct = getCon();
    if($ct != null){
      $sentencia = $ct->prepare($sql);
      $res = $sentencia->execute([
        'idPeriodo' => 5,
        'idTipoFicha' => 1,
        'fechaInicio' => '27/5/2019',
        'fechaFin' => '27/12/2019'
      ]);
      if($res != null){
          echo "<h1>Guardamos correctamente</h1>";
      }
    }
  }

  function eliminarPermisoIngresoFichas($id){
    $sql='
    UPDATE public."PermisoIngresoFichas"
  SET permiso_ingreso_activo=false
  WHERE id_permiso_ingreso_ficha=:id;';

    $ct = getCon();
    if($ct != null){
      $sentencia = $ct->prepare($sql);
      $res = $sentencia->execute([
        'id' => $id
      ]);
      if($res != null){
          echo "<h1>Eliminamos correctamente</h1>";
      }
    }
  }

  function editarPermisoIngresoFichas($id){
  $sql='
  UPDATE public."PermisoIngresoFichas"
  SET id_prd_lectivo=:idPeriodo, id_tipo_ficha=:idTipoFicha, 
  permiso_ingreso_fecha_inicio=:fechaInicio, permiso_ingreso_fecha_fin=:fechaFin
  WHERE id_permiso_ingreso_ficha=:id;';

  $ct = getCon();
    if($ct != null){
      $sentencia = $ct->prepare($sql);
      $res = $sentencia->execute([
        'id' => $id,
        'idPeriodo' => 3,
        'idTipoFicha' => 2,
        'fechaInicio' => '27/5/2022',
        'fechaFin' => '27/12/2022'
      ]);
      if($res != null){
          echo "<h1>Editamos correctamente</h1>";
      }
    }
  }
  function buscarPermisoIngresoFichas(){
  $sql='
  SELECT p.prd_lectivo_nombre,tF.tipo_ficha, pF.permiso_ingreso_fecha_inicio, pF.permiso_ingreso_fecha_fin
  FROM public."PermisoIngresoFichas" pF, public."PeriodoLectivo" p,public."TipoFicha" tF
    WHERE pF.id_prd_lectivo=p.id_prd_lectivo
    AND pF.id_tipo_ficha=tF.id_tipo_ficha
    AND pF.permiso_ingreso_activo=true;';

    $ct = getCon();
      if($ct != null){
        $sentencia = $ct->prepare($sql);
        $res = $sentencia->execute([

        ]);
        if($res != null){
          echo "<h1>Buscamos correctamente</h1>"; 
        var_dump($res);
      }
    }
  }
}

//$ejecucion= new permisoIngresoFichasBD;
//$ejecucion->guardar(); //para pruebas funcionales*/
?>

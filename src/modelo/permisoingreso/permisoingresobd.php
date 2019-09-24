<?php
require_once("src/modelo/permisoingreso/permisoingreso.php");
require_once("src/modelo/tipoficha/tipofichamd.php");
require_once("src/modelo/clases/periodolectivomd.php");

abstract class PermisoIngresoBD {

  static function guardar($permisoIngreso) {
    return execute(self::$INSERT, [
      'idPeriodo' => $permisoIngreso->idPeriodo,
      'idTipoFicha' => $permisoIngreso->idTipoFicha,
      'fechaInicio' => $permisoIngreso->fechaInicio,
      'fechaFin' => $permisoIngreso->fechaFin
    ]);
  }

  static function editar($permisoIngreso) {
    return execute(self::$UPDATE, [
      'id' => $permisoIngreso->id,
      'idPeriodo' => $permisoIngreso->idPeriodo,
      'idTipoFicha' => $permisoIngreso->idTipoFicha,
      'fechaInicio' => $permisoIngreso->fechaInicio,
      'fechaFin' => $permisoIngreso->fechaFin
    ]);
  }


  static function eliminar($id) {
    return execute(self::$DELETE, [
      'id' => $id
    ]);
  }

  static function getPorId($id){
    $sql = '
    SELECT
    id_permiso_ingreso_ficha,
    p.id_prd_lectivo,
    tF.id_tipo_ficha,
    pF.permiso_ingreso_fecha_inicio,
    pF.permiso_ingreso_fecha_fin
    FROM public."PermisoIngresoFichas" pF, public."PeriodoLectivo" p,public."TipoFicha" tF
    WHERE pF.id_prd_lectivo=p.id_prd_lectivo
    AND pF.id_tipo_ficha=tF.id_tipo_ficha
    AND pF.permiso_ingreso_activo=true
    AND id_permiso_ingreso_ficha = :id;';

    $res = getRes($sql, [
      'id' => $id
    ]);
    if ($res != null) {
      $pi = new PermisoIngresoMD();
      while($r = $res->fetch(PDO::FETCH_ASSOC)){
        $pi->id = $r['id_permiso_ingreso_ficha'];
        $pi->idPeriodo = $r['id_prd_lectivo'];
        $pi->idTipoFicha = $r['id_tipo_ficha'];
        $pi->fechaInicio = $r['permiso_ingreso_fecha_inicio'];
        $pi->fechaFin = $r['permiso_ingreso_fecha_fin'];
      }
      return $pi;
    }
  }

  static function getAll() {
    $sql = self::$BASEQUERY.' '.self::$ENDQUERY;

    $res = getRes($sql, []);
    if ($res != null) {
      return self::obtenerParaTbl($res);
    }else{
      return [];
    }
  }

  static function getPorPeriodo($idPeriodo){
    $sql = self::$BASEQUERY."
    AND pl.id_prd_lectivo = :idPeriodo "
    .self::$ENDQUERY;

    $res = getRes($sql, []);
    if ($res != null) {
      return self::obtenerParaTbl($res);
    }else{
      return [];
    }
  }

  static function getPorTipoFicha($idTipoFicha){
    $sql = self::$BASEQUERY . "
    AND tf.id_tipo_ficha = :idTipoFicha "
    . self::$ENDQUERY;
    $res = getRes($sql, [
      'idTipoFicha' => $idTipoFicha
    ]);
    if ($res != null) {
      return self::obtenerParaTbl($res);
    }else{
      return [];
    }
  }

    static function buscar($aguja){
      $sql = self::$BASEQUERY."
      AND pl.prd_lectivo_nombre ILIKE :aguja " .self::$ENDQUERY;

      $res = getRes($sql, [
        'aguja' => '%'.$aguja.'%'
      ]);
      if ($res != null) {
        return self::obtenerParaTbl($res);
      }else{
        return [];
      }
    }

    private static function obtenerParaTbl($res){
      $items = array();
      while($r = $res->fetch(PDO::FETCH_ASSOC)){
        //var_dump($r);
        $pi = new PermisoIngresoMD();
        $tf = new TipoFichaMD();
        $pe = new PeriodoLectivoMD();
        $pi->id = $r['id_permiso_ingreso_ficha'];
        $pi->idPeriodo = $r['id_prd_lectivo'];
        $pi->idTipoFicha = $r['tipo_ficha'];
        $pi->fechaInicio = $r['permiso_ingreso_fecha_inicio'];
        $pi->fechaFin = $r['permiso_ingreso_fecha_fin'];
        $tf->tipoFicha = $r['tipo_ficha'];
        $pi->tipoFicha = $tf;
        $pe->nombre = $r['prd_lectivo_nombre'];
        $pi->periodo = $pe;
        array_push($items, $pi);
      }
      return $items;
    }

    public static $BASEQUERY = '
    SELECT
    id_permiso_ingreso_ficha,
    pl.prd_lectivo_nombre,
    tf.tipo_ficha,
    pf.permiso_ingreso_fecha_inicio,
    pf.permiso_ingreso_fecha_fin,
    tf.tipo_ficha,
    pl.id_prd_lectivo
    FROM
    public."PermisoIngresoFichas" pf,
    public."PeriodoLectivo" pl,
    public."TipoFicha" tf
    WHERE pf.id_prd_lectivo = pl.id_prd_lectivo
    AND pf.id_tipo_ficha = tf.id_tipo_ficha
    AND pf.permiso_ingreso_activo = true
    ';

    public static $ENDQUERY = '
    ORDER BY
    pf.permiso_ingreso_fecha_fin DESC,
    pl.prd_lectivo_nombre;';

    public static $INSERT = '
    INSERT INTO public."PermisoIngresoFichas"(
      id_prd_lectivo, id_tipo_ficha, permiso_ingreso_fecha_inicio, permiso_ingreso_fecha_fin)
    VALUES(:idPeriodo, :idTipoFicha, :fechaInicio, :fechaFin)';

    public static $UPDATE = '
    UPDATE public."PermisoIngresoFichas"
    SET id_prd_lectivo = :idPeriodo,
    id_tipo_ficha = :idTipoFicha,
    permiso_ingreso_fecha_inicio = :fechaInicio,
    permiso_ingreso_fecha_fin = :fechaFin
    WHERE id_permiso_ingreso_ficha = :id;';

    public static $DELETE = '
    UPDATE public."PermisoIngresoFichas"
    SET permiso_ingreso_activo = false
    WHERE id_permiso_ingreso_ficha= :id;
    ';
}

?>

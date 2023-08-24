<?php
require_once 'conexion.php';

class Colaborador extends Conexion{
  private $access;
  public function __CONSTRUCT(){
    $this->access = parent::getConexion();
  }

  public function agregar($data = []){
    try{
      $query = $this->access->prepare("CALL spu_colaboradores_registrar(?,?,?,?,?)");
      $query->execute(
        array(
          $data['apellidos'],
          $data['nombres'],
          $data['telefono'],
          $data['email'],
          $data['direccion']
        )
      );
    } catch(Exception $e) {
      die($e->getMessage());
    }
  }

  public function listar() {
    try{
      $query = $this->access->prepare("CALL spu_colaboradores_listar()");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function eliminar($data = []) {
    try {
      $query = $this->access->prepare("CALL spu_colaboradores_eliminar(?)");
      $query->execute(
        array(
          $data['idcolaborador']
        )
      );
    } catch(Exception $e){
      die($e->getCode());
    }
  }

  public function obtenerDatos($data = []) {
    try {
      $query = $this->access->prepare("CALL spu_colaboradores_getdata(?)");
      $query->execute(
        array(
          $data['idcolaborador']
        )
      );
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch(Exception $e){
      die($e->getCode());
    }
  }

  public function actualizar($data = []) {
    try {
      $query = $this->access->prepare("CALL spu_colaboradores_update(?,?,?,?,?,?)");
      $query->execute(
        array(
          $data['idcolaborador'],
          $data['apellidos'],
          $data['nombres'],
          $data['telefono'],
          $data['email'],
          $data['direccion']
        )
      );
    } catch(Exception $e){
      die($e->getCode());
    }
  }
}

?>
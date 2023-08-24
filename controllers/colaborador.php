<?php 
require_once '../models/colaborador.php';
$colaborador = new Colaborador();

if (isset($_POST['operacion'])){
  if($_POST['operacion'] == 'agregar') {
    $registro = [
      "apellidos" => $_POST['apellidos'],
      "nombres" => $_POST['nombres'],
      "telefono" => $_POST['telefono'],
      "email" => $_POST['email'],
      "direccion" => $_POST['direccion']
    ];
    $colaborador->agregar($registro);
  }

  //eliminar
  if($_POST['operacion'] == 'eliminar') {
    $colaborador->delete(
      [
        'idcolaborador' => $_POST['idcolaborador']
      ]
    );
  }

  //actualizar
  if($_POST['operacion'] == 'actualizar'){
    $registro = [
      "idcolaborador" => $_POST['idcolaborador'],
      "apellidos" => $_POST['apellidos'],
      "nombres" => $_POST['nombres'],
      "telefono" => $_POST['telefono'],
      "email" => $_POST['email'],
      "direccion" => $_POST['direccion']
    ];
    $colaborador->actualizar($registro);
  }
}
  //listar
  if(isset($_GET['operacion'])){
    if($_GET['operacion'] == 'listar') {
      echo json_encode($colaborador->listar());
    }

    //buscar
    if ($_GET['operacion'] == 'obtenerDatos'){
      echo json_encode($colaborador->obtenerDatos(["idcolaborador" => $_GET['idcolaborador']]));
    }
  }

?>
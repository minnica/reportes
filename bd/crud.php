<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$peso_unitario = (isset($_POST['peso_unitario'])) ? $_POST['peso_unitario'] : '';
$modulo = (isset($_POST['modulo'])) ? $_POST['modulo'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_tabla = (isset($_POST['id_tabla'])) ? $_POST['id_tabla'] : '';

switch($opcion){
    case 1:    
    $consulta = "SELECT modulo, SUM(peso_unitario) AS peso_unitario FROM tabla GROUP BY modulo";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();        
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    break;
}


print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;
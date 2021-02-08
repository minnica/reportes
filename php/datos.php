<?php
// Seteamos la cabecera a JSON
header('Content-Type: application/json');

// Configuramos la conexión a la base de datos
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'gilbertm_prueba');

// Desplegamos la conexión a la Basde de Datos
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

$mysqli->query("SET NAMES 'utf8'");

if(!$mysqli){
	die("La Conexión ha fallado: " . $mysqli->error);
}

// Seleccionamos los datos de la tabla postres
//$query = sprintf("SELECT fecha, SUM(montaje) as montaje FROM tabla1 GROUP BY fecha");
$query = "SELECT Date_format(fecha_montaje,'%d %b %Y') as fecha, TRUNCATE(SUM(peso_unitario),2) as montaje FROM tabla WHERE montaje='SI' GROUP BY fecha ASC ORDER BY fecha_montaje ASC";






$result = $mysqli->query($query);




// Hacemos un bucle con los datos obntenidos
$data = array();
foreach ($result as $row) {
	$data[] = $row;}


// Limpiamos memoria consumida al extraer los datos
$result->close();
//$result2->close();

// Cerramos la conexión a la Base de Datos
$mysqli->close();

// Mostramos los datos en formato JSON
print json_encode($data);



//var_dump($data);

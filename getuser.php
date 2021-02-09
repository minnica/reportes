<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = strval($_GET['q']);

$con = mysqli_connect('localhost','root','','gilbertm_prueba');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"gilbertm_prueba");
$sql="SELECT modulo, Date_format(fecha_montaje,'%d/%m/%Y') as fecha, FORMAT(sum(peso_unitario),2) AS peso from tabla WHERE modulo = '".$q."' AND montaje= 'SI' GROUP BY fecha DESC ORDER BY fecha_montaje DESC";
$result = mysqli_query($con,$sql);

echo "<table class='table table-bordered table-sm shadow h-60 text-center'>
<tr>
<th>MÓDULO</th>
<th>FECHA</th>
<th>PESO TOTAL</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['modulo'] . "</td>";
  echo "<td>" . $row['fecha'] . "</td>";
  echo "<td>" . $row['peso'] . "</td>";
  echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>
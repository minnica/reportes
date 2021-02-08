<?php    
$link = new PDO('mysql:host=localhost;dbname=gilbertm_prueba', 'root', ''); 
$conexion=mysqli_connect('localhost','root','','gilbertm_prueba');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REPORTES</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="main.js"></script>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-md bg-light navbar-light">
        <a class="navbar-brand" href="#">Grupo <span class="text-danger">G</span>ilbert&#174;</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../../areas.php">MENÚ ÁREAS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">MENÚ MÓDULOS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="../../logout.php">CERRAR SESIÓN</a>
                </li>
            </ul>
        </div>
    </nav>
    <header align="center">
        <h4 class="text-dark">R E P O R T E S</h4>
    </header>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                <p align="center">REPORTE MONTAJE DIARIO</p>
                <div class="card border-left-primary shadow h-60 bg-success text-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <?php foreach ($link->query('SELECT IFNULL(format(sum(peso_unitario),2),0) AS peso from tabla WHERE montaje= "SI" AND  DATE(fecha_montaje)= DATE(CURDATE())') as $row){ ?>
                                    <div class="h5 mb-1 font-weight-bold text-gray-800"><?php echo $row['peso'] ?> KG.</div>
                                <?php }?>
                                <?php foreach ($link->query('SELECT Date_format(now(),"%d/%m/%Y") as hoy;') as $row){ ?> 
                                    <div class="text-light"><strong><?php echo $row['hoy'] ?></strong></div>   		
                                <?php }?>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-hard-hat fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <p align="center">REPORTE SEMANA ACTUAL</p>
                <div class="card border-left-success shadow h-60 bg-light">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <?php foreach ($link->query('SELECT IFNULL (FORMAT(SUM(peso_unitario),2),0) AS montaje FROM tabla WHERE montaje="SI" AND fecha_montaje BETWEEN DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) DAY) AND DATE_ADD(DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) DAY),INTERVAL 6 DAY)') as $row){ ?> 
                                    <div class="h5 mb-1 font-weight-bold text-gray-800"><?php echo $row['montaje'] ?> KG.</div>
                                <?php }?>
                                <?php foreach ($link->query('SELECT CURDATE() as hoy, DATE_FORMAT(DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) DAY),"%d/%m/%Y") as primero, DATE_FORMAT(DATE_ADD(DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) DAY),INTERVAL 6 DAY),"%d/%m/%Y") as ultimo') as $row){ ?>
                                    <div class="text-secondary"><strong><?php echo $row['primero'] ?></strong> al <strong><?php echo $row['ultimo'] ?></strong></div> 
                                <?php }?>   							
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-truck-loading fa-3x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <p align="center">REPORTE SEMANAL ANTERIOR</p>
                <div class="card border-left-success shadow h-60 bg-light">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <?php foreach ($link->query('SELECT IFNULL (FORMAT(SUM(peso_unitario),2),0) AS suma FROM tabla WHERE fecha_montaje BETWEEN DATE_SUB(DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) DAY),INTERVAL 7 DAY) AND DATE_SUB(DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) DAY),INTERVAL 1 DAY)') as $row){ ?>
                                    <div class="h5 mb-1 font-weight-bold text-gray-800"><?php echo $row['suma'] ?> KG.</div>
                                <?php }?>
                                <?php foreach ($link->query('SELECT DATE_FORMAT(DATE_SUB(DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) DAY),INTERVAL 7 DAY),"%d/%m/%Y") as InicioSemanaAnterior, DATE_FORMAT(DATE_SUB(DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) DAY),INTERVAL 1 DAY),"%d/%m/%Y") as FinSemanaAnterior, CURDATE() as hoy') as $row){ ?>
                                    <div class="text-secondary"><strong><?php echo $row['InicioSemanaAnterior'] ?></strong> al  <strong><?php echo $row['FinSemanaAnterior'] ?></strong></div>
                                <?php }?>
                            </div>
                            <div class="col-auto">
                                <i class="fad fa-traffic-cone fa-3x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>      
        <div class="row justify-content-md-center">
            <div class="col-xl-12 col-md-12">
                <p align="center">GRÁFICA MONTAJE DIARIO</p>
                <div class="card shadow h-60 bg-light">
                    <div class="card-body">
                        <canvas id="miGrafico3"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-xl-4 col-md-6 mb-4 mt-3">
                <p align="center">MONTAJE DIARIO POR PROYECTO</p>
                <table class="table table-bordered table-sm shadow h-60 text-center">
                    <thead>
                        <th>MÓDULO</th>
                        <th>FECHA</th>
                        <th>PESO TOTAL</th>
                    </thead>
                    <tbody>
                        <?php foreach ($link->query("SELECT modulo, Date_format(curdate(),'%d/%m/%Y') AS fecha, FORMAT(sum(peso_unitario),2) AS peso from tabla WHERE montaje= 'SI' AND  DATE(fecha_montaje)= DATE(CURDATE()) GROUP BY modulo") as $row){ ?> 
                            <tr>
                                <td><?php echo $row['modulo'] ?></td>
                                <td><?php echo $row['fecha'] ?></td>
                                <td><span class=""><?php echo $row['peso']?></span></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-xl-2 col-md-2">
            </div>
            <div class="col-xl-4 col-md-6 mb-4 mt-3">
                <p align="center">HISTORIAL DE MONTAJE</p>
                <form>
                    <select name="users" class="form-control" onchange="showUser(this.value)">
                        <option value="">Seleccione un modulo</option>
                        <?php 
                        $sql = "SELECT DISTINCT(modulo) as modulo FROM tabla";
                        $query = $conexion -> query ($sql);
                        while($valores = mysqli_fetch_array($query)){
                            echo "<option value='".$valores['modulo']."'>".$valores['modulo']."</option>";
                        }
                        ?>
                    </select>
                </form>
                <div id="txtHint"><b>Seleccione el módulo para visualizar el historial</b></div>
            </div>
        </div>
    </div>

    

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script> 
    <script type="text/javascript" src="js/datos.js"></script>
</body>
</html>
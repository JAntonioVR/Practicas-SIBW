<?php

include("modelo.php");

$database = new Database();

if(isset($_POST['consulta'])){
    $database->consultarEvento($_POST['consulta']);
}

if(isset($_GET['nombre'])){
    $database->consultarEvento($_GET['nombre']);
}


?>
<?php

include("modelo.php");

$database = new Database();

$database->insertarUsuario("Gestor", "JAGestor", "juan@gmail.com", "sibw", "gestor");


?>
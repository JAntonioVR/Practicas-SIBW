<?php

include("modelo.php");

$database = new Database();

//$res = $database->checkLogin("JAntonio","peasoclave");

$database->insertarUsuario("Gestor", "JAGestor", "juan@gmail.com", "sibw", "gestor");

/*if($res === TRUE){
    echo "Se encontró";
}
else{
    echo "ERROR";
}*/

?>
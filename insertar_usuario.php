<?php

include("modelo.php");

$database = new Database();

//$res = $database->checkLogin("JAntonio","peasoclave");

$database->insertarUsuario("Moderador", "JAModerador", "juan@gmail.com", "sibw", "moderador");

/*if($res === TRUE){
    echo "Se encontró";
}
else{
    echo "ERROR";
}*/

?>
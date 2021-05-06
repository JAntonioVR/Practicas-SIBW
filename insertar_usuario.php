<?php

include("modelo.php");

$database = new Database();

//$res = $database->checkLogin("JAntonio","peasoclave");

$database->insertarUsuario("JAntonioVR", "Juan", "juan@gmail.com", "sibw", "super");

/*if($res === TRUE){
    echo "Se encontró";
}
else{
    echo "ERROR";
}*/

?>
<?php

include("modelo.php");

$database = new Database();

$res = $database->checkLogin("JAntonio","peasoclave");

//insertarUsuario("JAntonio", "Juan", "juan@gmail.com", "peasoclave", "super");

if($res === TRUE){
    echo "Se encontró";
}
else{
    echo "ERROR";
}

?>
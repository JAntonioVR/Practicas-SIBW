<?php
    include("modelo.php");

    session_start();

    if(isset($_GET['cm']) and is_numeric($_GET['cm']) ){
        $idComentario = $_GET['cm'];
    }
    else $idComentario = -1;

    $database = new Database();
    $database->borraComentario($idComentario);

    header("Location: index.php");
        
    exit();

?>
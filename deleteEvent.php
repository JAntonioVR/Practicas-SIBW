<?php
    include("modelo.php");

    session_start();

    if(isset($_GET['ev']) and is_numeric($_GET['ev']) ){
        $idEvento = $_GET['ev'];
    }
    else $idEvento = -1;

    $database = new Database();
    $database->borraEvento($idEvento);

    header("Location: index.php");
        
    exit();

?>
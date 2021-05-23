<?php

//
// ────────────────────────────────────────────────────────────────────────────────────
//   :::::: A Ñ A D I R   C O M E N T A R I O : :  :   :    :     :        :          :
// ────────────────────────────────────────────────────────────────────────────────────
//

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    $database = new Database();

    session_start();

    if(isset($_GET['ev']) and is_numeric($_GET['ev']) ){
        $idEvento = $_GET['ev'];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $autor = $_POST['autor'];
        $email_autor   = $_POST['email_autor'];
        $texto    = $_POST['texto'];

        $database->addComentario($autor, $email_autor, $texto, $idEvento);
    }
    
    header("Location: evento.php?ev=".$idEvento);
    
    exit();
    



?>
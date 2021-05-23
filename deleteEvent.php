<?php

//
// ────────────────────────────────────────────────────────────────────────────────
//   :::::: E L I M I N A R   E V E N T O : :  :   :    :     :        :          :
// ────────────────────────────────────────────────────────────────────────────────
//

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    session_start();
    $varsParaTwig = [];
    $varsParaTwig['whatis'] = "Evento";
    $errores = array();

    if(isset($_GET['ev']) and is_numeric($_GET['ev']) ){
        $idEvento = $_GET['ev'];
        $database = new Database();
        if($database->borraEvento($idEvento))
            $varsParaTwig['exito'] = 1;
        else{
            $varsParaTwig['exito'] = -1;
            $errores[] = "No se encontró ningún evento para eliminar. ";
        }
    }


    $varsParaTwig['errores'] = $errores;

    echo $twig->render('./delete.html', $varsParaTwig);

?>
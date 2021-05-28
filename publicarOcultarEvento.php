<?php

//
// ────────────────────────────────────────────────────────────────────────────────────────────────────
//   :::::: P U B L I C A R   U   O C U L T A R   E V E N T O : :  :   :    :     :        :          :
// ────────────────────────────────────────────────────────────────────────────────────────────────────
//


    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    $database = new Database();

    session_start();

    $varsParaTwig = [];
    $varsParaTwig['exito'] = 0; 
    $errores = array();

    if(isset($_GET['ev']) and is_numeric($_GET['ev']) ){
        $idEvento = $_GET['ev'];
        if(isset($_GET['publicar']) and is_numeric($_GET['publicar']) ){
            $publicar = $_GET['publicar'];

            if($publicar)
                $res = $database->publicarEvento($idEvento);
            else
                $res = $database->ocultarEvento($idEvento);

            if($res)
                $varsParaTwig['exito'] = 1;
            else{
                $varsParaTwig['exito'] = -1;
                $errores[] = "Algo salió mal al publicar u ocultar el evento";
            }
        }
        else{
            $varsParaTwig['exito'] = -1;
            $errores[] = "No se ha especificado si se quiere publicar u ocultar el evento";
        }

    }
    else{
        $varsParaTwig['exito'] = -1;
        $errores[] = "No se ha encontrado ningún evento que publicar";
    }

    $varsParaTwig['errores'] = $errores;

    echo $twig->render('publicarEvento.html',$varsParaTwig);

?>
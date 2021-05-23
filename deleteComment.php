<?php

//
// ────────────────────────────────────────────────────────────────────────────────────────
//   :::::: E L I M I N A R   C O M E N T A R I O : :  :   :    :     :        :          :
// ────────────────────────────────────────────────────────────────────────────────────────
//

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    session_start();
    $varsParaTwig = [];
    $varsParaTwig['whatis'] = "Comentario";
    $errores = array();

    if(isset($_GET['cm']) and is_numeric($_GET['cm']) ){

        $idComentario = $_GET['cm'];
        $database = new Database();
        if($database->borraComentario($idComentario))
            $varsParaTwig['exito'] = 1;
        else{
            $varsParaTwig['exito'] = -1;
            $errores[] = "Error al eliminar el comentario";
        }

    }
    else{
        $varsParaTwig['exito'] = -1;
        $errores[] = "No se encontró ningún comentario para eliminar. ";
    }

    $varsParaTwig['errores'] = $errores;
    
    echo $twig->render('delete.html', $varsParaTwig);

?>
<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    session_start();
    $varsParaTwig = [];
    $varsParaTwig['whatis'] = "Comentario";

    if(isset($_GET['cm']) and is_numeric($_GET['cm']) ){

        $idComentario = $_GET['cm'];
        $database = new Database();
        if($database->borraComentario($idComentario))
            $varsParaTwig['exito'] = 1;
        else{
            $varsParaTwig['exito'] = -1;
            $varsParaTwig['error'] = "Error al eliminar el comentario";
        }

    }
    else{
        $varsParaTwig['exito'] = -1;
        $varsParaTwig['error'] = "No se encontró ningún comentario para eliminar. ";
    }

    echo $twig->render('delete.html', $varsParaTwig);

?>
<?php

//
// ──────────────────────────────────────────────────────────────────────────────────────────
//   :::::: M O D I F I C A R   C O M E N T A R I O : :  :   :    :     :        :          :
// ──────────────────────────────────────────────────────────────────────────────────────────
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

    if(isset($_GET['cm']) and is_numeric($_GET['cm']) ){

        $idComentario = $_GET['cm'];
        $varsParaTwig["link"] = "./modifyComment.php?cm=" . $idComentario;
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nuevoComentario = $_POST['nuevoComentario'];
            
        
            if($database->modificaComentario($idComentario, $nuevoComentario))
                $varsParaTwig['exito'] = 1;
            else{
                $varsParaTwig['exito'] = -1;
                $errores[]  = "Error al modificar el comentario de id " . $idComentario;
            }
                
            
        }

        $comentario = $database->getComentario($idComentario);
        if($comentario != -1) $varsParaTwig['comentario'] = $comentario;
        else{
            $varsParaTwig['exito'] = -1;
            $errores[] = "No se ha encontrado el comentario de id " . $idComentario;
        } 
    }
        
    else{
        $varsParaTwig['exito'] = -1;
        $errores[] = "Id de comentario no especificado";
    }

    $varsParaTwig['errores'] = $errores;

    echo $twig->render('modifyComment.html',$varsParaTwig);


?>
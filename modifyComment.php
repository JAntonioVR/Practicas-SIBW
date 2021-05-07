<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    $database = new Database();

    session_start();

    if(isset($_GET['cm']) and is_numeric($_GET['cm']) ){
        $idComentario = $_GET['cm'];
    }

    

    $comentario = $database->getComentario($idComentario);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nuevoComentario = $_POST['nuevoComentario'];

        $id = $_POST['idComentario'];
      
        $database->modificaComentario($id, $nuevoComentario);
            
        header("Location: index.php");
        
        exit();
      }

    echo $twig->render('modifyComment.html',['comentario' => $comentario ]);


?>
<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    session_start();
    $varsParaTwig = [];
    $varsParaTwig['whatis'] = "Evento";

    if(isset($_GET['ev']) and is_numeric($_GET['ev']) ){
        $idEvento = $_GET['ev'];
        $database = new Database();
        if($database->borraEvento($idEvento))
            $varsParaTwig['exito'] = 1;
        else{
            $varsParaTwig['exito'] = -1;
            $varsParaTwig['error'] = "No se encontró ningún evento para eliminar. ";
        }
    }

echo $twig->render('./delete.html', $varsParaTwig);
        
    exit();

?>
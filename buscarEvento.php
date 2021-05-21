<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    $database = new Database();

    session_start();

    $varsParaTwig = [];
    $varsParaTwig['exito'] = 0;
    $errores = array();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['busqueda'])){
            $busqueda = $_POST['busqueda'];
            $eventos = $database->buscaEventos($busqueda);
            if($eventos != -1){
                $varsParaTwig['exito'] = 1;
                $varsParaTwig['eventos'] = $eventos;
            }
            else{
                $varsParaTwig['exito'] = -1;
                $errores[] = "Ha ocurrido algún error en la búsqueda";
            }
        }
        else{
            $varsParaTwig['exito'] = -1;
            $errores[] = "No se ha introducido ninguna palabra a buscar";
        }
    }

    $varsParaTwig['errores'] = $errores;
    echo $twig->render('buscarEventos.html',$varsParaTwig);

?>
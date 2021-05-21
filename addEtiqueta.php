<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    $database = new Database();

    session_start();

    $exito = 0;
    $errores = array();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idEvento  = $_POST['idEvento'];
        if(isset($_POST['etiquetasNuevas'])){
            $etiquetasNuevas = $_POST['etiquetasNuevas'];
            $res = $database->addEtiquetas($idEvento, $etiquetasNuevas);

            if($res) $exito = 1;
            else{
                $errores[] = "Error al añadir las etiquetas al evento";
                $exito = -1;  
            }                 
        }
    }

    echo $twig->render('addEtiqueta.html',['idEvento'=> $idEvento,
                                           'exito'   => $exito,
                                           'errores' => $errores ]);




?>
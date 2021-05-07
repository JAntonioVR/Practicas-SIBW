<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    $database = new Database();

    session_start();

    $varsParaTwig['exito'] = 0;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nickname = $_POST['nickname'];
        $nuevoTipo = $_POST['nuevoTipo'];
      
        $res = $database->modificaTipoUsuario($nickname, $nuevoTipo);
        if($res == TRUE){
            $varsParaTwig['exito'] = 1;
        }
        else{
            $varsParaTwig['exito'] = -1;
        }
            
        
      }

    echo $twig->render('cambiarPermisos.html', $varsParaTwig );


?>
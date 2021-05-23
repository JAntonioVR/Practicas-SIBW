<?php

//
// ────────────────────────────────────────────────────────────────────────────────────────────────────────
//   :::::: C A M B I A R   P E R M I S O S   D E   U S U A R I O : :  :   :    :     :        :          :
// ────────────────────────────────────────────────────────────────────────────────────────────────────────
//

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    $database = new Database();

    session_start();

    $varsParaTwig['exito'] = 0;
    $errores = array();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nickname = $_POST['nickname'];
        $nuevoTipo = $_POST['nuevoTipo'];
      
        $res = $database->modificaTipoUsuario($nickname, $nuevoTipo);
        
        if($res)
            $varsParaTwig['exito'] = 1;
        else{
            $varsParaTwig['exito'] = -1;
            $errores[] = "Ha habido algún error en la modificación";
        }
    }

    $varsParaTwig['errores'] = $errores;

    echo $twig->render('cambiarPermisos.html', $varsParaTwig );


?>
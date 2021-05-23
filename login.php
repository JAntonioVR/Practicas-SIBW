<?php

//
// ──────────────────────────────────────────────────────────────────────────────
//   :::::: I N I C I A R   S E S I Ó N : :  :   :    :     :        :          :
// ──────────────────────────────────────────────────────────────────────────────
//

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);
  
    require_once 'modelo.php';

    $database = new Database();
    $exito = 0;

    $varsParaTwig = [];
    $varsParaTwig['exito'] = 0;
    $errores = array();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nickname = $_POST['nickname'];
        $clave = $_POST['clave'];
        $res = $database->checkLogin($nickname, $clave);
        if ($res) {
            session_start();
            $_SESSION['nicknameUsuario'] = $nickname; 
            $varsParaTwig['exito'] = 1;
        }
        else{
            $varsParaTwig['exito'] = -1;
            $errores[] = "Error al iniciar sesión";
        }
            
    }

    $varsParaTwig['errores'] = $errores;
    
    echo $twig->render('login.html', $varsParaTwig);
?>
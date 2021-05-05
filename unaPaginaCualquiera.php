<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);
  
    require_once 'modelo.php';

    $database = new Database();
  
    $variablesParaTwig = [];
  
    session_start();
    
    if (isset($_SESSION['nicknameUsuario'])) {
        $variablesParaTwig['usuario'] = $database->getUsuario($_SESSION['nicknameUsuario']);
    }
    
    echo $twig->render('unaPaginaCualquiera.html', $variablesParaTwig);
?>
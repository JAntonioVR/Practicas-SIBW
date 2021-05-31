<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    $database = new Database();
    session_start();
    
    $pub = true;
    
    // En caso de que el usuario que ha iniciado sesión sea gestor o super se buscará
    // también entre los eventos no publicados
    if(isset($_SESSION['nicknameUsuario'])){
        $user = $database->getUsuario($_SESSION['nicknameUsuario']);
        if($user['tipo'] == 'gestor' or $user['tipo'] == 'super' )
            $pub = false;
    }

    // Busca en la BD los eventos que contengan cierta cadena y renderiza la lista
    if(isset($_POST['consulta'])){
        $eventos = $database->consultarEvento($_POST['consulta'], $pub);
        echo $twig->render("lista.html", ['eventos' => $eventos]);
    }
?>
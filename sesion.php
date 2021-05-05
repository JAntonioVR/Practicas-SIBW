<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    session_start();

    if(!isset($_SESSION['count'])){
        $_SESSION['count'] = 1;
    }
    else{
        $_SESSION['count']++;
    }

    echo $twig->render('contador.html', ["cuenta" => $_SESSION['count']]);


?>
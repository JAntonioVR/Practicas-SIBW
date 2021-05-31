<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    $database = new Database();

    if(isset($_POST['consulta'])){
        $eventos = $database->consultarEvento($_POST['consulta']);
        echo $twig->render("lista.html", ['eventos' => $eventos]);
    }


?>
<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    if(isset($_GET['ev'])){
        $idEv = $_GET['ev'];
    }
    else{
        $idEv = -1;
    }

    if(isset($_GET['imp'])){
        $imp = $_GET['imp'];
        if($imp == 1)
            $file = 'evento_imprimir.html';
        else
            $file = 'evento.html';
    }
    else{
        $file = 'evento.html';
    }

    $evento = getEvento($idEv);


    echo $twig->render($file,['evento' => $evento]);
?>
<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";


    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    echo $twig->render('portada.html',[]);
?>

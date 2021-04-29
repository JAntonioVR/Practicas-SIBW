<?php

//
// ──────────────────────────────────────────────────────────────────────────────────────────────
//   :::::: C O N T R O L A D O R   D E   E V E N T O S : :  :   :    :     :        :          :
// ──────────────────────────────────────────────────────────────────────────────────────────────
//

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    // Comprobación de la variable de evento
    if(isset($_GET['ev']) and is_numeric($_GET['ev']) ){
        $idEv = $_GET['ev'];
    }
    else{
        $idEv = -1;
    }

    // Renderizar archivo evento.html o evento_imprimir
    if(isset($_GET['imp']) and is_numeric($_GET['imp']) ){
        $imp = $_GET['imp'];
        if($imp == 1)
            $file = 'evento_imprimir.html';
        else
            $file = 'evento.html';
    }
    else{
        $file = 'evento.html';
    }

    // Conexión con la base de datos y obtención de datos
    $database = new Database();

    $evento              = $database->getEvento($idEv);
    $comentarios         = $database->getComentarios($idEv);
    $galeria             = $database->getGaleria($idEv);
    $enlacesInteres      = $database->getEnlacesDeInteres($idEv);
    $palabras_prohibidas = $database->getPalabrasProhibidas();
    
    // Renderiza el archivo
    echo $twig->render($file,['evento'              => $evento,
                              'comentarios'         => $comentarios,
                              'galeria'             => $galeria,
                              'enlaces'             => $enlacesInteres,
                              'palabras_prohibidas' => $palabras_prohibidas]);
?>
<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    require_once 'modelo.php';

    $database = new Database();

    session_start();
    $exito = 0;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nombreNuevo = $_POST['nombreNuevo'];
        $emailNuevo  = $_POST['emailNuevo'];
        $claveNueva = $_POST['claveNueva'];
      
        $res = $database->actualizaInformacion($_SESSION['nicknameUsuario'], $nombreNuevo, $emailNuevo, $claveNueva);

        if($res) $exito = 1;
        else $exito = -1;
            
    }

    if (isset($_SESSION['nicknameUsuario'])) {
        $usuario = $database->getUsuario($_SESSION['nicknameUsuario']);
        assert($usuario!=-1);
    }

    echo $twig->render('modifyUser.html',['usuario' => $usuario,
                                          'exito'   => $exito ]);


?>
<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    require_once 'modelo.php';

    $database = new Database();

    session_start();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nicknameNuevo = $_POST['nicknameNuevo'];
        $nombreNuevo = $_POST['nombreNuevo'];
        $emailNuevo  = $_POST['emailNuevo'];
        $claveNueva = $_POST['claveNueva'];
      
        if($database->actualizaInformacion($_SESSION['nicknameUsuario'], $nicknameNuevo, $nombreNuevo, $emailNuevo, $claveNueva)){
            //echo "BIEN";
        }
        //else echo "MAL";
        
        
        
        header("Location: index.php");
        
        exit();
      }

    if (isset($_SESSION['nicknameUsuario'])) {
        $usuario = $database->getUsuario($_SESSION['nicknameUsuario']);
    }

    echo $twig->render('modify.html',['usuario' => $usuario ]);


?>
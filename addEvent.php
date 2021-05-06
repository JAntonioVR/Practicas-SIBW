<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    $database = new Database();

    session_start();

    $logo = "./img/default.jpg";
    $imagenPrincipal = "./img/default-image.png";

    $varsParaTwig = [];
    $varsParaTwig['exito'] = 0;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errors= array();
        if(isset($_FILES['logo'])){
            $file_name = $_FILES['logo']['name'];
            $file_size = $_FILES['logo']['size'];
            $file_tmp = $_FILES['logo']['tmp_name'];
            $file_type = $_FILES['logo']['type'];
            $file_ext = strtolower(end(explode('.',$_FILES['logo']['name'])));
            
            $extensions= array("jpeg","jpg","png");
            
            if (in_array($file_ext, $extensions) === false){
                $errors[] = "Extensión no permitida, elige una imagen JPEG o PNG.";
            }
            
            if ($file_size > 2097152){
                $errors[] = 'Tamaño del fichero demasiado grande';
            }
            
            if (empty($errors)==true) {


                move_uploaded_file($file_tmp, "./img/" . $file_name);
              
                $logo = "./img/" . $file_name;
            }
        }
        if(isset($_FILES['imagenPrincipal'])){
            $file_name = $_FILES['imagenPrincipal']['name'];
            $file_size = $_FILES['imagenPrincipal']['size'];
            $file_tmp = $_FILES['imagenPrincipal']['tmp_name'];
            $file_type = $_FILES['imagenPrincipal']['type'];
            $file_ext = strtolower(end(explode('.',$_FILES['imagenPrincipal']['name'])));
            
            $extensions= array("jpeg","jpg","png");
            
            if (in_array($file_ext, $extensions) === false){
                $errors[] = "Extensión no permitida, elige una imagen JPEG o PNG.";
            }
            
            if ($file_size > 2097152){
                $errors[] = 'Tamaño del fichero demasiado grande';
            }
            
            if (empty($errors)==true) {
                
                move_uploaded_file($file_tmp, "./img/" . $file_name);
              
                $imagenPrincipal = "./img/" . $file_name;
            }
        }
        if (sizeof($errors) > 0) {
            $varsParaTwig['errores'] = $errors;
        }
        else{

            $nombre = $_POST['nombre'];
            $organizador = $_POST['organizador'];
            $fechaInicio = $_POST['fechaInicio'];
            $fechaFin = $_POST['fechaFin'];
            $lugar = $_POST['lugar'];
            $texto = $_POST['texto'];
            $web = $_POST['web'];
            $twitter = $_POST['twitter'];
            $instagram = $_POST['instagram'];
            $facebook = $_POST['facebook'];
            
            $database->addEvento($nombre,$organizador, $fechaInicio, $fechaFin, $lugar, $texto, $logo,
                                $imagenPrincipal, $web, $twitter, $instagram, $facebook);
            $varsParaTwig['exito'] = 1;
            
        }

       
        
    }

    echo $twig->render('addEvent.html',$varsParaTwig);


?>
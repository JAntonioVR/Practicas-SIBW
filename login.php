<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);
  
    require_once 'modelo.php';

    $database = new Database();

  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nickname = $_POST['nickname'];
    $clave = $_POST['clave'];
  
    if ($database->checkLogin($nickname, $clave)) {
      session_start();
      
      $_SESSION['nicknameUsuario'] = $nickname; 
    }
        
    
    header("Location: index.php");
    
    exit();
  }
  
  echo $twig->render('login.html', []);
?>
<?php

//
// ──────────────────────────────────────────────────────────────
//   :::::: M O D E L O : :  :   :    :     :        :          :
// ──────────────────────────────────────────────────────────────
// Contiene funcionalidad relacionada con la base de datos

class Database{

    // Atributo que representa una conexión entre PHP y una base de datos MySQL.
    private $mysqli; 

    //
    // ─── CONSTRUCTOR ────────────────────────────────────────────────────────────────
    // Inicializa el atributo $mysqli y realiza la conexión a la BD.

    public function __construct(){

        $this->mysqli = new mysqli("mysql", "JuanAntonio", "sibw", "SIBW");

        if( $this->mysqli->connect_errno ){
            echo ("Fallo al conectar: " . $this->mysqli->connect_error);
        }
    }

    //
    // ─── CONSULTA DE EVENTOS ────────────────────────────────────────────────────────
    // Devuelve los atributos de un evento a partir de un identificador.
    // Si el evento indicado no existe devuelve unos valores por defecto

    public function getEvento($idEv){

        // Protección contra inyección SQL y consulta
        $stmt = $this->mysqli->prepare("SELECT * FROM eventos WHERE id=?");
        $stmt-> bind_param("i", $idEv);
        $stmt-> execute();
        $res  = $stmt->get_result();
        
        // Evento por defecto
        $evento = array(
            'nombre'      => 'No se ha seleccionado ningún evento', 
            'organizador' => 'Esta es la pantalla',
            'fechaInicio' => 'por defecto.',
            'fechaFinal'  => 'Elija un evento',
            'lugar'       => ' ',
            'texto'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam malesuada nunc ut justo aliquet, a hendrerit lacus posuere. Pellentesque faucibus quam a nunc ullamcorper rutrum. Nunc accumsan vulputate libero quis fermentum. Aliquam nec ex sed diam rutrum pretium sed in diam. In interdum ullamcorper orci, cursus lobortis nibh. Praesent tristique lorem in augue pellentesque, sit amet finibus est egestas. Proin aliquam pharetra mauris. Vivamus tincidunt arcu dolor, non mollis odio gravida a. Etiam suscipit, nisl ac dignissim euismod, orci enim posuere nisl, eget hendrerit risus mauris sit amet augue. Aliquam porttitor ex arcu, hendrerit rutrum velit condimentum eu. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque quis turpis eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla venenatis enim vel tortor pellentesque, eu dapibus elit pellentesque. Duis eleifend non nisi sed luctus. Proin rhoncus justo sit amet suscipit convallis.

            Ut porta dignissim bibendum. Sed augue purus, suscipit ac massa at, aliquet sagittis purus. Fusce vulputate viverra accumsan. Aenean consequat est lorem, sed fringilla metus rhoncus vel. Integer tristique justo sit amet quam blandit feugiat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed egestas est urna, semper pretium lectus volutpat eget. Cras dignissim, justo at dictum lacinia, mi dolor mollis diam, sed ullamcorper sem sem ac quam. Suspendisse vel pharetra orci. Maecenas consectetur eleifend tempor. Donec porttitor mattis sem, sit amet bibendum mi fringilla quis.
            
            Duis non diam sed felis imperdiet tristique sit amet eget arcu. Cras quis vehicula turpis. Morbi non sem nisi. Sed vitae velit sed diam tincidunt accumsan. Ut lacinia placerat congue. Phasellus imperdiet magna ut diam consequat pulvinar. Phasellus ultrices mauris eget urna placerat, eget laoreet odio mollis. Sed quis eleifend tellus. Nam eget tortor vel dui gravida congue. Sed ut tortor sed dui cursus fringilla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce varius eros nec nibh tincidunt, sed pulvinar nisl tincidunt.',
            
            'logo'        => '../img/default.jpg',
            'imagen'      => '../img/default-image.png',
            'web'         => ' ',
            'twitter'     => ' ',
            'instagram'   => ' ',
            'facebook'    => ' '
        );

        $date       = date_create($row['fecha_hora']);
        $fecha      = date_format($date, 'd/m/y   H:i:s');
        
        // Pasamos los datos al controlador
        if( $res->num_rows > 0 ){
            $row = $res->fetch_assoc();

            $dateInicio = date_create($row['fechaInicio']);
            $fechaInicio = date_format($dateInicio, 'd/m/y');

            $dateFinal = date_create($row['fechaFinal']);
            $fechaFinal = date_format($dateFinal, 'd/m/y');

            $evento = array(
                'nombre'      => $row['nombre'], 
                'organizador' => $row['organizador'],
                'fechaInicio' => $fechaInicio,
                'fechaFinal'  => $fechaFinal,
                'lugar'       => $row['lugar'],
                'texto'       => $row['texto'],
                'logo'        => $row['logo'],
                'imagen'      => $row['imagenPrincipal'],
                'print'       => "./evento.php?imp=1&ev=".$row['id'],
                'web'         => $row['web'],
                'twitter'     => $row['twitter'],
                'instagram'   => $row['instagram'],
                'facebook'    => $row['facebook']
            );
        }

        $stmt->close();
        return $evento;

    }

    //
    // ─── CONSULTA DE COMENTARIOS ────────────────────────────────────────────────────
    // Busca y devuelve los datos de los comentarios de un evento concreto

    public function getComentarios($idEv){

         // Protección contra inyección SQL y consulta       
        $stmt = $this->mysqli->prepare("SELECT id, autor, fecha_hora, texto, modificado FROM comentarios WHERE idEvento=?");
        $stmt-> bind_param("i", $idEv);
        $stmt-> execute();
        $res  = $stmt->get_result();
        
        // Array inicialmente vacío de comentarios
        $comentarios = array();

        // Añadimos cada comentario al array
        while($row = $res->fetch_assoc()){

            $date        = date_create($row['fecha_hora']);
            $fecha       = date_format($date, 'd/m/y   H:i:s');
            $linkEdicion = "./modifyComment.php?cm=" . $row['id'];
            $linkBorrado = "./deleteComment.php?cm=" . $row['id'];
            $comentario = array(
                'autor'       => $row['autor'],
                'fecha_hora'  => $fecha,
                'texto'       => $row['texto'],
                'linkEdicion' => $linkEdicion,
                'linkBorrado' => $linkBorrado,
                'modificado'  => $row['modificado']
            );

            $comentarios[] = $comentario;
        }

        $stmt->close();
        return $comentarios;
    }

    public function getAllComments(){

        $stmt = $this->mysqli->prepare("SELECT * FROM comentarios");
        $stmt-> execute();
        $res  = $stmt->get_result();

        // Array inicialmente vacío de comentarios
        $comentarios = array();

        // Añadimos cada comentario al array
        while($row = $res->fetch_assoc()){

            $date        = date_create($row['fecha_hora']);
            $fecha       = date_format($date, 'd/m/y   H:i:s');
            $comentario = array(
                'id'          => $row['id'],
                'autor'       => $row['autor'],
                'email_autor' => $row['email_autor'],
                'fecha_hora'  => $fecha,
                'texto'       => $row['texto'],
                'idEvento'    => $row['idEvento'],
                'modificado'  => $row['modificado']
            );

            $comentarios[] = $comentario;
        }

        $stmt->close();
        return $comentarios;
    }


    //
    // ─── CONSULTA DE EVENTOS EN LA PORTADA ──────────────────────────────────────────
    // Obtiene la información básica para representar los eventos en la portada
   
    public function getEventosPortada(){

        // Protección contra inyección SQL y consulta    
        $stmt = $this->mysqli->prepare("SELECT id, nombre, imagenPrincipal from eventos");
        $stmt-> execute();
        $res  = $stmt->get_result();

        // Array inicialmente vacío de eventos
        $eventos = array();

        // Añadimos cada evento al array
        while($row = $res->fetch_assoc()){
            $id     = $row['id'];
            $link   = "../evento.php?ev=" . $id;
            $evento = array(
                'nombre' => $row['nombre'],
                'imagen' => $row['imagenPrincipal'],
                'link'   => $link
            );

            $eventos[] = $evento;
        }

        $stmt->close();
        return $eventos;
    }

    //
    // ─── CONSULTA DE GALERÍA ────────────────────────────────────────────────────
    // Busca y devuelve los datos de las imágenes de un evento concreto

    public function getGaleria($idEv){

        // Protección contra inyección SQL y consulta    
        $stmt = $this->mysqli->prepare("SELECT * from imagenes where idEvento=?");
        $stmt-> bind_param("i", $idEv);
        $stmt-> execute();
        $res  = $stmt->get_result();

        // Array inicialmente vacío de imágenes
        $imagenes = array();

        // Añadimos cada imagen al array
        while($row = $res->fetch_assoc()){   
            $imagenes[] = $row['ruta'];
        }
        $stmt->close();
        return $imagenes;
    }

    //
    // ─── OBTENCION DE PALABRAS PROHIBIDAS ───────────────────────────────────────────
    // Consulta de las palabras prohibidas
        
    public function getPalabrasProhibidas(){

        // Protección contra inyección SQL y consulta    
        $stmt = $this->mysqli->prepare("SELECT * from palabras_prohibidas");
        $stmt-> execute();
        $res  = $stmt->get_result();

        // Array inicialmente vacío de palabras
        $palabras = array();

        // Añadimos cada imagen al array
        while($row = $res->fetch_assoc()){   
            $palabras[] = $row['palabra'];
        }

        $stmt->close();
        return $palabras;

    }

    //
    // ─── CONSULTA DE ENLACES DE INTERES ─────────────────────────────────────────────
    // Busca y devuelve los nombres y links a los enlaces de interés de un evento 
    // concreto

    public function getEnlacesDeInteres($idEv){

        // Protección contra inyección SQL y consulta    
        $stmt = $this->mysqli->prepare("select link, nombre from enlaces INNER JOIN eventos_enlaces ON enlaces.id = eventos_enlaces.idEnlace where idEvento=?");
        $stmt-> bind_param("i", $idEv);
        $stmt-> execute();
        $res  = $stmt->get_result();

        // Array inicialmente vacío de enlaces
        $enlaces = array();

        // Añadimos cada enlace al array
        while($row = $res->fetch_assoc()){
            $enlace = array(
                'nombre' => $row['nombre'],
                'link'   => $row['link']
            ) ;
            $enlaces[] = $enlace;
        }

        $stmt->close();
        return $enlaces;
    }

    public function insertarUsuario($nickname, $nombre, $email, $clave, $tipo){
        $consulta_insercion = "INSERT INTO usuario VALUES ('" .
                            $nickname . "', '" . $nombre . "', '" . $email . 
                            "', '" . password_hash($clave, PASSWORD_DEFAULT) . 
                            "', '" . $tipo ."')";

        // FIXME Protección contra inyección SQL??
        $res = $this->mysqli->query($consulta_insercion);

        /*
        NOTE Bueno para depurar:
        if($res === TRUE){
            echo "Se ha insertado una nueva fila";
        }
        else{
            echo "Error al insertar la fila: " . $this.mysqli->error;
            echo $consulta_insercion;
        }
        */
        return $res;

    }

    public function checkLogin($nickname, $clave){

        $stmt = $this->mysqli->prepare("SELECT clave FROM usuario WHERE nickname=?");
        $stmt->bind_param("s", $nickname);
        $stmt->execute();
        $res  = $stmt->get_result();
        $stmt->close();

        $found = FALSE;

        if( $res->num_rows === 1 ){
            $row = $res->fetch_assoc();
            if( password_verify($clave, $row['clave'] ))
                $found = TRUE;
        }
        
        return $found;
    }

    public function getUsuario($nickname){
        $consulta = "SELECT * FROM usuario WHERE nickname=?";
        $stmt = $this->mysqli->prepare($consulta);
        $stmt->bind_param("s",$nickname);
        $stmt->execute();
        $res = $stmt->get_result();

        $user = -1;

        if( $res->num_rows === 1 ){
            $row = $res->fetch_assoc();
            $user = [
                'nickname' => $row['nickname'],
                'nombre'   => $row['nombre'],
                'email'    => $row['email'],
                'clave'    => $row['clave'],
                'tipo'     => $row['tipo']
            ];
        }
        $stmt->close();
        return $user;
        
    }

    public function actualizaInformacion($nickname, $nombre, $email, $clave){

        $consulta = "UPDATE usuario SET nombre=?, email=?, clave=? WHERE nickname=?";
        $stmt = $this->mysqli->prepare($consulta);
        $stmt->bind_param("ssss", $nombre, $email, password_hash($clave, PASSWORD_DEFAULT), $nickname);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();

        return $res;
    }

    public function getComentario($id){

        $consulta = "SELECT id, autor, texto, idEvento FROM comentarios WHERE id=?";
        $stmt = $this->mysqli->prepare($consulta);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();

        $comentario = -1;
        
        if( $res->num_rows === 1 )
            $comentario = $res->fetch_assoc();

        $stmt->close();
        return $comentario;
    }

    public function modificaComentario($id, $texto){
        $consulta = "UPDATE comentarios SET texto=?, modificado=1 WHERE id=?";
        $stmt = $this->mysqli->prepare($consulta);
        $stmt->bind_param("si", $texto, $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();

        return $res;
    }

    public function borraComentario($id){
        $consulta = "DELETE FROM comentarios WHERE id=?";
        $stmt = $this->mysqli->prepare($consulta);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();

        return $res;
    }

    //
    // ──────────────────────────────────────────────────────────────────────────────
    //

}

?>
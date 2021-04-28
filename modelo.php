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
        $stmt->bind_param("i", $idEv);
        $stmt->execute();
        $res = $stmt->get_result();
        
        // Evento por defecto
        $evento = array(
            'nombre'      => 'No se ha seleccionado ningún evento', 
            'organizador' => 'Esta es la pantalla',
            'fecha'       => 'por defecto',
            'lugar'       => 'Elija un evento',
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
        
        // Pasamos los datos al controlador
        if( $res->num_rows > 0 ){
            $row = $res->fetch_assoc();

            $evento = array(
                'nombre'      => $row['nombre'], 
                'organizador' => $row['organizador'],
                'fecha'       => $row['fecha'],
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
        $stmt = $this->mysqli->prepare("SELECT autor, fecha_hora, texto FROM comentarios WHERE idEvento=?");
        $stmt->bind_param("i", $idEv);
        $stmt->execute();
        $res = $stmt->get_result();
        
        // Array inicialmente vacío de comentarios
        $comentarios = array();

        // Añadimos cada comentario al array
        while($row = $res->fetch_assoc()){
            $date = date_create($row['fecha_hora']);
            $fecha = date_format($date, 'd/m/y   H:i:s');

            $comentario = array(
                'autor' => $row['autor'],
                'fecha_hora' => $fecha,
                'texto' => $row['texto']
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
        $stmt->execute();
        $res = $stmt->get_result();

        // Array inicialmente vacío de eventos
        $eventos = array();

        // Añadimos cada evento al array
        while($row = $res->fetch_assoc()){
            $id = $row['id'];
            $link = "../evento.php?ev=" . $id;
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
        $stmt->bind_param("i", $idEv);
        $stmt->execute();
        $res = $stmt->get_result();

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
        $stmt->execute();
        $res = $stmt->get_result();

        // Array inicialmente vacío de palabras
        $palabras = array();

        // Añadimos cada imagen al array
        while($row = $res->fetch_assoc()){   
            $palabras[] = $row['palabra'];
        }

        $stmt->close();
        return $palabras;

    }

}

?>
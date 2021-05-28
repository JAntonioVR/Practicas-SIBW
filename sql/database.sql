
-- Creación de tablas --

CREATE TABLE eventos(
    id               INT AUTO_INCREMENT PRIMARY KEY,
    nombre           VARCHAR(100),
    organizador      VARCHAR(100),
    fechaInicio      DATE,
    fechaFinal       DATE,
    lugar            VARCHAR(50),
    texto            VARCHAR(3000),
    logo             VARCHAR(100),
    imagenPrincipal  VARCHAR(100),
    web              VARCHAR(100),
    twitter          VARCHAR(100),
    instagram        VARCHAR(100),
    facebook         VARCHAR(100),
    etiquetas        VARCHAR(500),
    publicado        BOOLEAN
);

CREATE TABLE palabras_prohibidas(
    palabra VARCHAR(50) PRIMARY KEY
);

CREATE TABLE imagenes(
    ruta VARCHAR(100) NOT NULL PRIMARY KEY,
    idEvento INT NOT NULL,
    FOREIGN KEY(idEvento) REFERENCES eventos(id)
);

CREATE TABLE comentarios(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    autor       VARCHAR(30),
    email_autor VARCHAR(100),
    fecha_hora  DATETIME,
    texto       VARCHAR(280),
    idEvento    INT NOT NULL,
    modificado  BOOLEAN,
    FOREIGN KEY(idEvento) REFERENCES eventos(id)
);

CREATE TABLE enlaces(
    id     INT AUTO_INCREMENT PRIMARY KEY,
    link   VARCHAR(200),
    nombre VARCHAR(100)
);

CREATE TABLE eventos_enlaces(
    idEvento INT,
    idEnlace INT,
    FOREIGN KEY (idEvento) REFERENCES eventos(id),
    FOREIGN KEY (idEnlace) REFERENCES enlaces(id),
    PRIMARY KEY (idEvento, idEnlace)
);

CREATE TABLE tipo_usuario(
    tipo VARCHAR(20) NOT NULL PRIMARY KEY
);

CREATE TABLE usuario(
    nickname VARCHAR(30) PRIMARY KEY,
    nombre VARCHAR(100),
    email    VARCHAR(100),
    clave VARCHAR(100) NOT NULL,
    tipo VARCHAR(20),
    FOREIGN KEY (tipo) REFERENCES tipo_usuario(tipo)
);

-- Insercion de tuplas --

-- eventos:

INSERT INTO eventos (nombre, organizador, fechaInicio, fechaFinal, lugar, texto, logo, imagenPrincipal, web, twitter, instagram, facebook, etiquetas, publicado) VALUES 
    ('Medusa Sunbeach Festival', 'Miguel Serna', STR_TO_DATE('9-08-2021', '%d-%m-%Y'), STR_TO_DATE('14-08-2021', '%d-%m-%Y'), 'Cullera, Valencia',
     'El Medusa Sunbeach Festival es un festival de música electrónica dirigido principalmente hacia un público joven. Se celebra desde 2014 cada año en la playa de Cullera, municipio de Valencia, Comunidad Valenciana. Encontramos diferentes estilos con sus respectivos escenarios: desde el EDM en el escenario principal hasta Techno, Indie, Remember, Hardstyle, Dubstep y Trap (estos 3 últimos fueron incluidos en la última edición). El Festival tematiza anualmente cada edición basándose en una experiencia temática como "invaders"1​, "Secret of Wonderland"2​, que son el hilo conductor que inspira la temática del escenario principal cada edición.
     Medusa es un concepto que durante estos años ha combinado a los mejores DJs y artistas del mundo con una puesta en escena totalmente original llena de grandes emociones y fantasía impulsado con lo más sofisticado a nivel producción donde destaca un impresionante escenario de 100 por 30 metros totalmente decorado y diseñado por falleros experimentados de la cultura valenciana.
     Más de 300.000 asistentes disfrutaron del último Medusa Sunbeach Festival, que además dispone de una ciudad de zona de acampada con todas las comodidades para 12.000 personas. El mejor clima y la mejor temporada para vivir una de las experiencias más impresionantes al aire libre. ¡Tan grande, tan cerca, tan tuyo! Medusa Festival dejará a todos sin aliento.',
     './img/medusa-festival-logo.jpg', './img/medusa.jpg',
     'https://www.medusasunbeach.com/','https://twitter.com/MedusaFestival/',
     'https://www.instagram.com/medusa_festival/', 'https://es-es.facebook.com/medusasunbeach', 'festival, electonica, medusa, meduseando, verano, summer, playa, beach, Cullera',true),
    ('Dreambeach Festival', 'Gonçalo', STR_TO_DATE('4-08-2021', '%d-%m-%Y'), STR_TO_DATE('8-08-2021', '%d-%m-%Y'), 'Villaricos, Almería',
     'Dreambeach Villaricos es un festival de música electrónica que se celebra anualmente desde 2012 en la playa de Palomares, dentro del municipio español de Cuevas del Almanzora (Almería). El festival recibe su nombre de su antigua ubicación, en la población de Villaricos. Dreambeach es el heredero del famoso Creamfields Andalucía, el cual dejó de celebrarse en 2012.1​ En la venta de la 5.ª edición se llegaron a superar los 12 000 abonos vendidos a las pocas horas sin haber confirmado ningún artista. Desde 2019 el festival celebra también una edición en Chile.
        Villaricos es una localidad y pedanía española perteneciente al municipio de Cuevas del Almanzora, en la provincia de Almería. Está situada en la parte oriental de la comarca del Levante Almeriense. En plena costa mediterránea, cerca de esta localidad se encuentran los núcleos de Palomares, Vera-Playa, Las Rozas, Las Herrerías y El Arteal. En Villaricos desemboca el río Almanzora.

        Se trata del principal centro turístico del municipio cuevano, rodeado de parajes naturales como la Sierra Almagrera o las islas de Terreros y Negra. En el mes de agosto se celebra el festival de música electrónica Dreambeach Villaricos.1​2​ Cuenta con dos pequeños puertos: el de Villaricos y el puerto deportivo de la Esperanza.

        Lo que hoy se conoce como Villaricos fue colonizado a lo largo de la historia por diversas civilizaciones, entre las que destacan los fenicios, cartagineses, romanos y visigodos. Se tiene constancia gracias a los vestigios encontrados en varias excavaciones, desde las emprendidas por el arqueólogo belga Luis Siret a partir de 1890 hasta las que se llevaron a cabo durante todo el siglo xx.3​ La actual localidad se asienta sobre la antigua ciudad fenicia de Baria, fundada por navegantes tirios a finales del siglo viii a. C.',
     './img/logo-dreambeach.png', './img/dreambeach.jpg',
     'https://www.dreambeach.es/', 'https://twitter.com/DreambeachFest',
     'https://www.instagram.com/dreambeachfest/?hl=es', 'https://www.facebook.com/DreambeachFest/', 'festival, electronica, techno, carpazo, dreambeach, verano, summer, playa, beach, Villaricos',true
    );

-- comentarios:

INSERT INTO comentarios (autor, email_autor, fecha_hora, texto, idEvento, modificado) VALUES
(
    'Yo',
    'yo@gmail.com',
    now(),
    'me lo pase genial',
    1, false
),
(   'tu',
    'tu@gmail.com',
    now(),
    'me lo pase fatal',
    1, false
),
(   'el',
    'el@gmail.com',
    now(),
    'me lo pase regular',
    1, false
);

-- imagenes:

INSERT INTO imagenes(ruta, idEvento) VALUES
(
    './img/medusa.jpg',
    1
),
(
    './img/medusa1.jpg',
    1
),
(
    './img/medusa2.jpg',
    1
),
(
    './img/medusa3.jpg',
    1
),
(
    './img/medusa4.jpg',
    1
),
(
    './img/dreambeach.jpg',
    2
),
(
    './img/dreambeach1.jpg',
    2
),
(
    './img/dreambeach2.jpeg',
    2
),
(
    './img/dreambeach3.jpeg',
    2
),
(
    './img/dreambeach4.jpg',
    2
);

-- palabras_prohibidas

INSERT INTO palabras_prohibidas VALUES
( 'salvame' ),
( 'supervivientes' ),
( 'la isla de las tentaciones' ),
( 'nieve' ),
( 'tiro' ),
( 'coca' ),
( 'cristal' ),
( 'gran hermano' ),
( 'operacion triunfo' );

-- enlaces de interés

INSERT INTO enlaces(nombre, link) VALUES 
(
    "Generalitat Valenciana",
    "https://www.gva.es/va/inicio/presentacion"
),
(
    "Visit Valencia",
    "https://www.visitvalencia.com/"
),
(
    "Junta de Andalucía",
    "https://www.juntadeandalucia.es/"
),
(
    "Turismo de Almería",
    "https://www.turismodealmeria.org/"
),
(
    "Ministerio de cultura y deporte",
    "http://www.culturaydeporte.gob.es/cultura.html"
);

-- relacion evento-enlace

INSERT INTO eventos_enlaces VALUES 
(1,1),
(1,2),
(2,3),
(2,4),
(1,5),
(2,5);

-- tipos de usuario

INSERT INTO tipo_usuario VALUES 
    ("anonimo"),
    ("registrado"),
    ("moderador"),
    ("gestor"),
    ("super");
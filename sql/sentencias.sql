CREATE TABLE eventos(
    id               INT AUTO_INCREMENT PRIMARY KEY,
    nombre           VARCHAR(100),
    organizador      VARCHAR(100),
    fecha            VARCHAR(50),
    lugar            VARCHAR(50),
    texto            VARCHAR(3000),
    logo             VARCHAR(100),
    imagenPrincipal  VARCHAR(100),
    web              VARCHAR(100),
    twitter          VARCHAR(100),
    instagram        VARCHAR(100),
    facebook         VARCHAR(100)
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
    FOREIGN KEY(idEvento) REFERENCES eventos(id)
);

INSERT INTO eventos (nombre, organizador, fecha, lugar, texto, logo, imagenPrincipal, web, twitter, instagram, facebook) VALUES 
    ('Medusa Sunbeach Festival', 'Miguel Serna', '9-14 Agosto 2021', 'Cullera, Valencia',
     'El Medusa Sunbeach Festival es un festival de música electrónica dirigido principalmente hacia un público joven. Se celebra desde 2014 cada año en la playa de Cullera, municipio de Valencia, Comunidad Valenciana. Encontramos diferentes estilos con sus respectivos escenarios: desde el EDM en el escenario principal hasta Techno, Indie, Remember, Hardstyle, Dubstep y Trap (estos 3 últimos fueron incluidos en la última edición). El Festival tematiza anualmente cada edición basándose en una experiencia temática como "invaders"1​, "Secret of Wonderland"2​, que son el hilo conductor que inspira la temática del escenario principal cada edición.',
     '../img/medusa/medusa-festival-logo.jpg', '../img/medusa/medusa.jpg',
     'https://www.medusasunbeach.com/','https://twitter.com/MedusaFestival/',
     'https://www.instagram.com/medusa_festival/', 'https://es-es.facebook.com/medusasunbeach');

INSERT INTO eventos (nombre, organizador, fecha, lugar, texto, logo, imagenPrincipal, web, twitter, instagram, facebook) VALUES 
    ('Dreambeach Festival', 'Gonçalo', '4-8 Agosto 2021', 'Villaricos, Almería',
     'Dreambeach Villaricos es un festival de música electrónica que se celebra anualmente desde 2012 en la playa de Palomares, dentro del municipio español de Cuevas del Almanzora (Almería). El festival recibe su nombre de su antigua ubicación, en la población de Villaricos. Dreambeach es el heredero del famoso Creamfields Andalucía, el cual dejó de celebrarse en 2012.1​ En la venta de la 5.ª edición se llegaron a superar los 12 000 abonos vendidos a las pocas horas sin haber confirmado ningún artista. Desde 2019 el festival celebra también una edición en Chile.',
     '../img/dreambeach/logo-dreambeach.png', '../img/dreambeach/dreambeach.jpg',
     'https://www.dreambeach.es/', 'https://twitter.com/DreambeachFest',
     'https://www.instagram.com/dreambeachfest/?hl=es', 'https://www.facebook.com/DreambeachFest/'
    );

INSERT INTO comentarios (autor, email_autor, fecha_hora, texto, idEvento) VALUES(
    'Yo',
    'yo@gmail.com',
    now(),
    'me lo pase genial',
    1
);

INSERT INTO comentarios (autor, email_autor, fecha_hora, texto, idEvento) VALUES(
    'tu',
    'tu@gmail.com',
    now(),
    'me lo pase fatal',
    1
);

INSERT INTO comentarios (autor, email_autor, fecha_hora, texto, idEvento) VALUES(
    'el',
    'el@gmail.com',
    now(),
    'me lo pase regular',
    1
);

INSERT INTO imagenes(ruta, idEvento) VALUES(
    '../img/medusa/medusa.jpg',
    1
);

INSERT INTO imagenes(ruta, idEvento) VALUES(
    '../img/medusa/medusa1.jpg',
    1
);
INSERT INTO imagenes(ruta, idEvento) VALUES(
    '../img/medusa/medusa2.jpg',
    1
);INSERT INTO imagenes(ruta, idEvento) VALUES(
    '../img/medusa/medusa3.jpg',
    1
);INSERT INTO imagenes(ruta, idEvento) VALUES(
    '../img/medusa/medusa4.jpg',
    1
);

INSERT INTO imagenes(ruta, idEvento) VALUES(
    '../img/dreambeach/dreambeach.jpg',
    2
);

INSERT INTO imagenes(ruta, idEvento) VALUES(
    '../img/dreambeach/dreambeach1.jpg',
    2
);
INSERT INTO imagenes(ruta, idEvento) VALUES(
    '../img/dreambeach/dreambeach2.jpeg',
    2
);
INSERT INTO imagenes(ruta, idEvento) VALUES(
    '../img/dreambeach/dreambeach3.jpeg',
    2
);
INSERT INTO imagenes(ruta, idEvento) VALUES(
    '../img/dreambeach/dreambeach4.jpg',
    2
);

INSERT INTO palabras_prohibidas VALUES( 'salvame' );
INSERT INTO palabras_prohibidas VALUES( 'supervivientes' );
INSERT INTO palabras_prohibidas VALUES( 'la isla de las tentaciones' );
INSERT INTO palabras_prohibidas VALUES( 'nieve' );
INSERT INTO palabras_prohibidas VALUES( 'tiro' );
INSERT INTO palabras_prohibidas VALUES( 'coca' );
INSERT INTO palabras_prohibidas VALUES( 'cristal' );
INSERT INTO palabras_prohibidas VALUES( 'gran hermano' );
INSERT INTO palabras_prohibidas VALUES( 'operacion triunfo' );
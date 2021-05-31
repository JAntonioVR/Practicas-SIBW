
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

INSERT INTO eventos (nombre, organizador, fechaInicio, fechaFinal, lugar, texto, logo, imagenPrincipal, web, twitter, instagram, facebook, etiquetas, publicado) VALUES (
        'Medusa Sunbeach Festival', 'Miguel Serna', STR_TO_DATE('9-08-2021', '%d-%m-%Y'), STR_TO_DATE('14-08-2021', '%d-%m-%Y'), 'Cullera, Valencia',
        'El Medusa Sunbeach Festival es un festival de música electrónica dirigido principalmente hacia un público joven. Se celebra desde 2014 cada año en la playa de Cullera, municipio de Valencia, Comunidad Valenciana. Encontramos diferentes estilos con sus respectivos escenarios: desde el EDM en el escenario principal hasta Techno, Indie, Remember, Hardstyle, Dubstep y Trap (estos 3 últimos fueron incluidos en la última edición). El Festival tematiza anualmente cada edición basándose en una experiencia temática como "invaders"1​, "Secret of Wonderland"2​, que son el hilo conductor que inspira la temática del escenario principal cada edición.
        Medusa es un concepto que durante estos años ha combinado a los mejores DJs y artistas del mundo con una puesta en escena totalmente original llena de grandes emociones y fantasía impulsado con lo más sofisticado a nivel producción donde destaca un impresionante escenario de 100 por 30 metros totalmente decorado y diseñado por falleros experimentados de la cultura valenciana.
        Más de 300.000 asistentes disfrutaron del último Medusa Sunbeach Festival, que además dispone de una ciudad de zona de acampada con todas las comodidades para 12.000 personas. El mejor clima y la mejor temporada para vivir una de las experiencias más impresionantes al aire libre. ¡Tan grande, tan cerca, tan tuyo! Medusa Festival dejará a todos sin aliento.',
        './img/medusa-festival-logo.jpg', './img/medusa.jpg',
        'https://www.medusasunbeach.com/','https://twitter.com/MedusaFestival/',
        'https://www.instagram.com/medusa_festival/', 'https://es-es.facebook.com/medusasunbeach', 'festival, electonica, medusa, meduseando, verano, summer, playa, beach, Cullera',true
    ),(
        'Dreambeach Festival', 'Gonçalo', STR_TO_DATE('4-08-2021', '%d-%m-%Y'), STR_TO_DATE('8-08-2021', '%d-%m-%Y'), 'Villaricos, Almería',
        'Dreambeach Villaricos es un festival de música electrónica que se celebra anualmente desde 2012 en la playa de Palomares, dentro del municipio español de Cuevas del Almanzora (Almería). El festival recibe su nombre de su antigua ubicación, en la población de Villaricos. Dreambeach es el heredero del famoso Creamfields Andalucía, el cual dejó de celebrarse en 2012.1​ En la venta de la 5.ª edición se llegaron a superar los 12 000 abonos vendidos a las pocas horas sin haber confirmado ningún artista. Desde 2019 el festival celebra también una edición en Chile.
        Villaricos es una localidad y pedanía española perteneciente al municipio de Cuevas del Almanzora, en la provincia de Almería. Está situada en la parte oriental de la comarca del Levante Almeriense. En plena costa mediterránea, cerca de esta localidad se encuentran los núcleos de Palomares, Vera-Playa, Las Rozas, Las Herrerías y El Arteal. En Villaricos desemboca el río Almanzora.
        Se trata del principal centro turístico del municipio cuevano, rodeado de parajes naturales como la Sierra Almagrera o las islas de Terreros y Negra. En el mes de agosto se celebra el festival de música electrónica Dreambeach Villaricos.1​2​ Cuenta con dos pequeños puertos: el de Villaricos y el puerto deportivo de la Esperanza.
        Lo que hoy se conoce como Villaricos fue colonizado a lo largo de la historia por diversas civilizaciones, entre las que destacan los fenicios, cartagineses, romanos y visigodos. Se tiene constancia gracias a los vestigios encontrados en varias excavaciones, desde las emprendidas por el arqueólogo belga Luis Siret a partir de 1890 hasta las que se llevaron a cabo durante todo el siglo xx.3​ La actual localidad se asienta sobre la antigua ciudad fenicia de Baria, fundada por navegantes tirios a finales del siglo viii a. C.',
        './img/logo-dreambeach.png', './img/dreambeach.jpg',
        'https://www.dreambeach.es/', 'https://twitter.com/DreambeachFest',
        'https://www.instagram.com/dreambeachfest/?hl=es', 'https://www.facebook.com/DreambeachFest/', 'festival, electronica, techno, carpazo, dreambeach, verano, summer, playa, beach, Villaricos',true
    ),(
        'Weekend Beach Festival', 'Gonçalo', '2021/06/30', '2021/07/03', 'Torre del Mar, Málaga', 'Segundo núcleo de población del municipio de Vélez-Málaga en número de habitantes y gran escaparate turístico, cuya fama trasciende los límites de Andalucía. Torre del Mar se caracteriza por la calidad ambiental y extensión de sus magníficas playas, así como por su paseo marítimo, punto de encuentro de numerosos visitantes, forasteros y extranjeros, así como de vecinas y vecinos.
        Ubicado en el centro geográfico de la línea costera del municipio de Vélez-Málaga, entre Almayate y Caleta de Vélez, su huella urbana se extiende desde Río Seco hasta las playas de Poniente. Dista escasos cuatro kilómetros del núcleo principal de población del término, Vélez-Málaga, comunicándose ambos enclaves por la Avenida Juan Carlos I. La antigua N-340, que une Cádiz y Barcelona, transcurre por el casco urbano de Torre del Mar, distando de la ciudad de Málaga apenas 20 minutos de trayecto por la autovía A-7.
        En la actualidad, Torre del Mar es un enclave turístico, comercial y de ocio, cuya oferta gastronómica vinculada al ‘pescaíto’ forma parte de numerosas guías gastronómicas. La Feria de Torre del Mar, que se celebra entre el 22 y el 26 de julio, en honor a Santa Ana y Santiago, al igual que la procesión marinera de la Virgen del Carmen, se han convertido en eventos reconocidos en toda la provincia de Málaga.',
        './img/logo-wb.png','./img/weekend-beach-fest.jpg',
        'https://www.weekendbeach.es/', 'https://twitter.com/weekendbeachfes','https://www.instagram.com/weekendbeachfestival/','https://www.facebook.com/weekendbeachfestival',
        'festival, playa, Torre del Mar, indie, rock, EDM, techno', false

    ),(
        'A Summer Story', 'Manuel Martín', '2021/06/18', '2021/06/19', 'Ciudad del Rock, Madrid', '¿Imaginas vivir el inicio del verano con un amanecer lleno de emociones y experiencias? En A Summer Story es posible, un festival que se ha convertido en todo un referente en la capital y en nuestro país. Cada año miles y miles de personas lo tienen claro… ¡Aquí empieza el verano!
        La sexta edición tendrá lugar los días 17-18 de junio, para unir a todos los amantes de la música electrónica, en la Comunidad de Madrid. Cada año, la Ciudad del Rock, calificada como el mejor recinto para eventos de gran nivel, crece con nosotros guardando momentos e historias. ¡También queremos la tuya!
        A Summer Story nace un 10 de Julio y a día de hoy, sigue revolucionando el país en cada edición. Cientos de artistas, nacionales e internacionales han dado vida a nuestro evento desde el año 2015. Siempre a nuestro lado, el punto más fuerte de nuestro despliegue audiovisual, Fluge. La empresa líder en el sector, encargada de equipar al festival, con el mejor material técnico de iluminación, sonido y vídeo.
        Aclamado por la crítica, A Summer Story, es conocido por ser el festival nacional más consolidado, con cuatro escenarios, zona de restauración, fuentes de agua gratuita, aparcamiento, zonas VIP… Y el mejor ambiente para disfrutar juntos de la pasión que nos une, la música.
        Año tras año, ampliamos nuestros horizontes, aunando los mejores estilos de la electrónica y las nuevas tendencias, para proporcionar a nuestro público la mejor calidad en todos los aspectos.
        En resumen, unirse a la ‘familia Summer’ es la mejor manera de empezar el verano. ¡Bienvenid@s!', './img/logo-a-summer-story.png', './img/a-summer-story.jpg',
        'https://asummerstory.com/','https://twitter.com/ASummerStoryOfi','https://www.instagram.com/asummerstoryoficial/?hl=es','https://www.facebook.com/ASummerStoryOficial/',
        'festival, Madrid, musica, chill, EDM, summer', true
    ),(
        'Barcelona Beach Festival', 'José Antonio', '2022/07/02', '2022/07/03', 'Parque de La Pau, Barcelona', 'Querida familia de #BBF,
        Hemos estado siguiendo de cerca con expertos y autoridades esta situación sin precedentes y ha quedado claro que simplemente no es posible que el festival de este año siga adelante. El BBF volverá el próximo año el sábado 2 de julio de 2022, en una séptima edición histórica y estamos trabajando duro con los artistas y sus equipos para ofrecerte el mismo cartel y alguna sorpresa más que nos habéis pedido una y otra vez.
        Las entradas serán válidas para la nueva fecha, así que guárdalas!  Para más info sobre las entradas bcnbeachfestival.com/faqs
        Finalmente, queremos daros las gracias por vuestro apoyo incondicional y prometeros que el año que viene será una edición inolvidable donde no escatimaremos esfuerzos y medios para volver a bailar, abrazarnos y celebrar la vida como nunca!!
        Ya no Somos los de Antes, Somos los de hoy en Adelante, pero os prometemos que seremos mejores!!!!
        Nos vemos el 2 de julio de 2022 !!! El equipo de #BBF', './img/logo-bbf.jpeg', './img/bbf.jpg', 'https://www.bcnbeachfestival.com/',
        'https://twitter.com/bbfbarcelona','https://instagram.com/bbfbarcelona','https://facebook.com/BarcelonaBeachFestivalBBF', 'Barcelona, playa, EDM', true
    ),(
        'Festival Internacional de Benicassim', 'Federico Jimenez', '2021/07/15', '2021/07/18', 'Benicassim, Valencia', 
        'Hola fibers, el pasado día 18 de mayo de 2020 anunciamos en nuestra web, newsletter y plataformas digitales, la cancelación de nuestra edición 2020 debido a la situación de emergencia mundial que estamos viviendo. Tal como se informó en ese momento, el proceso de reembolso comenzó 18 de mayo de 2020 y estuvo abierto hasta el 15 de julio de 2020, donde los compradores de See Tickets tenían que rellenar el formulario que salía aquí en nuestra web.
        En caso de haber comprado tu entrada a través de Festicket, el comprador debía contactar en su servicio de atención al cliente. Y los vecinos de Benicàssim que compraron su abono de forma física, pudieron solicitar el reembolso de forma presencial, el 2 de junio de 2020 en el Polideportivo Municipal.
        Muy pronto volveremos a vernos, a sentir la arena de nuestra Costa de Azahar en los pies, la brisa del Mediterráneo y los abrazos de camino a nuestro mítico escenario de “Las Palmas”. Hay tradiciones que no deben perderse y la nuestra siempre seguirá palpitando en nuestro espíritu azul como el mar.
        ¡Viva Benicàssim! ¡Viva FIB!', './img/fib-logo.png', './img/fib.jpg', 'https://fiberfib.com/', 'https://twitter.com/fiberfib?lang=es',
        'https://www.instagram.com/fiberfib/?hl=es', 'https://es-es.facebook.com/fibfestival', 'Festival, internacional, Benicassim, FIB, madness', false
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
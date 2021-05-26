# Practicas-SIBW

# Práctica 4

**Para poder comenzar a utilizar la funcionalidad completa, se adjunta en el fichero `sql/database.sql` la creación de todas las tablas e inserción de algunas tuplas.** 

Con intención de ahorrar trabajo, **si se ejecuta el fichero `preparaBD.php` se crean e insertan en la base de datos usuarios de tipo registrado, moderador, gestor y super**, sus nickname y contraseñas son:

| **Nickname** | **contraseña** |
|--------------|----------------|
| Registrado   | sibw           |
| Moderador    | sibw           |
| Gestor       | sibw           |
| Super        | sibw           |

## `html`

Contiene las plantillas HTML de todos los formularios y pantallas auxiliares necesarias para toda la nueva funcionalidad requerida. En concreto, el fichero `formularios.html` es una plantilla que heredan todos los ficheros dedicados a formularios.

## `css` 

Se ha creado el fichero `formularios.css`, que contiene los estilos necesarios para una mejor apariencia en las distintas pantallas de formularios.

## `*.php`

Se han creado ficheros controladores para cada nueva funcionalidad. Estos ficheros envían y obtienen la información de la base de datos gracias al fichero `modelo.php`, que almacena toda la funcionalidad relativa a la BD, manteniendo así una buena separación modelo-controlador. Antes y después del intercambio de información con la BD los controladores renderizan el respectivo archivo HTML dependiendo del estado actual del sistema. En general, gestionan una variable `$exito`, que en caso de valer 0 no indica éxito o fracaso, sino que se muestra el formulario correspondiente. Si vale 1 es porque se ha completado correctamente la tarea en cuestión. Si vale -1 ha ocurrido uno o más errores en la operación, los cuales se muestran en la plantilla.


# Hasta la Práctica 3

## `html`

Una vez se ha introducido el motor de plantillas `Twig` la forma de los ficheros `html` ha cambiado completamente, aunque en esencia siguen siendo los mismos. Ahora tenemos una plantilla `plantilla.html` donde se encuentran los elementos comunes a todas las páginas, como son la cabecera, la barra lateral y el pie de página, junto a un bloque redefinible para el contenido de la página, y otro para la cabecera.

`portada.html` extiende al fichero `plantilla.html` y en el contenido pone una imagen, nombre y enlace a cada uno de los eventos que hay en la base de datos (la rejilla). `evento.html` extiende también a `plantilla.html` y recoge toda la información de un evento concreto identificado por un número entero, el cual permite extraer de la BD toda la información relativa al mismo. Además, ahora también incluye una galería de imágenes del evento y algunos enlaces de interés. Como el contenido de `evento_imprimir` era igual que el de `evento.html` hasta la P2, pero cambiando las cabeceras, entonces en este caso simplemente extiende a `evento.php` y redefine la cabecera con su propio fichero `css`.

## `css`

Contiene el código en CSS de todas las páginas:

* `mystyle.css` se compone del estilo común a la portada de la web y a la página de evento, tales como el encabezado, el menú, la barra lateral y el pie de página.
* `portada.css` tiene el código propio de la portada, es decir, los eventos puestos en una malla 3x3.
* `evento.css` almacena el código propio de una página de un evento concreto.
* `imprimir.css` contiene lo respectivo a la página que muestra la misma información de evento pero con una apariencia radicalmente distinta, orientada a ser imprimida.

La idea es modularizar cada página HTML con su propio código CSS, pero a su vez agrupando los elementos comunes de `portada.html` y `evento.html` en un único fichero.

## `java`

Contiene ficheros con código de javascript. Hasta la P3, el fichero `javascript.js`:

* Código para mostrar y ocultar un menú de comentarios.
* Código para procesar, validar y añadir un nuevo comentario a la página web.
* Código para censurar posibles palabras malsonantes.

## `*.php`
* El fichero `modelo.php` contiene una clase que encapsula todo el código relacionado con la base de datos, ocultando al controlador y a la vista detalles como el SGBD utilizado. El constructor realiza la conexión con la BD, mientra que el resto de métodos públicos leen y procesan las consultas necesarias a la BD para devolverle a los ficheros de controlador los datos necesarios para la vista.
* Los ficheros `index.php` y `evento.php` representan la interacción entre el modelo y la vista, esto es, la base de datos con la web. Estos ficheros establecen conexión con las plantillas `html` y con la base de datos, obteniendo datos y pasandolos a las plantillas utilizando la bilioteca `Twig`.

## `sql`
De momento sólo contiene un fichero, `database.sql` que permite inicializar desde cero la base de datos que utiliza el modelo e introducir un número significativo de tuplas.
Si desde `mysql` se ejecuta la orden `source /ruta/al/archivo/database.sql` este crea completamente la BD que he utilizado.


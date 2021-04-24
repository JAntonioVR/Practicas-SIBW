# Practicas-SIBW

## `html`

Contiene los ficheros HTML de la portada, el evento y la página para imprimir el evento. `portada.html` y `evento.html` comparten gran parte del código, de hecho es prácticamente igual salvo en la zona principal donde en una se muestran los distintos eventos y en otra información de un evento concreto. Por su parte, `evento_imprimir.html` tiene el código HTML exactamente igual que el de `evento.html` (salvo cabeceras), pero utiliza un fichero CSS distinto, lo cual permite que el mismo contenido sea presentado de forma completamente distinta

## `css`

Contiene el código en CSS de todas las páginas:

* `mystyle.css` se compone del estilo común a la portada de la web y a la página de evento, tales como el encabezado, el menú, la barra lateral y el pie de página.
* `portada.css` tiene el código propio de la portada, es decir, los eventos puestos en una malla 3x3.
* `evento.css` almacena el código propio de una página de un evento concreto.
* `imprimir.css` contiene lo respectivo a la página que muestra la misma información de evento pero con una apariencia radicalmente distinta, orientada a ser imprimida.

La idea es modularizar cada página HTML con su propio código CSS, pero a su vez agrupando los elementos comunes de `portada.html` y `evento.html` en un único fichero.



## `java`

Contiene ficheros con código de javascript. Hasta la P2, el fichero `javascript.js`:

* Código para mostrar y ocultar un menú de comentarios.
* Código para procesar, validar y añadir un nuevo comentario a la página web.
* Código para censurar posibles palabras malsonantes.
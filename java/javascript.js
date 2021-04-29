
//
// ─── DESPLEGAR MENU COMENTARIOS ─────────────────────────────────────────────────
//

function abrir_menu_comentarios(){
    var elemento = document.getElementById("menu_comentarios");
    elemento.classList.toggle("menuOn");
}

document.getElementById("boton_comentarios").onclick = abrir_menu_comentarios;

//
// ─── PROCESAMIENTO DEL FORMULARIO ───────────────────────────────────────────────
//
// - Validación delos datos introducidos
// - Si los datos son válidos, se añade un nuevo comentario

function validar_email( email ) 
{
    var regexp = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*\.(\w{2,4})+$/   
    return regexp.test(email) ? true : false;
}

function procesar_formulario(){
    var nombre     = document.getElementById("input_nombre");
    var email      = document.getElementById("input_email");
    var comentario = document.getElementById("input_comentario")
    
    // Comprobamos los datos
    if(nombre.value == ""){
        document.getElementById("mensajes_error").innerHTML =
        "Por favor, introduzca su nombre."
    }
    else if(email.value == ""){
        document.getElementById("mensajes_error").innerHTML =
        "Por favor, introduzca su email."
    }
    else if(comentario.value == ""){
        document.getElementById("mensajes_error").innerHTML =
        "Por favor, introduzca su comentario."
    }
    else if(!validar_email(email.value)){
        document.getElementById("mensajes_error").innerHTML =
        "El e-mail introducido no es válido.\nPor favor, introduzca un e-mail válido."
    }
    else{   // Los datos son válidos
        var hoy     = new Date(Date.now());
        var dia     = hoy.getDate();
        var mes     = hoy.getMonth()+1;
        var anio    = hoy.getFullYear();
        var hora    = hoy.getHours();
        var minutos = hoy.getMinutes();

        // Para que en la hora los minutos salgan en un formato correcto, y si publicamos a las
        // 17:08 no salgan las 17:8.
        minutos = minutos<10 ? "0" + minutos.toString() : minutos.toString();


        // Añadimos un nuevo comentario
        document.getElementById("mensajes_error").innerHTML = ""
        document.getElementById("comentarios").insertAdjacentHTML("beforeend", 
            "<div class=\"comentario\">" + 
            "<h4>" + nombre.value + "</h4>" +
            "<h5>" + dia + "/" + mes + "/" + anio + " a las " + hora + ":" + minutos + "</h5>" +
            comentario.value +
            "</div>"
        );
    }
}

document.getElementById("boton_enviar").onclick = procesar_formulario;

//
// ─── CENSURA DE PALABRAS PROHIBIDAS ─────────────────────────────────────────────
//

function corregir_palabras(){

    console.log(palabras_prohibidas);

    var comentario = document.getElementById("input_comentario").value,
        encontrada = -1,
        palabra    = "";
    for(i = 0; i < palabras_prohibidas.length && encontrada == -1; i += 1)
        encontrada = comentario.indexOf(palabras_prohibidas[i]);

    if (encontrada != -1) {
        palabra          = "*".repeat(palabras_prohibidas[i-1].length);
        nuevo_comentario = comentario.replace(palabras_prohibidas[i - 1], palabra);
        
        document.getElementById("input_comentario").value = nuevo_comentario;
    }
}

document.getElementById("input_comentario").onkeyup = corregir_palabras;




function eventoPulsarTecla(){
    var consulta = $(this).val();
    // Cada vez que venga un dato consulta en la BD con AJAX
    if( consulta != ''){
        $.ajax({
        url: "search.php",
        method: "POST",
        data: {consulta: consulta},
        success: function mostrarEventos(datos){
            $("#lista_eventos").fadeIn();
            $("#lista_eventos").html(datos);
        }
        });
    }
    else{
        $("#lista_eventos").fadeOut();
    }
    // Al hacer clic se autocompleta el cuadro
    $(document).on('click', 'li', function(){
        $('#buscador').val($(this).text());
        $("#lista_eventos").fadeOut();
    })
}

function cargarDatos(){
    $('#buscador').keyup(eventoPulsarTecla);
}


$(document).ready(cargarDatos);

// TODO Anidarlo
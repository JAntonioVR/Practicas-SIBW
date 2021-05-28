{% extends formularios.html %}

{% block cabecera %}

<title>Buscador Eventos Publicados</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!--<script src="./java/ajax.js"></script>-->

{% endblock %}

{% block formulario %}

    <div class="container">
        <label>Introduce el evento:</label><br>
        <input type="text" name="evento" id="evento" class="form-control" placeholder="Nombre del evento">
        <div id="listaEventos"></div>

    </div>

{% endblock %}
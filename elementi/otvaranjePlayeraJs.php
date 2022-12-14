<script>
    $(".listaR").click(function() {
        var idGlazbe = $(this).attr('id');
        var user = $(this).parent().parent().attr('id');
        window.location = "player.php?idglazbe="+idGlazbe+"&iduser="+user;
    });
    $(".prikazListaS").click(function() {
        var lista = $(this).attr('id');
        window.location = "player.php?lista="+lista;
    });
</script>
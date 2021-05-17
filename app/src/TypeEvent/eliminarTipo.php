<html>
    <header>
        <title> Eliminar Tipo de Evento </title>
    </header>
    <body>
        <center>
            <?php
                $id_tipo = $_GET["id_tipo"];

                $link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");
                $query = "DELETE FROM tipoevento WHERE id_tipo = $id_tipo";
                $result = pg_query($link,$query) or die ("Query failed " . pg_errormessage($link));
                echo "Eliminado con exito!";
                pg_close($link)
            ?><br>
            <button><a href="AdminTipoEvento.html"> Regresar </a></button>
        </center>
    </body>
</html>
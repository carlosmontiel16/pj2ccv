<html lang="es">
    <head>
        <title>
            Modificando Tipo de Evento
        </title>
    </head>
    <body>
        <center>
            <?php
                $id_tipo = $_POST["id_tipo"];
                $nombre = $_POST["nombre"];

                $link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");
                
                $query = "UPDATE tipoevento SET nombre = '$nombre' WHERE id_tipo = $id_tipo";

                $result = pg_query($link,$query) or die ("Query failed " . pg_errormessage($link));

                echo "Tipo Evento insertada con exito!";
                pg_close($link);
            ?><br><br>
            <button><a href="AdminTipoEvento.html"> Regresar </a></button>
        </center>
    </body>
</html>
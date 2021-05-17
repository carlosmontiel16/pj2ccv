<html lang="es">
    <head>
        <title>
            Modificando Tipo de Evento
        </title>
        <style>
        button{
            background-color: navy;
            width: 85px;
            height: 50px;
            color: white;
        }   
        a{
            text-decoration: none;
            color: white;
            font-weight: bold;
            font-size: medium;
        }
        </style>
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
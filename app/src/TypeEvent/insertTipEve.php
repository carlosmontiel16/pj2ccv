<html>
    <header>
        <title> Insertado </title>
    </header>
    <body>
        <center>
            <?php

                    $id_tipo = $_GET["id_tipo"];
                    $nombre = $_GET ["nombre"];
                    
                    $link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");

                    $query = "INSERT INTO tipoeventos VALUES ($id_tipo,'$nombre')";
    
                    $result = pg_query($link,$query) or die ("Query failed " . pg_errormessage($link));
                    echo "Tipo Evento insertada con exito!";

                    pg_close($link);

            ?><br>
           <button onclick="self.close()">Cerrar</button>
        </center>
    </body>
</html>
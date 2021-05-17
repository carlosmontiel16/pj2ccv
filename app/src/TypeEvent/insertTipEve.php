<html>
    <header>
        <title> Insertado </title>
        <style>
        button{
            background-color: navy;
            width: 50px;
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
    </header>
    <body>
        <center>
            <?php

                    $id_tipo = $_GET["id_tipo"];
                    $nombre = $_GET ["nombre"];
                    
                    $link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");

                    $query = "INSERT INTO tipoevento VALUES ($id_tipo,'$nombre')";
    
                    $result = pg_query($link,$query) or die ("Query failed " . pg_errormessage($link));
                    echo "Tipo Evento insertada con exito!";

                    pg_close($link);

            ?><br>
           <button onclick="self.close()">Cerrar</button>
        </center>
    </body>
</html>
<html>
    <header>
        <title> Eliminar Tipo de Evento </title>
    </header>
    <style>
        a{
            text-decoration: none;
            color: white;
            font-weight: bold;
            font-size: medium;
        }
        button{
            background-color: navy;
            width: 150px;
            height: 50px;
        }
    </style>
    <body>
        <center>
            <?php
                $id_evento = $_GET["id_evento"];

                $link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");
                $query = "DELETE FROM eventos WHERE id_evento=$id_evento";
                $result = pg_query($link,$query) or die ("Query failed " . pg_errormessage($link));
                echo "Eliminado con exito!";
                pg_close($link)
            ?><br>
            <button><a href="AdminEvento.html"> Regresar </a></button>
        </center>
        
    </body>
</html>
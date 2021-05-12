<html>
    <header>
        <title>
            Modificando Tipo de Evento
        </title>
    </header>
    <body>
        <center>
            <h3> Modificando Tipo de Evento </h3>
            <form action="modifbase.php" method="POST">
                <?php
                    $id_tipo = $_GET["id_tipo"];
                    $nombre = $_GET["nombre"];

                    echo "<b> Id_tipo: </b> $id_tipo";
                    echo "<input type=hidden name=id_tipo value=$id_tipo required><br><br>\n";
                    echo "<b>Nombre: </b>";
                    echo "<input type=text name=nombre value='$nombre'> <br><br>\n";
                ?>
                <input type="submit" value="Enviar">
            </form>
            <button><a href="AdminTipoEvento.html"> Regresar</a></button>
        </center>
    </body>
</html>
<html>
    <head>
        <title>Por dia</title>
    </head>
    <style>
        .header{
            background-color: navy;
            color: white;
        }
        button{
            background-color: navy;
            width: 100px;
            height: 30px;
            color: white;
        }   
        a{
            text-decoration: none;
            color: black;
            font-weight: bold;
            font-size: medium;
            text-align: center;
        }
        .regresar{
            text-decoration: none;
            color: white;
            font-weight: bold;
            font-size: medium;
            text-align: center;
        }
    </style>
    <body>
        <center>
            <?php
            $day = $_GET["day"];
            $month = $_GET["month"];
            $year = $_GET["year"];

            
            if($month < 10){
                if($day < 10){
                    $date = "$year-0$month-0$day";
                }
                $date = "$year-0$month-$day";

            }else{
                $date = "$year-$month-$day";
            }
            
            setlocale(LC_TIME,"Spanish_Guatemala","es_ES.UTF-8");
			$large_date = strftime("%A, %d de %B de %Y",strtotime($date));             
            $link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");              
            
            echo "<table border=1>";
            echo "<tr class=header>\n";
            echo "<th colspan=5><h3>$large_date</h3></th>\n";
            echo "</tr>\n";

            echo "<tr>\n";
            echo "<th>Hora</th>\n";
            echo "<th colspan =4>Descripcion</th>\n";
            echo "</tr>";

            $horaarrays = ['00:00','01:00','02:00','03:00','04:00','05:00','06:00','07:00','08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00'];
            $i=0;
            echo "<tr>\n";
            while($i < sizeof($horaarrays)){
            $hora_inicio = date('H:i',strtotime("$horaarrays[$i]"));
                
            if($i == 12){
                $i_aux = $i;
                $hora_fin = date('H:i',strtotime("20:59:59"));
            }else{
                $i_aux = $i;
                $hora_fin = date('H:i',strtotime("$horaarrays[$i_aux] + 59 minutes"));
            }
            echo "<th>$hora_inicio</th>";
            $query = "SELECT titulo_evento,hora FROM eventos WHERE fecha_inicio = '$date' ORDER BY hora";
            $result = pg_query($link,$query) or die ("Query failed " . pg_errormessage($link));
            while($line = pg_fetch_array($result,null,PGSQL_ASSOC)){
                $titulo_evento = $line["titulo_evento"];
                $hora = $line ["hora"];
                if(($hora >= "$hora_inicio")  AND ($hora < "$hora_fin")){
                    echo "<td><a href=./verevento.php?year=$year&month=$month&day=$day>$titulo_evento</a></td>\n";
                }else{
                    //echo "<td></td>\n";
                }
            }
            $i++;
            echo "</tr>";
            }
            echo "</table>";
            pg_close($link)
            ?><br><br>
            <button><a class="regresar" href="../index.php">Regresar</a></button>
        </center>
    </body>
</html>
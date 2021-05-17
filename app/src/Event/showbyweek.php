<?php 
if(isset($_GET)){
	$weeks = 1;
	$date = $_GET["year"]."-".$_GET["month"]."-"."01";
	$olddate = "";
	if(isset($_GET["weekn"])){
		$fecha=date( "Y-m-d", strtotime( "$date +".$_GET["weekn"]." week" ) );
	}
	else{
		$fecha=date( "Y-m-d", strtotime( "$date +1 week" ) );
		
	}
	$olddate = date( "Y-m-d", strtotime( "$fecha -1 week" ) );
	
	
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>ver por semana</title>
	 <style>
        .header{
            background-color: navy;
            color: white;
            border: solid 1px black;
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
        table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
    </style>
</head>
<body>
	<div hidden="true" >
		
		<?php 
		if(isset($_GET["weekn"])){ 
			
			echo '<input type="text" name="" id="semana" value=" '.$_GET["weekn"].'">';
		}else {
			echo '<input type="text" name="" id="semana" value=" '. "1".'">' ;
		}
		?>
		
		<?php echo '<input type="text" name="" id="year" value=" '.$_GET["year"].'">' ?>
		<?php echo '<input type="text" name="" id="month" value=" '.$_GET["month"].'">' ?>
	</div>
	<button onclick="back();">Atras <-</button>
<center style="position: relative; width: 90%; left: 5%;">
	<button onclick="disminuirSemana();"> - </button>
	<h4>Fecha inicio: <?php echo $date; ?> (1) </h4>
	<h4> <?php echo $fecha; if (isset($_GET["weekn"])){ echo "(".$_GET["weekn"].")";}else{ echo "(1)";}  ?> </h4>
	<button onclick="aumentarSemana();"> + </button>
	 <table style="width:100%">
  <tr>
    <th id="weekn" colspan="3">Semana <?php if (isset($_GET["weekn"])){ echo $_GET["weekn"];}else{ echo 1;} ?></th>

  </tr>
  <?php
  	 $link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");
  	 				for ($i=0; $i < 7 ; $i++) { 
  	 					# code...
  	 					$current_day = date( "Y-m-d", strtotime( "$olddate +".$i." day" ) );
  	 					 $query = "SELECT * FROM eventos where fecha_inicio = '$current_day'";
                    $result = pg_query($link,$query) or die ("Query failed" . pg_errormessage($link));
 
                    		echo "<tr>";
                    		$m = $_GET["month"];
                    		$a = $_GET["year"];
                    		$d = date( "d", strtotime( "$current_day" ) );
                    		echo '<td>'.date( "D", strtotime( "$current_day" ) ) .'' . date( "m-d", strtotime( "$current_day" ) ).'</td>';
   
                    while($line = pg_fetch_array($result,null,PGSQL_ASSOC)){

                    	echo '<td><a href="javascript:viewDayEvents('.$a.','.$m.','.$d.')"> '.$line["titulo_evento"].'<img  src="../img/visibility.png" id="img_v202154" style="position: fixed; width: 10px; height: 10px; left: 30%; top: 0%; display: none;"> </a></td>';
                    }
                    		echo "</tr>";
  	 				}
                   
   ?>
</table> 


</center>
</body>
<script type="text/javascript">
	function aumentarSemana(){	
		var semana =  document.getElementById("semana").value;
		semana = parseFloat(semana);
		semana = semana +1;
		var year = document.getElementById("year").value;
		year = parseFloat(year);
		var month = document.getElementById("month").value;
		month = parseFloat(month);
		location.href = './showbyweek.php?weekn='+semana+'&month='+month+'&year='+year;
	}
	function disminuirSemana(){
		var semana =  document.getElementById("semana").value;
		semana = parseFloat(semana);
		semana = semana -1;
		var year = document.getElementById("year").value;
		year = parseFloat(year);
		var month = document.getElementById("month").value;
		month = parseFloat(month);
		location.href = './showbyweek.php?weekn='+semana+'&month='+month+'&year='+year;

	}
	function back(){
		location.href = '../';
	}
	
	function viewDayEvents(a, m, d){
		console.log("Ver eventos del dia");
		location.href = "./vereventopordia.php?year="+a+"&month="+m+"&day="+d;
	}

</script>
</html>
<?php

if(isset($_GET)){
	if(isset($_GET["year"]) && isset($_GET["month"])){
		$m = (int)$_GET["month"];
		$m2 = $m+1;
		$var =  "".$_GET['year']."-".$_GET['month'] . "-01";
		$var2 = "".$_GET['year']."-".$m2 . "-01";
		$month = date(strtotime($var));
		$month2 = date(strtotime($var2));
		$sql = "SELECT fecha_inicio FROM eventos where fecha_inicio >= '$var' AND fecha_inicio <= '$var2'";
		$link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");
		$result = pg_query($link,$sql) or die ("Query failed" . pg_errormessage($link));
		$arr = array();
		while($line = pg_fetch_array($result,null,PGSQL_ASSOC)){
                     
                       array_push($arr, $line["fecha_inicio"]);
                    }
                    $arr = array_unique($arr);
        echo json_encode($arr);
	}
}

?>
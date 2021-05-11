<!DOCTYPE html>
<html>
<head>
	<title>Proyecto 2</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</head>
<body class="bg-light text-dark">
	<div style="width: 80%; height: 100%; margin-left: 10%; margin-right: 10%; background-color: Lavender;">
		<h4>¡Bienvenido!</h4>
		<h3 id="idhour"> </h3>
		<center>
		<div class="btn-group"  role="group" aria-label="Basic example">
		  <button type="button" onclick="inicio()" class="btn btn-primary">Inicio</button>
		  <button type="button" class="btn btn-primary">Administracion de Calendario</button>
		  <button type="button" class="btn btn-primary">Reportes</button>
		</div>
		</center>
	</div>


</body>

<!-- Init handlers-->

<script type="text/javascript">
	window.onload = function() {
  initHour();

};
function initHour(){
	var headerhour = document.getElementById("idhour");
	headerhour.innerHTML = getClientDate();
	setTimeout(initHour , 1000);
}

function refreshHour(){

}
</script>
<!-- Get current date-->
<script type="text/javascript"> 


function getClientDate(){
var currentdate = new Date(); 
var datetime = "" + currentdate.getDate() + "/"
            + (currentdate.getMonth()+1)  + "/" 
            + currentdate.getFullYear() + " "  
            + currentdate.getHours() + ":"  
            + currentdate.getMinutes() + ":" 
            + currentdate.getSeconds();
           return datetime;
}
</script>

<!-- function handlers -->

<script type="text/javascript">
	function inicio(){
		location.href = "./index.php"
	}
</script>
</html>
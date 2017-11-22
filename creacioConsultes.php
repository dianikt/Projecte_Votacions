<?php
    include('session.php');
    if($login_session!="admin"){
        header("location: profile.php");
    }
?>
<html>
 <head>
	 <meta charset="utf-8">
    <title>Creación de preguntas</title>
     <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
     <link href="css/style.css" rel="stylesheet" type="text/css">
    <script href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    <script type="text/javascript">
        $("#datetime").datetimepicker({ format: 'yyyy-mm-dd hh:ii'});
    </script>
 </head> 
	 <body>

         <ul>
             <li><a href="profile.php">Perfil</a></li>
             <li><a href="consultas.php">Consultas</a></li>
             <?php
             if($login_session=="admin"){
                 echo "<li><a class='active' href='creacioConsultes.php'>Crear Consulta</a></li>";
             }
             ?>
             <li id="logout"><a href="logout.php"><i><?php echo $login_session; ?></i> Cerrar Sesion</a></li>
         </ul>
	   	<form method="POST" action="creacioConsultes.php">
	  		<label>Crea la pregunta:</label>	  		
	  		<input type="text" name="pregunta"><br>
	  		<label>Introduce la fecha de inicio:</label>
	  		<input id="datetime"  readonly>
	  		<label>Introduce la fecha final:</label>
	  		<input id="datetime" readonly>
	  		<input type="submit" value="envia">
	  	</form>  
	  	 	<?php
		  	 include 'conexionBD.php';		 
		      //preparem i executem la consulta
		if((isset($_POST["pregunta"])) && (isset($_POST["fecha_inicio"])) && (isset($_POST["fecha_final"]))){
				      $query = $pdo->prepare("INSERT INTO consultes (titulo, fecha_inicio, fecha_final) VALUES ('".$_POST["titulo"]."','".$_POST["fecha_inicio"]."', '".$_POST["fecha_final"]."')");
				      $query->execute();
		 		}else echo '<script language="javascript">alert("Debe rellenar todos los campos!");</script>'; 
	  		?>      
	</body>
</html>


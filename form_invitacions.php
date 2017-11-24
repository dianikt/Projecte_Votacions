<?php
    include('session.php');
?>
<html>
 <head>
 <meta charset="utf-8">
	  <title>Envia invitaciones</title>
	  <link href="css/style.css" rel="stylesheet" type="text/css">
   </head> 
    <body>
	  <ul id="encabezado">
             <li><a href="profile.php">Perfil</a></li>
             <li><a href="consultas.php">Consultas</a></li>
             <?php
             if($login_session=="admin"){
                 echo "<li><a  href='creacioConsultes.php'>Crear Consulta</a></li>";
                  echo "<li><a class='active' href='form_invitacions.php'>Invitar consulta</a></li>";
             }
             ?>
             <li id="logout"><a href="logout.php"><i><?php echo $login_session; ?></i> Cerrar Sesion</a></li>
       </ul>
	   <h3>Invitaciones</h3>
	  	<form method="POST" action="form_invitacions.php">
	  		<label>Introduce un nuevo email:</label>
	  		<input type="email" name="email">
	  		<input type="submit" value="envia">
	  	</form>  
	  	<?php
		  	 include 'conexionBD.php';		 
		      //preparem i executem la consulta
		  	 if(isset($_POST["email"])){
			      $query = $pdo->prepare("INSERT INTO invitacions (email) VALUES ('".$_POST["email"]."')");
			      $query->execute();
			  }
	  	?>
      <footer>
          <p>Created by: Diana, Dani</p>
      </footer>
	</body>
</html>


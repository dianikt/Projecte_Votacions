<html>
 <head>
 <meta charset="utf-8">
  <title>Envia invitaciones</title>
  <style>
     table,td {
      border: 1px solid black;
      border-spacing: 0px;
    }
  </style>
 </head> 
	 <body>
	  <h3>Invitaciones</h3>
	  	<form method="POST" action="form_invitacions.php">
	  		<label>Introduce un nuevo email:</label>
	  		<input type="text" name="email">
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
	</body>
</html>


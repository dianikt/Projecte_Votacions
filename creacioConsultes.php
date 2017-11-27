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
     <link href="css/style.css" rel="stylesheet" type="text/css"/>
     <script src="js/javascript.js"></script>
 </head> 
	 <body>
         <ul id="encabezado">
             <li><a href="profile.php">Perfil</a></li>
             <li><a href="consultas.php">Consultas</a></li>
             <?php
             if($login_session=="admin"){
                 echo "<li><a class='active' href='creacioConsultes.php'>Crear Consulta</a></li>";
                 echo "<li><a href='form_invitacions.php'>Invitar consulta</a></li>";
             }
             ?>
             <li id="logout"><a href="logout.php"><i><?php echo $login_session; ?></i> Cerrar Sesion</a></li>
         </ul>
         <div class="contenido">       
            <input type="button" value="Crea Consulta" onclick="Votaciones()">
            
            <?php include 'conexionBD.php'; ?>      
          
            <?php
                    if(isset($_POST['consulta'])){  
                   
                    echo $_POST['consulta'];
                    echo $_POST['fecha_inicio'];

                    $query = $pdo->prepare("INSERT INTO `consultes`(`id_consulta`, `pregunta`, `fecha_inicio`, `fecha_final`) VALUES (null,'".$_POST["consulta"]."','".$_POST["fecha_inicio"]."', '".$_POST["fecha_final"]."')");
                    $query->execute();
                    unset($_POST['consulta']);               
                    
                 }
                

               
            ?>
           <form action="" method="POST">
             <div id= "crearConsultas"></div>
             <div id="crearRespuesta"></div>
             <div id="inputRespuesta"></div>
             <ol id="listaDesordenada"></ol>
             <div id="enviarPreguntas"></div>
         </div>        
         <footer>
             <p>Created by: Diana, Dani</p>
         </footer>
	</body>

</html>


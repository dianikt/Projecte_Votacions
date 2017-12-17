<?php
    include('session.php');
?>
<html>
 <head>
 <meta charset="utf-8">
	  <title>Envia invitaciones</title>
	  <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="js/java.js"></script>
   </head> 
    <body>
        <?php
        //preparem i executem la consulta
        if(isset($_POST["email"])){
            $query = $pdo->prepare("INSERT INTO invitacions (id_invitacio, email, id_consulta, haVotado) VALUES (null, '".$_POST["email"]."','".$_POST["id"]."', 0)");
            $query->execute();
          
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: Vota@proyectevota.org"  . "\r\n";
            $mensaje = "Ha sido invitado a una consulta.";
            mail($_POST["email"], 'Invitació per Votar', $mensaje, $headers);
            
         }
        ?>
        <ul id="encabezado">
             <li><img src="img/logo.png" style="width: 43px"></li>
              <?php
              if($login_session!="admin"){
                  echo "<li><a href='profile.php'>Perfil</a></li>";
              }
              ?> 
             
        <?php
            if($login_session!="admin"){
                echo "<li><a href='consultas.php'>Consultas</a></li>";
            }
        ?>             <?php
             if($login_session=="admin"){
                 echo "<li><a  href='creacioConsultes.php'>Crear Consulta</a></li>";
                  echo "<li><a class='active' href='form_invitacions.php'>Invitar consulta</a></li>";
             }
             ?>
             <li id="logout"><a href="logout.php"><i><?php echo $login_session; ?></i> Cerrar Sesion</a></li>
        </ul>
        <div class="contenido">
            <h3>Invitaciones</h3>

            <form method="POST" action="form_invitacions.php">
                <label>Introduce un nuevo email:</label>
                <input type="email" name="email"><br>
                <label>Introduce un id existente:</label>
                <select name="id">Elige una consulta 
                <option type="text">Selecciona una consulta</option> 
                      <?php
                            $preguntas = $pdo->prepare("select id_consulta, pregunta from consultes");
                            $preguntas->execute();
                            $fila = $preguntas->fetch();             
                            
                            while($fila){ ?>                              
                              <option style="120px;" type="text" value="<?php echo $fila['id_consulta'];?>">  <?php echo $fila['pregunta'];?></option>             
                               
                      <?php
                            $fila = $preguntas->fetch();
                            }
                        ?>
                  </option>
                  </select><br>
                <input type="submit" value="envia">
            </form>
            <table>
                
            </table>

        </div>
           <aside id="aside_letf">              
                <img class="imagen" id="imagen" src = ""  /></a>
                <img class="imagen" id="imagen1" src = "" /></a>        
                <img class="imagen" id="imagen2" src = "" /></a>               
            </div>
         </aside>
        <footer>
          <p>Created by: Diana, Dani</p>
        </footer>
	</body>
</html>


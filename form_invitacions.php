<?php
    include('session.php');
?>
<html>
 <head>
 <meta charset="utf-8">
	  <title>Envia invitaciones</title>
	  <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="js/java.js"></script>
    <script src="js/javascript.js"></script>
   </head>
    <body>
        <div id="error" class=""></div>
        <div id="correcto" class=""></div>
        <?php
        //preparem i executem la consulta
        if(isset($_POST["email"])){
            $mails=explode(", ",$_POST['email']);
            for($x=0;$x<count($mails);$x++){
                if (filter_var($mails[$x], FILTER_VALIDATE_EMAIL)) {
                    $comprobarSiYaEstaInvitado = $pdo->prepare("select count(email) existe from invitacions where email='" . $mails[$x] . "' && id_consulta='" . $_POST["id"] . "'");
                    $comprobarSiYaEstaInvitado->execute();
                    $comprobarSiYaEstaInvitado1 = $comprobarSiYaEstaInvitado->fetch();
                    if ($comprobarSiYaEstaInvitado1['existe'] == 0) {
                        $query = $pdo->prepare("INSERT INTO invitacions (id_invitacio, email, id_consulta, haVotado) VALUES (null, '" . $mails[$x] . "','" . $_POST["id"] . "', 0)");
                        $query->execute();
                        $comprobar = $pdo->prepare("select count(email) existe, usuari from usuaris where email='" . $mails[$x] . "'");
                        $comprobar->execute();
                        $comprobar1 = $comprobar->fetch();
                        if ($comprobar1['existe'] == 1) {
                            $comprobarPendientes = $pdo->prepare("select count(id_invitacio) invitaciones from invitacions where email='" . $mails[$x] . "'");
                            $comprobarPendientes->execute();
                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                            $headers .= "From: Vota@proyectevota.org" . "\r\n";
                            $mensaje = "Querido " . $comprobar['usuari'] . ".\n\n
                                        Tienes una nueva consulta pendiente. \n 
                                        Tienes " . $comprobar['usuari'] . " consultas pendientes.\n\n
                                        Saludos, hasta pronto.";
                            mail($email[$x], 'Invitació per Votar', $mensaje, $headers);
                        } else {
                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                            $headers .= "From: Vota@proyectevota.org" . "\r\n";
                            $mensaje = "Querido usuario.\n\n
                                        Te han invitado a una nueva consulta.
                                        Registrate aqui y accede: \n http://www.aws2-userdani.tk/~dani/registro.php \n\n
                                        Esperamos con entusiasmo su voto!\nSaludos.";
                            mail($email[$x], 'Invitació per Votar', $mensaje, $headers);
                        }
                    }
                    else{
                        echo "<script>error('El usuario con el mail: ".$mails[$x]." ya esta invitado a esta consulta.')</script>";
                    }
                }
                else{
                    echo "<script>error('La dirección de correo ".$mails[$x]." no es valida.')</script>";
                }
            }

          

            
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

            <form method="POST" action="form_invitacions.php" id="invi">
                <label>Introduce un nuevo email:</label><br>
                <textarea placeholder="example@example.com, other@example.com" rows="4" cols="50" name="email" form="invi"></textarea><br>
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


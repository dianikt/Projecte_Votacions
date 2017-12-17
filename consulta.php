
<?php
    include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mi perfil</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="js/snow.js"></script>
    <script src="js/jquery.snow.js"></script>
    <script src="js/java.js"></script>
</head>
<body>
    <ul id="encabezado">
        <li><img src="img/logo.png" style="width: 43px"></li>
        <li><a href="profile.php">Perfil</a></li>
        <?php
            function randHash($len=32)
            {
                return substr(md5(openssl_random_pseudo_bytes(5)),-$len);
            }
	        if($login_session=="admin"){
	            echo "<li><a href='creacioConsultes.php'>Crear Consulta</a></li>";
	            echo "<li><a href='form_invitacions.php'>Invitar consulta</a></li>";
	        }
        ?>
         <?php
            if($login_session!="admin"){
                echo "<li><a href='listadoConsultas.php'>Lista consultas</a></li>";
            }
        ?>  
        <li id="logout"><a href="logout.php"><i><?php echo $login_session; ?></i> Cerrar Sesion</a></li>
    </ul>
    <div class="contenido">
        <?php
            if(isset($_POST['respuesta'])){
                $passwd=sha1($_POST['password']);
                $comprobar_contra = $pdo->prepare("select id_usuari from usuaris where password='$passwd'");
                $comprobar_contra->execute();
                $row = $comprobar_contra->fetch();
                if($row['id_usuari']==$id_session){
                    $cambiarHaVotado = $pdo->prepare("UPDATE invitacions SET haVotado = 1 WHERE email = '".$email_session."' and id_consulta = '".$_POST['id_consulta']."'");
                    $cambiarHaVotado->execute();
                    $comprobarCantidadVotos = $pdo->prepare("select num_votos from respuestas where id_respuesta='".$_POST['respuesta']."'");
                    $comprobarCantidadVotos->execute();
                    $votos = $comprobarCantidadVotos->fetch();
                    $suma = $votos['num_votos']+1;
                    $sumarVoto = $pdo->prepare("UPDATE `respuestas` SET `num_votos` = '".$suma."' WHERE `respuestas`.`id_respuesta` = '".$_POST['respuesta']."'");
                    $sumarVoto->execute();
                    $rand = randHash(20);

                    $insertVotoOpcion = $pdo->prepare("INSERT INTO `voto_opcion` (`hash`, `id_respuesta`) VALUES ('".$rand."', '".$_POST['respuesta']."')");
                    $insertVotoOpcion->execute();

                    $insert = $pdo->prepare("INSERT INTO `votos` (`id_votos`, `hash_enc` , `id_usuari`) VALUES (NULL, aes_encrypt('".$rand."', '".$_POST['password']."'), '".$id_session."')");
                    $insert->execute();
                    unset($_POST['respuesta']);
                    unset($_POST['password']);
                    header('location: listadoConsultas.php');
                }
                else{
                    echo "ERROR: contraseña incorrecta";
                }
            }
           
           if(isset($_POST['id_consulta'])){ 
                $id_consulta = $_POST['id_consulta'];                
                echo "<form action='' method='post'>";
                $consulta = $pdo->prepare("select id_consulta, pregunta, fecha_inicio, fecha_final from consultes where id_consulta='$id_consulta'");
                $consulta->execute();
                $fila = $consulta->fetch();
                
                echo "<label>Fecha inicio: ".$fila['fecha_inicio']."</label><br>";
                echo "<label>Fecha final: ".$fila['fecha_final']."</label><br>";
                echo "<label>Pregunta: ".$fila['pregunta']."</label><input name='id_consulta' value='".$fila['id_consulta']."' style='display: none'><br>";
                echo "<label>Respuestas:</label><br>";
                echo "<div class='respuestas'>";
                
                $respuesta = $pdo->prepare("select id_respuesta, respuesta from respuestas where id_consultas='$id_consulta'");
                $respuesta->execute();
                $fila_respuesta = $respuesta->fetch();
                
                while ( $fila_respuesta ) {
                    echo "<input type='radio' name='respuesta' value='".$fila_respuesta['id_respuesta']."'>".$fila_respuesta['respuesta']."<br>";
                    $fila_respuesta = $respuesta->fetch();                   
                } 
               


               echo "</div><br>";
                echo "<label>Introdüir contrasenya: </label>";
                echo "<input type='password' name='password' required/>";
                echo "<input type='submit' value='Enviar respuesta'/></form><br>";


            }else {
                echo "<p>Gracias por Contestarnos!!!</p>";
            }
        ?>
    </div>
    <aside id="aside_letf">
        <img class="imagen" id="imagen" src = "" /></a>
        <img class="imagen" id="imagen1" src = ""/></a>        
        <img class="imagen" id="imagen2" src = ""/></a>               
    </aside>
    <footer>
        <p>Created by: Diana, Dani</p>
    </footer>
</body>
<script src="js/desplazamineto.js"></script>
<script>
    $(document).ready( function(){
        $.fn.snow({ minSize: 5, maxSize: 50, newOn: 120, flakeColor: '#BBABAB' });

    });
</script>
</html>
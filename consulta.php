
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
                $insert = $pdo->prepare("INSERT INTO `votos` (`id_votos`, `id_respuesta`, `id_usuari`) VALUES (NULL, '".sha1($_POST['respuesta'])."', '".$_SESSION['id_usuari']."')");
                $insert->execute();
                unset($_POST['respuesta']);
                header('location: listadoConsultas.php');
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
               
                $insert = $pdo->prepare("UPDATE invitacions SET haVotado = 1 WHERE email = '$email_session' and id_consulta = '$id_consulta'");
                $insert->execute();           

                echo "</div><br>";
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
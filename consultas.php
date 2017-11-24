<?php
    include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mi perfil</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <ul id="encabezado">
        <li><a href="profile.php">Perfil</a></li>
        <li><a class="active" href="consultas.php">Consultas</a></li>
        <?php
        if($login_session=="admin"){
            echo "<li><a href='creacioConsultes.php'>Crear Consulta</a></li>";
            echo "<li><a href='form_invitacions.php'>Invitar consulta</a></li>";
        }
        ?>
        <li id="logout"><a href="logout.php"><i><?php echo $login_session; ?></i> Cerrar Sesion</a></li>
    </ul>
    <div id="consultas">
        <?php
            if(isset($_POST['respuesta'])){
                $insert = $pdo->prepare("INSERT INTO `votos` (`id_votos`, `id_respuesta`, `id_usuari`) VALUES (NULL, '".$_POST['respuesta']."', '".$_SESSION['id_usuari']."')");
                $insert->execute();

                $delete = $pdo->prepare("DELETE FROM `invitacions` WHERE id_consulta='".$_POST['id_consulta']."' and email='".$_SESSION['user_mail']."' ");
                $delete->execute();
                unset($_POST['respuesta']);
                unset($_POST['id_consulta']);

            }
            $coger_email = $pdo->prepare("select id_usuari, email, usuari from usuaris where usuari='$user_check'");
            $coger_email->execute();
            $row = $coger_email->fetch();
            $user_mail =$row['email'];
            $_SESSION['user_mail']=$user_mail;
            $_SESSION['id_usuari']=$row['id_usuari'];

            $comprobar_invitaciones = $pdo->prepare("select id_consulta, email from invitacions where email='$user_mail'");
            $comprobar_invitaciones->execute();
            $row = $comprobar_invitaciones->fetch();

            while ($row) {
                $id_consulta = $row['id_consulta'];
                echo "<form action='' method='post'>";
                $consulta = $pdo->prepare("select id_consulta, pregunta, fecha_inicio, fecha_final from consultes where id_consulta='$id_consulta'");
                $consulta->execute();
                $fila = $consulta->fetch();
                echo "<label>Fecha inicio: ".$fila['fecha_inicio']."</label><br>";
                echo "<label>Fecha final: ".$fila['fecha_final']."</label><br>";
                echo "<label>Pregunta: ".$fila['pregunta']."</label><input name='id_consulta' value='".$fila['id_consulta']."' style='display: none'><br>";
                echo "<label>Respuestas:</label><br>";
                $respuesta = $pdo->prepare("select id_respuesta, respuesta from respuestas where id_consultas='$id_consulta'");
                $respuesta->execute();
                $fila_respuesta = $respuesta->fetch();
                while ( $fila_respuesta ) {
                    echo "<input type='radio' name='respuesta' value='".$fila_respuesta['id_respuesta']."'>".$fila_respuesta['respuesta']."<br>";
                    $fila_respuesta = $respuesta->fetch();
                }
                $fechaInicio = explode('-', $fila['fecha_inicio']);
                $fechaFinal = explode('-', $fila['fecha_final']);
                if(($_SESSION['day']<$fechaInicio[2] and $_SESSION['mon']<$fechaInicio[1] and $_SESSION['year']<$fechaInicio[0])and($_SESSION['day']>$fechaFinal[2] and $_SESSION['mon']>$fechaFinal[1] and $_SESSION['year']>$fechaFinal[0])){
                    echo "<input type='submit' value='Enviar respuesta' disabled/></form><br>";
                }
                else{
                    echo "<input type='submit' value='Enviar respuesta'/></form><br>";

                }

                $row = $comprobar_invitaciones->fetch();
            }





        ?>
    </div>
    <footer>
        <p>Created by: Diana, Dani</p>
    </footer>
</body>
</html>
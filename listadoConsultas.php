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
                echo "<li><a class='active' href='listadoConsultas.php'>Lista consultas</a></li>";
            }
        ?>  
        <li id="logout"><a href="logout.php"><i><?php echo $login_session; ?></i> Cerrar Sesion</a></li>
    </ul>
    <div class="contenido">
         <?php
                          
            $coger_email = $pdo->prepare("select id_usuari, email, usuari from usuaris where usuari='$user_check'");
            $coger_email->execute();
            $row = $coger_email->fetch();
            $user_mail =$row['email'];
            $_SESSION['user_mail']=$user_mail;
            $_SESSION['id_usuari']=$row['id_usuari'];
            $idUsuari=$row['id_usuari'];
            $comprobar_invitaciones = $pdo->prepare("select count(id_consulta) consulta from invitacions where email='$user_mail'");
            $comprobar_invitaciones->execute();
            $row = $comprobar_invitaciones->fetch();

            if($row['consulta']!='0'){
                $invitaciones = $pdo->prepare("select id_consulta, email, haVotado from invitacions where email='$user_mail'");
                $invitaciones->execute();
                $row = $invitaciones->fetch();
                $contador = 0;
                
                echo"<table id='listaConsult'>";                
                        echo "<tr class='fila'>
                            <td> Consulta </td>
                            <td> Ha votado </td>
                            <td> Voto </td>
                            <td> Fecha inicio </td>
                            <td> Fecha final </td>
                            <td>    Votar </td>
                        </tr>";
                while ($row) {
                    $id_consulta = $row['id_consulta'];
                    $haVotado = $row['haVotado'];
                    if ($haVotado == 1){
                        $havotado = 'Si';
                        $respu = $pdo->prepare("select id_consultas, id_respuesta, respuesta from respuestas where id_consultas=$id_consulta");
                        $respu->execute();
                        $rowRes = $respu->fetch();
                        while($rowRes){
                            $res=sha1($rowRes['id_respuesta']);
                            $respuesta = $pdo->prepare("select id_respuesta from votos where id_usuari='$idUsuari' && id_respuesta='$res'");
                            $respuesta->execute();
                            $rowRespuesta = $respuesta->fetch();
                            if($res===$rowRespuesta['id_respuesta']){
                                $voto=$rowRes['respuesta'];
                            }
                            $rowRes = $respu->fetch();
                        }
                    }
                    else {
                        $havotado = 'No';
                        $voto= '-';
                    }
                    $contador++;
                   
                    $consulta = $pdo->prepare("select id_consulta, pregunta, fecha_inicio, fecha_final from consultes where id_consulta='$id_consulta'");
                    $consulta->execute();
                    $fila = $consulta->fetch();
                    echo "<tr  class='fila'>";
                        echo "<td> ".$fila['pregunta']."</td>";
                        echo "<td> ".$havotado."</td>";
                        echo "<td> ".$voto."</td>";
                        echo "<td> ".$fila['fecha_inicio']."</td>";
                        echo "<td> ".$fila['fecha_final']."</td>";  

                        $fechaInicio = explode('-', $fila['fecha_inicio']);
                        $fechaFinal = explode('-', $fila['fecha_final']);

                        if(($_SESSION['day']<$fechaInicio[2] and $_SESSION['mon']<$fechaInicio[1] and $_SESSION['year']<$fechaInicio[0])and($_SESSION['day']>$fechaFinal[2] and $_SESSION['mon']>$fechaFinal[1] and $_SESSION['year']>$fechaFinal[0])){
                             echo "<td><input type='submit' value='votar' disabled/></td>";
                        }
                        else{
                            $id_consulta = $fila['id_consulta'];
                            echo "<td> 
                                <form action='consulta.php' method='POST'>                              
                                <input style='display:none' type='text' name ='id_consulta' value='".$id_consulta."'/>
                                <input type='submit'  value='votar'>
                                </form></td>";     
                        }
                        echo "</tr>";              
                    $row = $invitaciones->fetch();
                }
                echo"</table>";
            }
            else {
                echo "<p>No tienes consultas pendientes!</p>";
            }
        ?>         
    </div>
    <aside id="aside_letf">
                <img class="imagen" id="imagen" src = ""  /></a>
                <img class="imagen" id="imagen1" src = "" /></a>        
                <img class="imagen" id="imagen2" src = "" /></a>             
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
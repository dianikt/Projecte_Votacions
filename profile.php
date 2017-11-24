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
        <li><a class="active" href="profile.php">Perfil</a></li>
        <li><a href="consultas.php">Consultas</a></li>
        <?php
            if($login_session=="admin"){
                echo "<li><a href='creacioConsultes.php'>Crear Consulta</a></li>";
                echo "<li><a href='form_invitacions.php'>Invitar consulta</a></li>";
            }
        ?>

        <li id="logout"><a href="logout.php"><i><?php echo $login_session; ?></i> Cerrar Sesion</a></li>
    </ul>
    <div id="consultas">

    </div>
    <footer>
        <p>Created by: Diana, Dani</p>
    </footer>
</body>
</html>
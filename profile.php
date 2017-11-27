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
</head>
<body>
    <ul id="encabezado">
        <li><img src="img/logo.png" style="width: 43px"></li>
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
    <div class="contenido">

    </div>
    <footer>
        <p>Created by: Diana, Dani</p>
    </footer>
</body>
<script>
    $(document).ready( function(){
        $.fn.snow({ minSize: 5, maxSize: 50, newOn: 120, flakeColor: '#BBABAB' });

    });
</script>
</html>
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
    <ul>
        <li><a href="profile.php">Perfil</a></li>
        <li><a class="active" href="consultas.php">Consultas</a></li>
        <li id="logout"><a href="logout.php"><i><?php echo $login_session; ?></i> Cerrar Sesion</a></li>
    </ul>
    <div id="consultas">

    </div>
</body>
</html>
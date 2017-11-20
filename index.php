
<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesion</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
    header("location: profile.php");
}
?>
<div id="main">
    <h1></h1>
    <div id="login">
        <h2>Iniciar sesion</h2>
        <form action="" method="post">
            <label>Usuario:</label>
            <input id="name" name="username" placeholder="username" type="text">
            <label>Contraseña</label>
            <input id="password" name="password" placeholder="**********" type="password"><br><br>
            <input name="submit" type="submit" value="  Entrar  ">
            <span><?php echo $error; ?></span>
        </form>
    </div>
</div>
</body>
</html>

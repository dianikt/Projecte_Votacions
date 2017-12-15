
<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesion</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/style-login.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
include('login.php'); // Includes Login Script

    if(isset($_SESSION['login_user'])){

        if($user == 'admin'){
               header('location: creacioConsultes.php'); 
          }else{
             header("location: profile.php"); 
          }
    }
    ?>
    <div id="main">
         <div id="login">
            <h2>Iniciar sesion</h2><br><br>
            <form action="" method="post">
                <label>Usuario:</label>
                <input id="name" name="username" placeholder="username" type="text"><br><br>
                <label>Contraseña:</label>
                <input id="password" name="password" placeholder="**********" type="password"><br><br>
                <input name="submit" type="submit" value="  Entrar  ">
                <span><?php echo $error; ?></span>
            </form>
            <a id="reg" href="registro.php">Registrarse</a>
    </div>
</body>
</html>

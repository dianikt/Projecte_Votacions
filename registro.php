
<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesion</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/style-login.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
    include('conexionBD.php');  
    $error=''; // Variable To Store Error Message
    if (isset($_POST['submit'])) {
        if (empty($_POST['password']) || empty($_POST['password2']) ||  empty($_POST['usuario']) || empty($_POST['email'])) {
            $error = "Todos los campos deben estar llenos!!!";
        }
        else if ($_POST['password'] !== $_POST['password2']) {
            $error = "Las contraseñas deben ser iguales!!!";
        }
        else
        {
         // Define $username and $password            
            $usuario=$_POST['usuario'];
            $password=$_POST['password'];
            $email=$_POST['email'];
            $passw = SHA1($password);
            $query = $pdo->prepare("INSERT INTO usuaris (id_usuari, usuari, password, email)VALUES(NULL, '$usuario', '$passw', '$email')");           
            $row = $query->execute();    
            if ($row == 1){
                header("location: index.php"); 
            }else{
                $error = "No se ha podido insertar en la baase de datos";
            }
        }
    }
    unset($_POST['usuario']);
    unset($_POST['password']);
    unset($_POST['email']);
    ?>

    <div id="main">
         <div id="login">
            <h2>Registrarse</h2><br>
            <form action="" method="post">
                <label>Introduce un usuario:</label>
                <input id="name" name="usuario" placeholder="username" type="text"><br><br>
                <label>Introduce la contraseña</label>
                <input id="password" name="password" placeholder="**********" type="password"><br><br>
                <label>Repite la contraseña</label>
                <input id="password" name="password2" placeholder="**********" type="password"><br><br>
                <label>Introduce el email:</label>
                <input id="email" name="email" placeholder="email" type="text"><br><br><br>
                <input name="submit" type="submit" value="  Envia  ">
                <span><?php echo $error; ?></span>
            </form>            
        </div>
    </div>
</body>
</html>
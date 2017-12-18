
<!DOCTYPE html>
<html>
<head>
    <title>Registrarse</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/style-login.css" rel="stylesheet" type="text/css">
    <script src="js/javascript.js"></script>
</head>
<body>

    <div id="error" class=""></div>
    <div id="correcto" class=""></div>
    <?php
    include('conexionBD.php');  
    $error=''; // Variable To Store Error Message
    if (isset($_POST['submit'])) {
        if (empty($_POST['password']) || empty($_POST['password2']) ||  empty($_POST['usuario']) || empty($_POST['email'])) {
            echo "<script>error('Todos los campos deben estar llenos!!!')</script>";
        }
        else if ($_POST['password'] !== $_POST['password2']) {
            echo "<script>error('Las contraseñas deben ser iguales!!!')</script>";
        }
        else{
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $comprobarDatos = $pdo->prepare("select count(email) existe from usuaris where email='" . $_POST['email'] . "' || usuari='" . $_POST['usuario'] . "'");
                $comprobarDatos->execute();
                $comprobarDatos1 = $comprobarDatos->fetch();
                if($comprobarDatos1['existe']==0) {
                    // Define $username and $password
                    $usuario = $_POST['usuario'];
                    $password = $_POST['password'];
                    $email = $_POST['email'];
                    $passw = SHA1($password);
                    $query = $pdo->prepare("INSERT INTO usuaris (id_usuari, usuari, password, email)VALUES(NULL, '$usuario', '$passw', '$email')");
                    $row = $query->execute();
                    if ($row == 1) {
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= "From: Vota@proyectevota.org" . "\r\n";
                        $mensaje = "Bienvenido " . $_POST['usuario'] . ".<br><br>
                                    Tu registro a sido realizado con exito. <br> 
                                    Tus datos de inicio de sesion son los siguientes:<br> Usuario: " . $_POST['usuario'] . "<br>Contraseña: " . $_POST['password'] . "<br><br>
                                    Gracias por registrarte.<br>Saludos.";
                        mail($_POST['email'], 'Registro con exito', $mensaje, $headers);
                        header("location: index.php");
                    } else {
                        echo "<script>error('No se ha podido insertar en la baase de datos!')</script>";
                    }
                }
                else{
                    echo "<script>error('Este nombre de usuario o email ya estan registrados!')</script>";
                }
            }
            else{
                echo "<script>error('El email introducido no es valido!')</script>";
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
                <input id="name" name="usuario" placeholder="username" type="text"><br>
                <label>Introduce la contraseña</label>
                <input id="password" name="password" placeholder="**********" type="password"><br>
                <label>Repite la contraseña</label>
                <input id="password" name="password2" placeholder="**********" type="password"><br>
                <label>Introduce el email:</label>
                <input id="email" name="email" placeholder="email" type="text"><br><br>
                <input name="submit" type="submit" value="  Envia  ">
                <span><?php echo $error; ?></span>
            </form>            
        </div>
    </div>
</body>
</html>
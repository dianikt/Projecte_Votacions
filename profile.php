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
<body id="perfil" >
    <?php 
          if($login_session == 'admin'){
              header('location: creacioConsultes.php'); 
          }
    ?>
    <ul id="encabezado">
        <li><img src="img/logo.png" style="width: 43px"></li>
        <?php
              if($login_session!="admin"){
                  echo "<li><a  class='active' href='profile.php'>Perfil</a></li>";
              }
        ?> 
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
        <?php
            $usuario = $_SESSION['login_user'];
            $idUsuario = $id_session;           
            // SQL query to fetch information of registerd users and finds user match.
            $query = $pdo->prepare( "select usuari, email from usuaris where id_usuari ='$idUsuario'");
            $query->execute();
            $row = $query->fetch();
            $user = $row['usuari'];
            $email = $row['email'];
            if(isset($_POST['si'])){
                include('load.php');
            }
        ?>

        <li id="logout"><a href="logout.php"><i><?php echo $login_session; ?></i> Cerrar Sesion</a></li>
    </ul>
    <div class="contenido">
        <h3>Datos de registro del usuario</h3>
        <hr> 
        <label>Usuario: <?php echo $user; ?></label><br><br>       
        <label>Email: <?php echo $email; ?></label>  
        <hr>   
        <img id="imgvota" src="imagenes/voto2.png"/>
        <form action="" method="post">
            <input name="si" style="display: none;" type="text">
            <input name="submit" type="submit" value="NO CLIQUES AQUI POR FAVOR!">
        </form>


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
<script>
    $(document).ready( function(){
        $.fn.snow({ minSize: 5, maxSize: 50, newOn: 120, flakeColor: '#BBABAB' });

    });
</script>
</html>
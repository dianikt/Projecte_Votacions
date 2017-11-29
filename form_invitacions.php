<?php
    include('session.php');
?>
<html>
 <head>
 <meta charset="utf-8">
	  <title>Envia invitaciones</title>
	  <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="js/java.js"></script>
   </head> 
    <body>
        <?php
        //preparem i executem la consulta
        if(isset($_POST["email"])){
            $query = $pdo->prepare("INSERT INTO invitacions (id_invitacio, email, id_consulta) VALUES (null, '".$_POST["email"]."','".$_POST["id"]."')");
            $query->execute();
        }
        ?>
        <ul id="encabezado">
             <li><img src="img/logo.png" style="width: 43px"></li>
             <li><a href="profile.php">Perfil</a></li>
        <?php
            if($login_session!="admin"){
                echo "<li><a href='consultas.php'>Consultas</a></li>";
            }
        ?>             <?php
             if($login_session=="admin"){
                 echo "<li><a  href='creacioConsultes.php'>Crear Consulta</a></li>";
                  echo "<li><a class='active' href='form_invitacions.php'>Invitar consulta</a></li>";
             }
             ?>
             <li id="logout"><a href="logout.php"><i><?php echo $login_session; ?></i> Cerrar Sesion</a></li>
        </ul>
        <div class="contenido">
            <h3>Invitaciones</h3>
            <form method="POST" action="form_invitacions.php">
                <label>Introduce un nuevo email:</label>
                <input type="email" name="email"><br>
                <label>Introduce un id existente:</label>
                <input type="number" name="id"><br>
                <input type="submit" value="envia">
            </form>
            <table>
                <?php
                    echo "<tr>";
                    echo "<th>PREGUNTA</th>";
                    echo "<th>ID</th>";
                    echo "</tr>";
                    $preguntas = $pdo->prepare("select id_consulta, pregunta from consultes");
                    $preguntas->execute();
                    $fila = $preguntas->fetch();
                    while($fila){
                        echo "<tr>";
                        echo "<td>".$fila['pregunta']."</td>";
                        echo "<td>".$fila['id_consulta']."</td>";
                        echo "</tr>";
                        $fila = $preguntas->fetch();
                    }

                ?>
            </table>

        </div>
           <aside id="aside_letf">              
                <img class="imagen" id="imagen" src = ""  /></a>
                <img class="imagen" id="imagen1" src = "" /></a>        
                <img class="imagen" id="imagen2" src = "" /></a>               
            </div>
         </aside>
        <footer>
          <p>Created by: Diana, Dani</p>
        </footer>
	</body>
</html>


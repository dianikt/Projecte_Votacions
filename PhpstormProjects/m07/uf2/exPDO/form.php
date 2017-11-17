<?php

    try {
        $hostname = "localhost";
        $dbname = "world";
        $username = "root";
        $pw = "password";
        $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }
    //preparem i executem la consulta
    $query = $pdo->prepare("select continent from country group by continent");
    $query->execute();

    //anem agafant les fileres d'amb una amb una
    $row = $query->fetch();
?>

<form action="world.php" method="post">
    Continente: <select name="continent">
        <?php

            while ( $row ) {
            echo "<option>".$row["continent"]."</option>\n";
            $row = $query->fetch();
            }


            ?>

            </select>
          <input type="submit" value="consulta"/>
</form>

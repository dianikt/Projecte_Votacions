<html>
<head>
    <title>Exemple de lectura de dades a MySQL</title>
    <style>
        body{
        }
        table,td {
            border: 1px solid black;
            border-spacing: 0px;
        }
    </style>
</head>

<body>
<h1>Exemple de lectura de dades a MySQL</h1>

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
    $continent = $_POST["continent"];
    //preparem i executem la consulta
    $query = $pdo->prepare("select name nombre, population poblacion from country where continent='$continent'");
    $query->execute();
    $queryTotal = $pdo->prepare("select sum(population) totalPoblacion from country where continent='$continent'");
    $queryTotal->execute();

    //comprovo errors:
    $e= $query->errorInfo();
    if ($e[0]!='00000') {
        echo "\nPDO::errorInfo():\n";
        die("Error accedint a dades: " . $e[2]);
    }

?>

<!-- (3.1) aquí va la taula HTML que omplirem amb dades de la BBDD -->
<table>
    <!-- la capçalera de la taula l'hem de fer nosaltres -->
    <tr>
        <th bgcolor="cyan">Nombre</th>
        <th bgcolor="cyan">Poblacion</th>
    </tr>
    <?php
    foreach ($query as $row) {
        echo "<tr>";
        echo "<td>".$row["nombre"]."</td>";
        echo "<td>".$row["poblacion"]."</td>";
        echo "</tr>";
        $row = $query->fetch();
    }

    ?>
</table>
<table>
    <?php
    foreach ($queryTotal as $row) {
        echo "<tr>";
        echo "<th colspan='4' align='center' bgcolor='cyan'>Poblacion de $continent</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>" . $row["totalPoblacion"] . "</td>";
        echo "</tr>";
    }
    //eliminem els objectes per alliberar memòria
    unset($pdo);
    unset($query);
    unset($queryTotal);
    ?>

</table>
</body>
</html>
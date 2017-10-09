<style>

</style>

<table>
    <?php
    $precio = 0;
    $tamaño = $_GET["tam"];
    if($tamaño=="Pequeña") $precio += 4;
    elseif($tamaño=="Mediana") $precio += 8;
    elseif($tamaño=="Familiar") $precio += 12;
    $massa = $_GET["mas"];
    $base = $_GET["base"];
    if (isset($_GET["ing"])) {
        $ingredientes = $_GET["ing"];
        if($ingredientes[0]!="Oregano"){
            echo "ERROR! Tienes que seleccionar obligatoriamente el ingrediente: Oregano!";
        }
        else{
            $precio += (0.5*count($ingredientes));
            echo "<h3>Tamaño: </h3> $tamaño";
            echo "<h3>Massa: </h3> $massa";
            echo "<h3>Base: </h3> $base <h3>Ingredientes: </h3>";

            foreach ($ingredientes as $ing){
                echo $ing."<br>";
            }
            echo "<h3>Precio total: $precio €</h3>";
        }

    }
    else {
        echo "ERROR! Tienes que seleccionar un ingrediente como minimo!";
    }

    ?>
</table>
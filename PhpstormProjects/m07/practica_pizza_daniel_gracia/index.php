<html>
    <head>
    </head>

    <body>
        <h1>Pizza al gusto</h1>
        <form method="get" action="resultat.php">
                <h3>Tamaño:</h3>
                <input type="radio" name="tam" value="Pequeña" checked> Pequeña +4€<br>
                <input type="radio" name="tam" value="Mediana"> Mediana +8€<br>
                <input type="radio" name="tam" value="Familiar"> Familiar +12€

                <h3>Massa:</h3>
                <input type="radio" name="mas" value="Fina" checked> Fina +0€<br>
                <input type="radio" name="mas" value="Classica"> Classica +0€

                <h3>Base:</h3>
                <input type="radio" name="base" value="Tomate" checked> Tomate +0€<br>
                <input type="radio" name="base" value="Nata"> Carbonara +0€<br>
                <input type="radio" name="base" value="Barbacoa"> Barbacoa +0€

            <h3>Ingredientes:</h3>
            <?php
                $lista_ing = ["Oregano","4 Quesos", "Carne de Vacuno", "Tomate Natural", "Pollo Marinado", "Bacon", "York", "Peperoni",
                    "Piña", "Chedar", "Pimiento Verde", "Pimiento Morron", "Olivas Negras"];
                foreach ($lista_ing as $ing){
                    echo "<input type=\"checkbox\" name=\"ing[]\" id=\"ing\" value=\"$ing\"/> $ing +0.5€<br>";
                }
            ?>
            <h3><input type="submit" value="Realizar Pedido"/></h3>
        </form>

    </body>
</html>
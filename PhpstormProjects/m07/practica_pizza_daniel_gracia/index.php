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
            <input type="checkbox" name="ing[]" id="ing" value="Oregano"/> Oregano +0.5€<br>
            <input type="checkbox" name="ing[]" id="ing" value="4 Quesos"/> 4 Quesos +0.5€<br>
            <input type="checkbox" name="ing[]" id="ing" value="Carne de Vacuno"/> Carne de Vacuno +0.5€<br>
            <input type="checkbox" name="ing[]" id="ing" value="Tomate Natural"/> Tomate Natural +0.5€<br>
            <input type="checkbox" name="ing[]" id="ing" value="Pollo Marinado"/> Pollo Marinado +0.5€<br>
            <input type="checkbox" name="ing[]" id="ing" value="Bacon"/> Bacon +0.5€<br>
            <input type="checkbox" name="ing[]" id="ing" value="York"/> York +0.5€<br>
            <input type="checkbox" name="ing[]" id="ing" value="Peperoni"/> Peperoni +0.5€<br>
            <input type="checkbox" name="ing[]" id="ing" value="Piña"/> Piña +0.5€<br>
            <input type="checkbox" name="ing[]" id="ing" value="Chedar"/> Chedar +0.5€<br>
            <input type="checkbox" name="ing[]" id="ing" value="Pimiento Verde"/> Pimiento Verde +0.5€<br>
            <input type="checkbox" name="ing[]" id="ing" value="Pimiento Morron"/> Pimiento Morron +0.5€<br>
            <input type="checkbox" name="ing[]" id="ing" value="Olivas Negras"/> Olivas Negras +0.5€<br><br>
            <input type="submit" value="Enviar"/>
        </form>

    </body>
</html>
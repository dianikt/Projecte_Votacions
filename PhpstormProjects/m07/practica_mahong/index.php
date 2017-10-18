<html>
    <head>
    </head>

    <body>
        <h1>Parejas</h1>
        <form method="get" action="functions.php">
            Filas:<br>
            <input type="number" name="filas" min="1" max="10" value="6" required/><br><br>
            Columnas:<br>
            <input type="number" name="col" min="1" max="10" value="6" required/><br><br>
            Nombre:<br>
            <input type="text" name="nombre" required/><br><br>
            Tiempo para mostrar las cartas cuando te equivocas:
            <input type="number" name="time" min="1" max="5" value="2" required/> Segundos.<br><br>
            <input type="submit" value="COMENZAR PARTIDA"/>
        </form>
    </body>
</html>
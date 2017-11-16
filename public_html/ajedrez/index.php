<html>
<head>
    <style>
        td {
            width: 60px;
            height: 60px;
            text-align: center;
        }
        .peon-blanco {
            background-image: url("peon_blanco.jpeg");
        }
        .peon-negro {
            background-image: url("peon_negro.jpeg");
        }
        .fondo-negro{
            background-color: black;
        }
        .fondo-blanco{
            background-color: white;
        }
    </style>
</head>

<body>
<h1>Ajedrez</h1>
<p>Información:</p>
<form method="post">
    <table>
        <?php
        session_start();
        //session_destroy();
        require('resultat.php');
        // Peons predefinits o "hardcoded"
        if(isset($_SESSION["peonesBlanco"])){
            $peonBlanco = $_SESSION["peonesBlanco"];
            $peonNegro = $_SESSION["peonesNegro"];
            $turno = $_SESSION["torn"];
        }
        else{
            $turno = 2;
            $peonBlanco = array( "21", "22","23","24","25","26","27","28" );
            $peonNegro = array( "71", "72","73","74","75","76","77","78" );
            $_SESSION["peonesBlanco"] = $peonBlanco;
            $_SESSION["peonesNegro"] = $peonNegro;
            $_SESSION["torn"] = $turno;

        }

        if(isset($_POST["filaOrigen"])){
            $valueOrigen = $_POST["filaOrigen"].$_POST["colOrigen"]."";
            $valueDestino = $_POST["filaDestino"].$_POST["colDestino"]."";
            $valueResta = $valueOrigen-$valueDestino;

            if( ((int)$_SESSION["torn"])%2 == 0){
                if(in_array("$valueOrigen",$peonNegro)){
                    if($valueOrigen>70&&$valueOrigen<79){
                        if($valueResta==10 or $valueResta==20){
                            $origenNegro = array_search($valueOrigen, $peonNegro);
                            $peonNegro[$origenNegro]=$valueDestino."";
                            echo "<p>Has movido correctamente el peon negro de la posición ".$valueOrigen." a la posición ".$valueDestino."</p>";
                            $turno=1;
                        }
                        else{
                            echo "<p>No puedes mover el peon negro de la posición ".$valueOrigen." a la posición ".$valueDestino."</p>";
                        }
                    }
                    else{
                        $origenNegro = array_search($valueOrigen, $peonNegro);
                        if($valueResta==10){
                            $peonNegro[$origenNegro]=$valueDestino."";
                            echo "<p>Has movido correctamente el peon negro de la posición ".$valueOrigen." a la posición ".$valueDestino."</p>";
                            $turno=1;
                        }
                        elseif($valueResta==11 || $valueResta== 9){
                            if(in_array("$valueDestino",$peonBlanco)){
                                $origenBlanco = array_search($valueDestino, $peonBlanco);
                                unset($peonBlanco[$origenBlanco]);
                                $peonNegro[$origenNegro]=$valueDestino."";
                                echo "<p>Te has comido un peon blanco al mover el peon negro de la posición ".$valueOrigen." a la posición ".$valueDestino."</p>";
                                $turno=1;
                            }

                        }
                        else{
                            $peonNegro[$origenNegro]=$valueOrigen."";
                            echo "<p>No puedes mover el peon negro de la posición ".$valueOrigen." a la posición ".$valueDestino."</p>";
                        }
                    }
                }
                else{
                    echo "<p>No tienes ningun peon en esa posición, prueba con otra.</p>";
                }
                $_SESSION["peonesBlanco"] = $peonBlanco;
                $_SESSION["peonesNegro"] = $peonNegro;
                $_SESSION["torn"] = $turno;
            }
            elseif( ((int)$_SESSION["torn"])%2 !== 0) {
                if(in_array("$valueOrigen",$peonBlanco)) {
                    if ($valueOrigen > 20 && $valueOrigen < 29) {
                        if ($valueResta == -10 or $valueResta == -20) {
                            $origenBlanco = array_search($valueOrigen, $peonBlanco);
                            $peonBlanco[$origenBlanco] = $valueDestino . "";
                            echo "<p>Has movido correctamente el peon blanco de la posición " . $valueOrigen . " a la posición " . $valueDestino . "</p>";
                            $turno=2;
                        }
                        else {
                            echo "<p>No puedes mover el peon blanco de la posición " . $valueOrigen . " a la posición " . $valueDestino . "</p>";
                        }
                    }
                    else{
                        $origenBlanco = array_search($valueOrigen, $peonBlanco);
                        if ($valueResta == -10) {
                            $peonBlanco[$origenBlanco] = $valueDestino . "";
                            echo "<p>Has movido correctamente el peon blanco de la posición " . $valueOrigen . " a la posición " . $valueDestino . "</p>";
                            $turno=2;
                        }

                        elseif($valueResta==-11 || $valueResta== -9){
                            if(in_array("$valueDestino",$peonNegro)){
                                $origenNegro= array_search($valueDestino, $peonNegro);
                                unset($peonNegro[$origenNegro]);
                                $peonBlanco[$origenBlanco]=$valueDestino."";
                                echo "<p>Te has comido un peon negro al mover el peon blanco de la posición ".$valueOrigen." a la posición ".$valueDestino."</p>";
                                $turno=2;
                            }

                        }

                        else {
                            $peonBlanco[$origenBlanco] = $valueOrigen . "";
                            echo "<p>No puedes mover el peon blanco de la posición " . $valueOrigen . " a la posición " . $valueDestino . "</p>";
                        }
                    }
                }
                else{
                    echo "<p>No tienes ningun peon en esa posición, prueba con otra.</p>";
                }
                $_SESSION["peonesBlanco"] = $peonBlanco;
                $_SESSION["peonesNegro"] = $peonNegro;
                $_SESSION["torn"] = $turno;
            }
        }

        pintarTauler($peonBlanco,$peonNegro);
        comprobarVictoria($peonBlanco, $peonNegro);
        ?>
    </table>
    <?php
        if($turno%2==0){
            echo "<p>Turno Negro</p>";
        }
        elseif ($turno%2!==0){
            echo "<p>Turno Blanco</p>";
        }
        function comprobarVictoria($peonBlanco, $peonNegro){
            if(count($peonBlanco)==0){
                echo "<h4>Felicidades, el Negro a machacado al Blanco!</h4>";
            }
            if(count($peonNegro)==0){
                echo "<h4>Felicidades, el Blanco a machacado al Negro!</h4>";
            }
        }
    ?>
    <input type="number" name="filaOrigen" placeholder="Fila Origen" max="8" min="1" required/>
    <input type="number" name="colOrigen" placeholder="Columna Origen" max="8" min="1" required/><br>
    <input type="number" name="filaDestino" placeholder="Fila Destino" max="8" min="1" required/>
    <input type="number" name="colDestino" placeholder="Columna Destino" max="8" min="1" required/>
    <input type="submit" value="Mover ficha">
</form>
</body>
</html>
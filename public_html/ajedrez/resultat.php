<style>
    td {
        width: 60px;
        height: 60px;
        text-align: center;
    }
    .peon-blanco {
        background-image: url("peon-blanco.png");
        background-size: 59px 59px;
        background-repeat: no-repeat;
    }
    .peon-negro {
        background-image: url("peon-negro.png");
        background-size: 59px 59px;
        background-repeat: no-repeat;
    }

    .fondo-negro{
        background-color: grey;
        z-index: auto;
    }
    .fondo-blanco{
        background-color: white;
        z-index: auto;
    }
</style>
<?php
function pintarTauler($peonBlanco,$peonNegro){
    //for($i=0; $i<count($peonBlanco); $i++){        }
    //for($i=0; $i<count($peonBlanco); $i++){        }
    $filas = 8  ;
    $col= 9;
    $n = 0;
    $m = 1;
    echo "<tr>";
    for( $i=0; $i<$col; $i++ ) {
        echo "<th>$n</th>\n";
        $n++;
        $x=0;
        for ($j = 1; $j <= $filas; $j++) {
            if($i<1 and $j>=1){
                echo "<th>$m</th>\n";
                $m++;
            }
            else{
                if($i%2==0) {
                    if ($x % 2 == 0) {
                            if(in_array("$i$j",$peonBlanco)){
                                echo "<td id='$i$j' class='fondo-blanco peon-blanco'></td>\n";
                            }
                            elseif(in_array("$i$j",$peonNegro)){
                                echo "<td id='$i$j' class='fondo-blanco peon-negro'></td>\n";
                            }
                            else{
                                echo "<td id='$i$j' class='fondo-blanco'></td>\n";
                            }
                        $x++;
                    }
                    else {
                        if(in_array("$i$j",$peonBlanco)){
                            echo "<td id='$i$j' class='fondo-negro peon-blanco'></td>\n";
                        }
                        elseif(in_array("$i$j",$peonNegro)){
                            echo "<td id='$i$j' class='fondo-negro peon-negro'></td>\n";
                        }
                        else{
                            echo "<td id='$i$j' class='fondo-negro'></td>\n";
                        }
                        $x++;
                    }
                }
                else{
                    if ($x % 2 !== 0) {
                        if(in_array("$i$j",$peonBlanco)){
                            echo "<td id='$i$j' class='fondo-blanco peon-blanco'></td>\n";
                        }
                        elseif(in_array("$i$j",$peonNegro)){
                            echo "<td id='$i$j' class='fondo-blanco peon-negro'></td>\n";
                        }
                        else{
                            echo "<td id='$i$j' class='fondo-blanco'></td>\n";
                        }
                        $x++;
                    }
                    else {
                        if(in_array("$i$j",$peonBlanco)){
                            echo "<td id='$i$j' class='fondo-negro peon-blanco'></td>\n";
                        }
                        elseif(in_array("$i$j",$peonNegro)){
                            echo "<td id='$i$j' class='fondo-negro peon-negro'></td>\n";
                        }
                        else{
                            echo "<td id='$i$j' class='fondo-negro'></td>\n";
                        }
                        $x++;
                    }
                }
            }
        }

        echo "</tr>\n";
    }
}

?>
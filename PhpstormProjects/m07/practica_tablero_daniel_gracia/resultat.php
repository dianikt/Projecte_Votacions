<style>
    td {
        width: 50px;
        height: 50px;
        border-radius: 1px;
    }

    .negro {
        background-color: black;
    }

    .blanco {
        background-color: white;
    }


</style>

<table>
    <?php
    $letras = ["A","B","C","D","E","F","G","H","I","J"];
    $filas = $_POST["filas"];
    $col= $_POST["col"];
    for($t=0; $t<=$filas; $t++){
        if($t!=0)echo "<th>$t</th>";
        else echo "<th/>";
    }
    for( $i=0; $i<$col; $i++ ) {
        echo "<tr>\n";
        echo "<th>$letras[$i]</th>";
        $x=0;
        for ($j = 1; $j <= $filas; $j++) {
            if($i%2==0){
                if($x%2==0){
                    echo "<td class='blanco'></td>\n";
                    $x++;
                }
                else{
                    echo "<td class='negro'></td>\n";
                    $x++;
                }

            }
            else{
                if($x%2!=0){
                    echo "<td class='blanco'></td>\n";
                    $x++;
                }
                else{
                    echo "<td class='negro'></td>\n";
                    $x++;
                }
            }

        }
        echo "</tr>\n";
    }
    ?>
</table>
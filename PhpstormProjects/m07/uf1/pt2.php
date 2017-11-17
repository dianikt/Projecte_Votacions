<?php
$d = new DateTime();
$tipus_de_d = gettype( $d );
$classe_de_d = get_class( $d );
echo "La variable \$d 
      conté el valor " . $d->format( "d/m/Y") .
    ", és del tipus $tipus_de_d i és de la classe $classe_de_d ";
?>



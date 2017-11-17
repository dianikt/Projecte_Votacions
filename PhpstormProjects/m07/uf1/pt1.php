<?php
$i = 12;
$tipus_de_i = gettype( $i );
$f = 0.3;
$tipus_de_f = gettype( $f );
$b = TRUE;
$tipus_de_b = gettype( $b );
$c = "esto es un char";
$tipus_de_c = gettype( $c );
$g = gettype( $i );
$tipus_de_g = gettype( $g );

echo "La variable \$i 
      conté el valor $i 
      i és del tipus $tipus_de_i <br>";
echo "La variable \$j 
      conté el valor $f 
      i és del tipus $tipus_de_f <br>";
echo "La variable \$b 
      conté el valor $b 
      i és del tipus $tipus_de_b <br>";
echo "La variable \$c 
      conté el valor $c 
      i és del tipus $tipus_de_c <br>";
echo "La variable \$g 
      conté el valor $g 
      i és del tipus $tipus_de_g";

?>
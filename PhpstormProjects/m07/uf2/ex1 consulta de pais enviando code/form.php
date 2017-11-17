<?php
# (1.1) Connectem a MySQL (host,usuari,contrassenya)
$conn = mysqli_connect('localhost','root','password');

# (1.2) Triem la base de dades amb la que treballarem
mysqli_select_db($conn, 'world');

# (2.1) creem el string de la consulta (query)
$consulta = "SELECT code, name from country;";

# (2.2) enviem la query al SGBD per obtenir el resultat
$resultat = mysqli_query($conn, $consulta);

# (2.3) si no hi ha resultat (0 files o bé hi ha algun error a la sintaxi)
#     posem un missatge d'error i acabem (die) l'execució de la pàgina web
if (!$resultat) {
    $message  = 'Consulta invàlida: ' . mysqli_error() . "\n";
    $message .= 'Consulta realitzada: ' . $consulta;
    die($message);
}
?>
<form action="world.php" method="post">
    Pais: <select name="pais">
        <?php while( $registre = mysqli_fetch_assoc($resultat) ) {
            echo "<option value='".$registre["code"]."'>".$registre["name"]."</option>\n";
        }
            ?>
            </select>
          <input type="submit" value="Consultar ciudades del pais">
</form>

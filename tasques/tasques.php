<?php

function mostrarTasques(){
    $connexio = mysqli_connect("localhost", 'user', 'aplicacions', 'tasques');
    $sql = "SELECT * FROM tasques;";
    $resultat = mysqli_query($connexio, $sql);

    $files = mysqli_fetch_array($resultat);
    do {
        $select[] = $files;
    } while ($files = mysqli_fetch_array($resultat));

    mysqli_close($connexio);

    for ($i = 0; $i < count($select); $i++) {
        echo "<p>".$select[$i]['id'].". ".$select[$i]['tasca']."</p>";
    }
}
mostrarTasques();
?>
<form action="index.php" method="post">
    Eliminar tasca:
    <input type="number" id="numero" name="numero" placeholder="Número"><br><br>
    <input type="submit" id="eliminar" name="eliminar" value="Eliminar">
</form>



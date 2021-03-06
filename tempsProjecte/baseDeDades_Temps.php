<?php
function crearBaseDades()
{
    $connexio = mysqli_connect("localhost", 'user', 'aplicacions');
    $db = "CREATE DATABASE tempsProjecte";
    $crearDB = mysqli_query($connexio, $db);
    mysqli_close($connexio);
}
crearBaseDades();

function crearTaula()
{
    $connexio = mysqli_connect("localhost", 'user', 'aplicacions', 'tempsProjecte');

    $tableTemps = "CREATE TABLE temps (
                   id SMALLINT UNSIGNED PRIMARY KEY,   
                   hora_inici DATETIME,
                   hora_fi DATETIME,
                   intervalTemps INT)";
    $crearTabla = mysqli_query($connexio, $tableTemps);
    mysqli_close($connexio);
}
crearTaula();

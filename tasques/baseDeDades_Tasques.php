<?php

$tasques = array(
    "Crear Base de dades",
    "Dissenyar pàgina web",
    "Introducció registres a la Base de dades",
    "Programar informe",
    "Instal·lar servidor web",
    "Programació autenticació",
    "Fer proves del programa",
    "Cerca d'informació",
);


function crearBaseDades()
{
    $connexio = mysqli_connect("localhost", 'user', 'aplicacions');
    $db = "CREATE DATABASE tasques";
    $crearDB = mysqli_query($connexio, $db);
    mysqli_close($connexio);
}
crearBaseDades();

function crearTaula()
{
    $connexio = mysqli_connect("localhost", 'user', 'aplicacions', 'tasques');

    $tableTasques = "CREATE TABLE tasques (
                   id TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
                   tasca VARCHAR(100) NOT NULL)";
    $crearTabla = mysqli_query($connexio, $tableTasques);
    mysqli_close($connexio);
}
crearTaula();

function insertarRegistre($tasques){
    $connexio = mysqli_connect("localhost", 'user', 'aplicacions', 'tasques');
    foreach ($tasques as $tasca){
        $insertarTasca= "INSERT INTO tasques(tasca) VALUES ('$tasca');";
        $insertarRegistre = mysqli_query($connexio, $insertarTasca);
    }
    mysqli_close($connexio);
}
insertarRegistre($tasques);
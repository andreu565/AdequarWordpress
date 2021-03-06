<?php
/*
Plugin Name: Tàsques
Plugin URI: https://andreu.jamoneros.cat
Description: Plugin del Projecte Tàsques Controlador d'Assistència
Version: 1.0
Author: Andreu
Author URI: https://andreu.jamoneros.cat
License: GPL2
*/

add_action('admin_menu', 'crearMenu');

function crearMenu(){
    add_menu_page( 'Tàsques Projecte',//Títol de la pàgina
        'Tàsques',//Títol menú
        'manage_options',//Capability
        'slug_tasques',//Slug
        'mostrarContingut' );//Funció del contingut
}


function mostrarContingut(){

    echo "<h1>Tàsques del Projecte</h1>";
    #Inserció del codi d'un altre fitxer. En cas d'error deixarà de compilar el programa.
    require( plugin_dir_path( __FILE__ ) . 'tasques.php');


}
$eliminarTasca=$_POST['numero'];
function eliminar($eliminarTasca)
{
    if (isset($_POST['eliminar'])) {
        $connexio = mysqli_connect("localhost", 'user', 'aplicacions', 'tasques');
        $sql = "DELETE FROM tasques WHERE id= '$eliminarTasca';";
        $resultat = mysqli_query($connexio, $sql);
        mysqli_close($connexio);
    }
}
eliminar($eliminarTasca);
?>



<?php
/*
Plugin Name: Comptatge
Plugin URI: https://andreu.jamoneros.cat
Description: Comptatge d'hores destinades al projecte.
Version: 1.0
Author: Andreu
Author URI: https://andreu.jamoneros.cat
License: GPL2
*/

add_action('admin_menu', 'crearMenu2');

function crearMenu2(){
    add_menu_page( 'Hores destinades al Projecte',//Títol de la pàgina
        'Comptatge',//Títol menú
        'manage_options',//Capability
        'slug_comptatge',//Slug
        'mostrarContingut2' );//Funció del contingut
}

function mostrarContingut2(){
    echo "<h1>Temps</h1>";
    require( plugin_dir_path( __FILE__ ) . 'temps.php');

}

?>




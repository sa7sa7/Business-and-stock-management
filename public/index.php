<?php

define('ENVIRONMENT', 'development');

if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') 
{
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', 'http://');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);

/**
 * Configuration for: Database
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'stock');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8');


// DIRECTORY_SEPARATOR adds a slash to the end of the path
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
// set a constant that holds the project's "application" folder, like "/var/www/application".
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

define('controlleur_debut','controller/home.php');
define('classe_debut','Home');

define('path_image', 'C:\wamp\www\gestion de stock\public\upload\image\\');
define('URL_image', URL . 'public\upload\image\\');

// load application class
require APP . 'core/application.php';
require APP . 'core/controller.php';
require APP . 'core/model.php';

ini_set('session.save_path', 'C:\wamp\tmp\Gestion de stock');

//id des menu pour verifier le droit d'acces d'un' utilisateur donnné
define('id_ajoutercategorie', 2);
define('id_supprimercategorie', 3);
define('id_modifiercategorie', 4);

define('id_ajouterproduit', 6);
define('id_supprimerproduit', 7);
define('id_modifierproduit', 8);

define('id_ajoutercommande', 10);
define('id_supprimercommande', 11);
define('id_modifiercommande', 12);

define('id_consulterstock', 14);
define('id_listerproduits', 15);

define('id_ajouterentrepot', 17);
define('id_supprimerentrepot', 18);
define('id_modifierentrepot', 19);

define('id_ajouterfournisseur', 21);
define('id_supprimerfournisseur', 22);
define('id_modifierfournisseur', 23);

define('id_ajouteruser', 25);
define('id_supprimeruser', 26);
define('id_modifieruser', 27);

define('id_ajouterprofil', 29);
define('id_supprimerprofil', 30);
define('id_modifierprofil', 31);
define('id_modifierdroitacces', 32);

define('id_ajoutermenu', 34);
define('id_supprimermenu', 35);
define('id_modifiermenu', 36);










// start the application
$app = new Application();

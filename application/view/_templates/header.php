<?php
$user = $this->model->get_user_id($_SESSION['id_user']);
$menus_user = $this->model->get_all_menu_user($_SESSION['id_user']);
if($menus_user == 1)
{
    header('location: ' . URL . 'home/deconnection');
}?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
	<meta charset="iso-8859-1"/>

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="<?php echo URL; ?>css/reset.css"> 
	<link rel="stylesheet" href="<?php echo URL; ?>css/style1.css"> 
	<link rel="stylesheet" href="<?php echo URL; ?>css/style2.css"> 
	<link rel="stylesheet" href="<?php echo URL; ?>css/style3.css">
	<link rel="stylesheet" href="<?php echo URL; ?>css/style4.css"> 
	<link rel="stylesheet" href="<?php echo URL; ?>css/style5.css">  

	<script src="<?php echo URL; ?>js/modernizr.js"></script> <!-- Modernizr -->
  	
	<title>Gestion de Stock</title>
</head>

<body>
	<header class="cd-main-header">
		<a href="<?php echo URL; ?>" class="cd-logo"><img src="<?php echo URL; ?>img/cd-logo.png" alt="Logo"></a>
		
		<!-- <div class="cd-search is-hidden">
			<form action="#">
				<input type="search" placeholder="Search...">
			</form>
		</div>  cd-search -->

		<a href="#" class="cd-nav-trigger"><span></span></a>

		<nav class="cd-nav">
			<ul class="cd-top-nav">
				<li class="has-children account">
					<a href="#"><img src="<?php if($user->image != NULL) echo URL_image . $_SESSION['id_user'] . '\\' . $user->image; else echo URL . 'img/cd-avatar.jpeg'; ?>" alt="avatar">
                    <?php echo $user->nom.' '.$user->prenom; ?>
                    </a>

					<ul>
						<li><a href="home/parametre">Paramètres</a></li>
						<li><a href="<?php echo URL; ?>home/deconnection">Déconnenter</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</header> 


	<main class="cd-main-content">
		<nav class="cd-side-nav">
			<ul>
                <!-- navigation -->
				<li class="cd-label">Votre Menu</li>

                <?php
                foreach ($menus_user as $menu) 
                { ?>
                    <li class="has-children overview">
                <?php  echo '<a href= "#" >' . $menu->nom . '</a><ul>';

                    $sous_menus = $this->model->get_all_sous_menu_user($_SESSION['id_user'], $menu->id_menu);

                    foreach ($sous_menus as $sous_menu) 
                    { 
                        echo '<li><a href="' .  URL . $sous_menu->lien . '">' . $sous_menu->nom . '</a></li>';
                    }

                    echo '</ul></li>';
                }?>

			</ul>

		</nav>

		<div class="content-wrapper">
            





			




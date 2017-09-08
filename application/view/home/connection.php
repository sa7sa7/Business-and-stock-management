<!DOCTYPE html>
<html lang="en">
<html>

<head>
    <meta charset="UTF-8">
    <title>GESTION DU STOCK</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="iso-8859-1"/>

    <link rel="stylesheet" href="<?php echo URL; ?>css/style6.css">
</head>

<body>

    <div class="login-form">

        <h1>Gestion De Stock</h1>
        
        
        <form  action= "<?php echo URL; ?>" method="POST">

            <div class="<?php if($wrong_login == false) echo 'form-group'; else echo 'form-group log-status wrong-entry'; ?>" >
                <input type="text" class="form-control"  value="<?php echo $login;?>" name="login" placeholder="Votre Identifiant" id="UserName" required>
                <div class="icon-user"></div>
            </div>

            <div class="<?php if($wrong_password == false) echo 'form-group'; else echo 'form-group log-status wrong-entry'; ?>" >
                <input type="password" class="form-control" name="pwd" placeholder="Votre Mot de Passe" id="Passwod" required>
                <div class="icon-pwd"></div>
            </div>

            <div>
                <span class="alert" <?php if(($wrong_login == true) || ($wrong_password == true)) echo 'style="display:block;"' ?> >
                    <?php if($wrong_login == true) echo "Cet Identifiant est invalide."; elseif ($wrong_password == true) echo "Ce mot de passe est incorrect. Vérifiez que vous avez tapé bien votre mot de passe..";  ?>
                </span>
            </div>
            <br>

            <input type="submit" class="log-btn" name="connecter" value="Connecter"/>

        </form>
   </div>

<script src='<?php echo URL; ?>js/jquery.min.js'></script>
<script src="<?php echo URL; ?>js/main3.js"></script>
    
</body>

</html>

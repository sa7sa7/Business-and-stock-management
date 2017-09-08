<br><br><br>
<div class= "container">
    <h3>Modifier Un Compte</h3>
    <form action= "<?php echo URL; ?>user/modifieruser" method="POST">
        <table class="table">

            <tr>
            <td><label>Profil</label></td>
            <td>
            <select name="profil" >
                <?php
                $compteur = 0;
                foreach ($profils as $profil) 
                { 
                    $compteur ++;?>
                    <option <?php if($user_cible->id_profil ==  $profil->id_profil) echo 'selected';?> ><?php echo $profil->nom;?></option>
               <?php }?>
                
            </select>
            </td>
            </tr>

            <tr>
            <td><label>Identifiant</label></td>
            <td><input type="text" name="login" value="<?php echo $user_cible->login;?>" required /></td>
            </tr>

            <tr>
            <td><label>Nom</label></td>
            <td><input type="text" name="nom" value="<?php echo $user_cible->nom;?>" required /></td>
            </tr>

            <tr>
            <td><label>Prénom</label></td>
            <td><input type="text" name="prenom" value="<?php echo $user_cible->prenom;?>" required /></td>
            </tr>

            <input type="hidden" name="id" value="<?php echo $user_cible->id_user; ?>" />
            <tr>
            <td><input type="submit" name="valider_modifier" value="Modifier" /></td>
            <td><input type="submit" name="annuler" value="Annuler" /></td>
            </tr>

        </table>
    </form>
</div>
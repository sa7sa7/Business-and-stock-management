<br><br><br>
<div class= "container">
    <form action= "<?php echo URL; ?>user" method="POST" onSubmit="return verification(this)" enctype="multipart/form-data">
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
                    <option <?php if(($profil_user == '') && ($compteur == 1)) echo 'selected'; else if ($profil_user == $profil->nom) echo 'selected'; ?> ><?php echo $profil->nom;?></option>
               <?php }?>
                
            </select>
            </td>
            </tr>

            <tr>
            <td><label>Identifiant</label></td>
            <td><input type="text" name="login" value="<?php echo $login;?>" required /></td>
            </tr>

            <tr>
            <td><label>Mot de passe</label></td>
            <td><input type="password" name="password1" value="" required></td>
            </tr>

            <tr>
            <td><label>Répétez la Mot de passe</label></td>
            <td><input type="password" name="password2" value="" required></td>
            </tr>

            <tr>
            <td><label>Nom</label></td>
            <td><input type="text" name="nom" value="<?php echo $nom;?>" required /></td>
            </tr>

            <tr>
            <td><label>Prénom</label></td>
            <td><input type="text" name="prenom" value="<?php echo $prenom;?>" required /></td>
            </tr>

            <tr>
            <td><label for="file">Votre Image</label></td>
            <td><input type="file" name="file" id="file"></td>
            </tr>

            <tr>
            <td><input type="submit" name="valider_ajouter" value="Envoyer"/></td>
            <td><input type="reset" value="Annuler"/></td>
            </tr>

        </table>
    </form>
</div>

<div class="cd-popup" role="alert" id="cachepass">
    <div class="cd-popup-container">
        <p>Ce ne sont pas les mêmes mots de passe!</p>
        <ul class="cd-buttons">
            <li><a href="#" onclick="validation2()">Valider</a></li>
        </ul>
        <a href="#" class="cd-popup-close img-replace">Close</a>
    </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->


<script language="javascript">
function validation() 
{
    document.getElementById("cache").className = "cd-popup";
}

function validation2() 
{
    document.getElementById("cachepass").className = "cd-popup";
}

function verification(f) 
{
    if (f.password1.value != f.password2.value) 
    {
        document.getElementById("cachepass").className = "cd-popup is-visible";
        f.password1.value = "";
        f.password2.value = "";
        f.password1.focus();
        return false;
    }
    else if (f.password1.value == f.password2.value) 
    {
        return true;
    }

}
</script>
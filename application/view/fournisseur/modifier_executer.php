<br><br><br>
<div class= "container">
    <h3>Modifier Un Fournisseur</h3>
    <form action= "<?php echo URL; ?>fournisseur/modifierfournisseur" method="POST">
        <table class="table">
            <tr>
            <td><label>Nom du fournisseur</label></td>
            <td><input type="text" name="nom_fournisseur" value="<?php echo $fournisseur_cible->nom_fournisseur;?>" required /></td>
            </tr>
            <tr>
            <td><label>Adresse</label></td>
            <td><input type="text" name="addresse_fournisseur" value="<?php echo $fournisseur_cible->addresse_fournisseur;?>" required /></td>
            </tr>
            <tr>
            <td><label>Numéro de téléphone</label></td>
            <td><input type="text" name="num_tel_fournisseur" value="<?php echo $fournisseur_cible->num_tel_fournisseur;?>" required /></td>
            </tr>

            <input type="hidden" name="id" value="<?php echo $fournisseur_cible->id_fournisseur; ?>" />
            <tr>
            <td><input type="submit" name="valider_modifier" value="Modifier" /></td>
            <td><input type="submit" name="annuler" value="Annuler" /></td>
            </tr>

        </table>
    </form>
</div>
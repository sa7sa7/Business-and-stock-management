<br><br><br>
<div class= "container">
    <h3>Modifier Un Entrepot</h3>
    <form action= "<?php echo URL; ?>entrepot/modifierentrepot" method="POST">
        <table class="table">
            <tr>
            <td><label>Nom du entrepot</label></td>
            <td><input type="text" name="nom_entrepot" value="<?php echo $entrepot_cible->nom_entrepot;?>" required /></td>
            </tr>
            <tr>
            <td><label>Adresse</label></td>
            <td><input type="text" name="addresse_entrepot" value="<?php echo $entrepot_cible->addresse_entrepot;?>" required /></td>
            </tr>

            <input type="hidden" name="id" value="<?php echo $entrepot_cible->id_entrepot; ?>" />
            <tr>
            <td><input type="submit" name="valider_modifier" value="Modifier" /></td>
            <td><input type="submit" name="annuler" value="Annuler" /></td>
            </tr>

        </table>
    </form>
</div>
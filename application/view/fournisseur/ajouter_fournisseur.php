<br><br><br>
<div class= "container">
    <form action= "<?php echo URL; ?>fournisseur" method="POST">
        <table class="table">

            <tr>
            <td><label>Nom du fournisseur</label></td>
            <td><input type="text" name="nom_fournisseur" required /></td>
            </tr>

            <tr>
            <td><label>L'adresse</label></td>
            <td><input type="text" name="addresse_fournisseur" required /></td>
            </tr>

            <tr>
            <td><label>Numero de téléphone</label></td>
            <td><input type="text" name="num_tel_fournisseur" required /></td>
            </tr>

            <tr>
            <td><input type="submit" name="valider_ajouter_fournisseur" value="Envoyer"/></td>
            <td><input type="reset" value="Annuler"/></td>
            </tr>

        </table>
    </form>
</div>

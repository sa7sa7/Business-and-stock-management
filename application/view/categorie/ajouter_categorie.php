<br><br><br>
<div class= "container">
    <form action= "<?php echo URL; ?>categorie" method="POST">
        <table class="table">

            <tr>
            <td><label>Nom du categorie</label></td>
            <td><input type="text" name="nom_categorie" required /></td>
            </tr>

            <tr>
            <td><label>Déscription</label></td>
            <td><input type="text" name="description_categorie" required /></td>
            </tr>

            <tr>
            <td><label>Image</label></td>
            <td><input type="text" name="image_categorie"/></td>
            </tr>

            <tr>
            <td><input type="submit" name="valider_ajouter" value="Envoyer"/></td>
            <td><input type="reset" value="Annuler"/></td>
            </tr>

        </table>
    </form>
</div>
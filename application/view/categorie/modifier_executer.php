<br><br><br>
<div class= "container">
    <h3>Modifier une Categorie</h3>
    <form action= "<?php echo URL; ?>categorie/modifiercategorie" method="POST">
        <table class="table">
            <tr>
            <td><label>Nom du categorie</label></td>
            <td><input type="text" name="nom_categorie" value="<?php echo $categorie_cible->nom_categorie;?>" required /></td>
            </tr>
            <tr>
            <td><label>Description</label></td>
            <td><input type="text" name="description_categorie" value="<?php echo $categorie_cible->description_categorie;?>" required /></td>
            </tr>
            <tr>
            <td><label>Image</label></td>
            <td><input type="text" name="image_categorie" value="<?php echo $categorie_cible->image_categorie;?>" required /></td>
            </tr>

            <input type="hidden" name="id" value="<?php echo $categorie_cible->id_categorie; ?>" />
            <tr>
            <td><input type="submit" name="valider_modifier" value="Modifier" /></td>
            <td><input type="submit" name="annuler" value="Annuler" /></td>
            </tr>
        </table>
    </form>
</div>
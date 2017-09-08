<br><br><br>
<div class= "container">
    <form action= "<?php echo URL; ?>produit" method="POST">
        <table class="table">


            <tr>
            <td><label>Nom du produit</label></td>
            <td><input type="text" name="nom_produit" required /></td>
            </tr>

            <tr>
            <td><label>Code à Barres</label></td>
            <td><input type="text" name="code_produit" required /></td>
            </tr>

            <tr>
            <td><label>Catégorie</label></td>
            <td><select name="categorie_produit">
            <?php foreach ($categories as $categorie) {
            if (isset($categorie->nom_categorie)) echo "<option value=".$categorie->id_categorie .">".$categorie->nom_categorie."</option>" ; } ?>
            </select>
            </td>
            </tr>

            <tr>
            <td><label>Prix d'achat</label></td>
            <td><input type="text" name="prix_achat_produit" required /></td>
            </tr>

            <tr>
            <td><label>Stock Minimal</label></td>
            <td><input type="text" name="stock_minimal_produit" required /></td>
            </tr>

            <tr>
            <td><input type="submit" name="valider_ajouter_produit" value="Envoyer"/></td>
            <td><input type="reset" value="Annuler"/></td>
            </tr>

        </table>
    </form>
</div>

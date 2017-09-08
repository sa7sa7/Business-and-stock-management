<br><br><br>
<div class= "container">
    <h3>Modifier Un Produit</h3>
    <form action= "<?php echo URL; ?>produit/modifierproduit" method="POST">
        <table class="table">
            <tr>
            <td><label>Nom du produit</label></td>
            <td><input type="text" name="nom_produit" value="<?php echo $produit_cible->nom_produit;?>" required /></td>
            </tr>
            <tr>
            <td><label>Code</label></td>
            <td><input type="text" name="code_produit" value="<?php echo $produit_cible->code_produit;?>" required /></td>
            </tr>
             <tr>
            <td><label>Categorie</label></td>
            <td><input type="text" name="nom_categorie" value="<?php echo $produit_cible->nom_categorie;?>" required /></td>
            </tr>
            <tr>
            <td><label>Le Prix d'Achat</label></td>
            <td><input type="text" name="prix_achat_produit" value="<?php echo $produit_cible->prix_achat_produit;?>" required /></td>
            </tr>
            <tr>
            <td><label>Le Stock Minimal</label></td>
            <td><input type="text" name="stock_minimal_produit" value="<?php echo $produit_cible->stock_minimal_produit;?>" required /></td>
            </tr>
            <input type="hidden" name="id" value="<?php echo $produit_cible->id_produit; ?>" />
            <tr>
            <td><input type="submit" name="valider_modifier" value="Modifier" /></td>
            <td><input type="submit" name="annuler" value="Annuler" /></td>
            </tr>

        </table>
    </form>
</div>
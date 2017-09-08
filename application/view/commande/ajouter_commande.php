<br><br><br>
<div class= "container">
    <h3>Passer une commande </h3>
    <form action= "<?php echo URL; ?>commande" method="POST">
        <table class="table">
        <tr>
        <td><label>Fournisseur</label></td>
        <td><select name="fournisseur_commande" width="10">
        <?php foreach ($fournisseurs as $fournisseur) { ?>
        <?php if (isset($fournisseur->nom_fournisseur)) echo "<option value=".$fournisseur->id_fournisseur.">".$fournisseur->nom_fournisseur."</option>" ; ?>
        <?php } ?>
        </select></td>
        </tr>
        <tr>
        <td><label>Produit</label></td>
        <td>
        <select name="produit_commande" width="10">
        <?php foreach ($produits as $produit) { ?>
        <?php if (isset($produit->nom_produit)) echo "<option value=".$produit->id_produit.">".$produit->nom_produit. "</option>" ; ?>
        <?php } ?>
        </select></td>
        </tr>
        <tr>
        <td><label>User</label></td>
        <td><select name="user_commande" width="10">
        <?php foreach ($users as $user) { ?>
        <?php if (isset($user->nom)) echo "<option value=".$user->id_user.">".$user->nom."</option>" ; ?>
        <?php } ?>
        </select></td>
        </tr>
        <tr>
        <td><label>Quantite</label></td>
        <td><input type="text" name="quantite_commande" size="12" required /></td>
        </tr>
        <tr>
        <td><input type="submit" name="valider_ajouter_commande" value="Passer Commande" /></td>
        <td><input type="submit" name="annuler" value="Annuler" /></td>
        </tr>
        </table>
    </form>
</div>

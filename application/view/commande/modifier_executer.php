<br><br><br>
<div class= "container">
    <h3>Modifier Un Commande</h3>
    <form action= "<?php echo URL; ?>commande/modifiercommande" method="POST">
        <table class="table">
            <tr>
            <td><label>Fournisseur</label></td>
            <td><input type="text" name="fournisseur_commande" value="<?php echo $commande_cible->nom_fournisseur;?>" required /></td>
            </tr>
            <tr>
            <td><label>Produit</label></td>
            <td><input type="text" name="produit_commande" value="<?php echo $commande_cible->nom_produit;?>" required /></td>
            </tr>
             <tr>
            <td><label>Date</label></td>
            <td><input type="text" name="date_commande" value="<?php echo $commande_cible->date_commande;?>" required /></td>
            </tr>
            <tr>
            <td><label>Quantite</label></td>
            <td><input type="text" name="quantite_commande" value="<?php echo $commande_cible->quantite_commande;?>" required /></td>
            </tr>
            <tr>
            <td><label>User</label></td>
            <td><input type="text" name="user_commande" value="<?php echo $commande_cible->nom;?>" required /></td>
            </tr>
            <tr>
            <td><label>Etat</label></td>
            <td><input type="text" name="etat_commande" value="<?php echo $commande_cible->etat_commande;?>" required /></td>
            </tr>
            <input type="hidden" name="id" value="<?php echo $commande_cible->id_commande; ?>" />
            <tr>
            <td><input type="submit" name="valider_modifier" value="Modifier" /></td>
            <td><input type="submit" name="annuler" value="Annuler" /></td>
            </tr>

        </table>
    </form>
</div>
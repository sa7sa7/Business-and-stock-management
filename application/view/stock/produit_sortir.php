<div class="table-title">
<h3>sortir le produit <?php echo $produit_cible->nom_produit ?></h3>
</div>
<br><br><br>
<div class= "container" style="width: 700px" >
    <form action= "<?php echo URL; ?>stock/sortirproduit" method="POST" >
        <h3>Sortir du stock des entrepots correspondants</h3>
        <table class="table">
        <?php foreach ($entrepots as $entrepot) { ?>
            <tr >
            <td> L'entrepot : <?php if (isset($entrepot->nom_entrepot)) echo $entrepot->nom_entrepot ; ?> </td>
            <td>La quantité dans l'entrepot : <?php if (isset($entrepot->quantite_reel)) echo $entrepot->quantite_reel ; ?></td>
            </tr>
            <td><label>Quantité à sortir :</label></td>
            <td><input type="text" name="quantite_entrepot[]" value="0" style="width: 170px" /></td>
            <td><label>Type sortie :</label></td>
            <td><input type="text" name="type_sortie[]" value="" style="width: 170px" /></td>
            <td><input type="hidden" name="entrepot_choisi[]" value="<?php echo $entrepot->id_entrepot ; ?>" /></td>
            </tr>
        <?php } ?>
        </table>
            <tr>
            <td><input type="hidden" name="id_produit" value="<?php echo $produit_cible->id_produit ?>" /></td>
            <td><input type="submit" name="valider_sortir_produit" value="Envoyer"/></td>
            <td><input type="reset" value="Annuler"/></td>
            </tr>
        </table>
    </form>
</div>
<div class="table-title">
<h3>sortir le produit <?php echo $produit_cible->nom_produit ?></h3>
</div>
<br><br><br>
<div class= "container" style="width: 700px" >
        <h3>Repartition du stock sur ses entrepots correspondants</h3>
        <table class="table">
        <?php foreach ($entrepots as $entrepot) { ?>
            <tr>
            <td> L'entrepot : <?php if (isset($entrepot->nom_entrepot)) echo $entrepot->nom_entrepot ; ?> </td>
            <td>La quantité dans l'entrepot : <?php if (isset($entrepot->quantite_reel)) echo $entrepot->quantite_reel ; ?></td>
            </tr>
        <?php } ?>
        </table>
</div>
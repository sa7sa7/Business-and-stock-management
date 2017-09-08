<!--

<div class="box">
<?php 
    $compteur = 0;
    foreach ($produits as $produit) 
    { 
        $compteur ++?>
        <div class="grid-objects">
            <div class="text-left"><?php echo $compteur; ?></div>
            <p>Nom : <?php echo '  '. $produit->nom_produit ; ?></p>
            <p>Quantite :<?php echo '  '.$produit->quantite_total_produit ; ?></p>
            <p><a href="<?php echo URL . 'produit/afficherInfoProduit/' . $produit->id_produit; ?>">Gérer</a></p>
        </div>
<?php } ?>

</div>

-->

<div class="table-title">
<h3>Liste des Produits</h3>
</div>

        <table class="table-fill">

            <thead>
            <tr>
                <th class="text-center">N°</th>
                <th class="text-center">Nom</th>
                <th class="text-center">Code</th>
                <th class="text-center">Categorie</th>
                <th class="text-center">Prix d'achat</th>
                <th class="text-center">Stock Minimal</th>
                <th class="text-center">Quantité Totale</th>
                <th class="text-center" colspan="3">Operations</th>
            </tr>
            </thead>
            <tbody>
                <?php 
                $compteur = 0;
                foreach ($produits as $produit) 
                { 
                    $compteur ++?>
                    <tr>
                        <td class="text-left"><?php echo $compteur; ?></td>
                        <td class="text-left"><?php echo $produit->nom_produit ; ?></td>
                        <td class="text-left"><?php echo $produit->code_produit ; ?></td>
                        <td class="text-left"><?php echo $produit->nom_categorie ; ?></td>
                        <td class="text-left"><?php echo $produit->prix_achat_produit ; ?></td>
                        <td class="text-left"><?php echo $produit->stock_minimal_produit ; ?></td>
                        <td class="text-left"><?php echo $produit->quantite_total_produit ; ?></td>
                        <td class="text-left"><a href="<?php echo URL . 'stock/approvisionnerproduit/' . $produit->id_produit; ?>">Approvisionner</a></td>
                        <td class="text-left"><a href="<?php echo URL . 'stock/sortirproduit/' . $produit->id_produit; ?>">Sortir</a></td>
                        <td class="text-left"><a href="<?php echo URL . 'stock/repartitionproduit/' . $produit->id_produit; ?>">Repartition</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>


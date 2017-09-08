<div class="box">
<?php 
    $compteur = 0;
    foreach ($produits as $produit) 
    { 
        $compteur ++?>
        <div class="grid-objects">
            <!--<div class="text-left"><?php echo $compteur; ?></div>-->
            <p>Nom : <?php echo '  '. $produit->nom_produit ; ?></p>
            <p>Quantite :<?php echo '  '.$produit->quantite_total_produit ; ?></p>
            <p><a href="<?php echo URL . 'produit/afficherInfoProduit/' . $produit->id_produit; ?>">Gérer</a></p>
        </div>
<?php } ?>

</div>
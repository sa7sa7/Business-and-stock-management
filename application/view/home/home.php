<?php 
if(count($produits) == 0)
{ ?>
	<div class="table-title">
	<h3>Pas d'Alertes.</h3>
	</div>
<?php }else
{ ?>
	<div class="table-title">
	<h3>Vos Alertes</h3>
	</div>
	
	<table class="table-fill">
	    <thead>
	    <tr>
	        <th class="text-center">N°</th>
	        <th class="text-center">Nom Produit</th>
	        <th class="text-center">Stock Minimal</th>
	        <th class="text-center">Stock Total</th>
	    </tr>
	    </thead>

	    <tbody class="table-hover">
	        <?php 
	        $compteur = 0;
	        foreach ($produits as $produit) 
	        { 
	            $compteur ++?>
	            <tr>
	                <td class="text-left"><?php echo $compteur; ?></td>
	                <td class="text-left"><?php echo $produit->nom_produit; ?></td>
	                <td class="text-left"><?php echo $produit->stock_minimal_produit; ?></td>
	        		<td class="text-left"><?php echo $produit->quantite_total_produit; ?></td>
	            </tr>
	        <?php } ?>
	    </tbody>
	</table>
<?php } ?>
    
</div>
<div class="table-title">
<h3>Liste des Commandes</h3>
</div>

<table class="table-fill">

    <thead>
    <tr>
        <th class="text-center">N°</th>
        <th class="text-center">fournisseur</th>
        <th class="text-center">Produit</th>
        <th class="text-center">Date</th>
        <th class="text-center">Quantite</th>
        <th class="text-center">User</th>
        <th class="text-center">Etat</th>
    </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($commandes as $commande) 
        { ?>
            <tr>
                <td class="text-left"><?php echo $commande->id_commande; ?></td>
                <td class="text-left"><?php echo $commande->nom_fournisseur ; ?></td>
                <td class="text-left"><?php echo $commande->nom_produit ; ?></td>
                <td class="text-left"><?php echo $commande->date_commande ; ?></td>
                <td class="text-left"><?php echo $commande->quantite_commande ; ?></td>
                <td class="text-left"><?php echo $commande->nom ; ?></td> <!--user-->
                <td class="text-left"><?php echo $commande->etat_commande ; ?></td>
                <td class="text-left"><a href="<?php echo URL . 'commande/supprimercommande/' . $commande->id_commande; ?>">Supprimer</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
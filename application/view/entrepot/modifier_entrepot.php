<div class="table-title">
<h3>Liste des Entrepots</h3>
</div>

        <table class="table-fill">
            <thead>
            <tr>
                <th class="text-center">N°</th>
                <th class="text-center">Nom</th>
                <th class="text-center">Adresse</th>
            </tr>
            </thead>
            <tbody>
                <?php 
                $compteur = 0;
                foreach ($entrepots as $entrepot) 
                { 
                    $compteur ++?>
                    <tr>
                        <td class="text-left"><?php echo $compteur; ?></td>
                        <td class="text-left"><?php echo $entrepot->nom_entrepot ; ?></td>
                        <td class="text-left"><?php echo $entrepot->addresse_entrepot ; ?></td>
                        <td class="text-left"><a href="<?php echo URL . 'entrepot/modifierentrepot/' . $entrepot->id_entrepot; ?>">Modifier</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
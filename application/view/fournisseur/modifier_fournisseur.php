<div class="table-title">
<h3>Liste des fournisseurs</h3>
</div>

        <table class="table-fill">

            <thead>
            <tr>
                <th class="text-center">N°</th>
                <th class="text-center">Nom</th>
                <th class="text-center">Adresse</th>
                <th class="text-center">numéro de téléphone</th>
            </tr>
            </thead>
            <tbody>
                <?php 
                $compteur = 0;
                foreach ($fournisseurs as $fournisseur) 
                { 
                    $compteur ++?>
                    <tr>
                        <td class="text-left"><?php echo $compteur; ?></td>
                        <td class="text-left"><?php echo $fournisseur->nom_fournisseur ; ?></td>
                        <td class="text-left"><?php echo $fournisseur->addresse_fournisseur ; ?></td>
                        <td class="text-left"><?php echo $fournisseur->num_tel_fournisseur ; ?></td>
                        <td class="text-left"><a href="<?php echo URL . 'fournisseur/modifierfournisseur/' . $fournisseur->id_fournisseur; ?>">Modifier</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
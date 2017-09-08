<div class="table-title">
<h3>Liste Des Profils Pour Supprimer</h3>
</div>

        <table class="table-fill">

            <thead>
            <tr>
                <th class="text-center">N°</th>
                <th class="text-center">Nom Profil</th>
            </tr>
            </thead>

            <tbody class="table-hover">
                <?php 
                $compteur = 0;
                foreach ($profils as $profil) 
                { 
                    $compteur ++?>
                    <tr>
                        <td class="text-left"><?php echo $compteur; ?></td>
                        <td class="text-left"><?php echo $profil->nom; ?></td>
                        <td class="text-left"><a href="<?php echo URL . 'profil/supprimerprofil/' . $profil->id_profil; ?>">Supprimer</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
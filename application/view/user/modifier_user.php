<div class="table-title">
<h3>Liste des Utilisateurs Pour Modifier</h3>
</div>

        <table class="table-fill">

            <thead>
            <tr>
                <th class="text-center">N°</th>
                <th class="text-center">Identifiant</th>
                <th class="text-center">Profil</th>
                <th class="text-center">Nom</th>
                <th class="text-center">Prénom</th>
            </tr>
            </thead>

            <tbody>
                <?php 
                $compteur = 0;
                foreach ($users as $user) 
                { 
                    $compteur ++?>
                    <tr>
                        <td class="text-left"><?php echo $compteur; ?></td>
                        <td class="text-left"><?php echo $user->login; ?></td>
                        <td class="text-left"><?php echo $this->model->get_profil_id($user->id_profil)->nom; ?></td>
                        <td class="text-left"><?php echo $user->nom; ?></td>
                        <td class="text-left"><?php echo $user->prenom; ?></td>
                        <td class="text-left"><a href="<?php echo URL . 'user/modifieruser/' . $user->id_user; ?>">Modifier</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
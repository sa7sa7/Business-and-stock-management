<div class="table-title">
<h3>Liste Des Menu Pour Modifier</h3>
</div>

        <table class="table-fill">

            <thead>
            <tr>
                <th class="text-center">N°</th>
                <th class="text-center">Nom Menu</th>
                <th class="text-center">Parent</th>
                <th class="text-center">Lien</th>
            </tr>
            </thead>

            <tbody class="table-hover">
                <?php 
                $compteur = 0;
                foreach ($all_menus as $all_menu) 
                { 
                    $compteur ++?>
                    <tr>
                        <td class="text-left"><?php echo $compteur; ?></td>
                        <td class="text-left"><?php echo $all_menu->nom; ?></td>
                        <td class="text-left"><?php $parent = $this->model->get_menu_id($all_menu->id_menu_parent); if(isset($parent->nom) == true) echo $parent->nom; else echo 'Pas de Parent'; ?></td>
                        <td class="text-left"><?php if($all_menu->lien != NULL) echo $all_menu->lien; else echo 'Pas de Lien'; ?></td>
                        <td class="text-left"><a href="<?php echo URL . 'menu/modifiermenu/' . $all_menu->id_menu; ?>">Modifier</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
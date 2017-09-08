<link rel="stylesheet" href="<?php echo URL; ?>css/jsDatePick_ltr.min.css">


<div class="table-title">
<h3>L'historique de votre stock </h3>
</div>
<br><br><br>
<div class= "container" style="width: 800px ;">
    <form action= "<?php echo URL; ?>stock/consulterhistorique" method="POST">
        
        <table class="table" >
            <h3 style="font-size: 1.2em; margin: 20px;">Options de filtrage</h3>
            <tbody id="dynamicInput">
            <tr>
            <td><label>Produit</label></td>
            <td><select name="produit_stock" width="10">
            <option value="0">Tous les produits: </option>
            <?php foreach ($produits as $produit) { ?>
            <?php if (isset($produit->nom_produit)) {echo "<option value=".$produit->id_produit ; if($produit->id_produit==$options['produit_stock']) {echo ' selected="selected"' ;} echo ">". $produit->nom_produit ."</option>" ;} ?>
            <?php } ?>
            </select></td>
            </tr>
            <tr>
            <td><label>Entrepot :</label></td>
            <td><select name="entrepot_stock" width="10">
            <option value="0">Tous les entrepots</option>
            <?php foreach ($entrepots as $entrepot) { ?>
            <?php if (isset($entrepot->nom_entrepot)) {echo "<option value=".$entrepot->id_entrepot ; if($entrepot->id_entrepot==$options['entrepot_stock']) {echo ' selected="selected"' ;} echo ">". $entrepot->nom_entrepot ."</option>" ;} ?>
            <?php } ?>
            </select></td>
            </tr>
            <tr>
            <td><label>Date de début:</label></td>
            <td><input type="text" name="date_stock_1" id="date_stock_1" size="10" value="<?php if($options['date_stock_1']!='0') {echo $options['date_stock_1'];} ?>" /></td>
            </tr>
            <tr>
            <td><label>Date de fin:</label></td>
            <td><input type="text" name="date_stock_2" id="date_stock_2" size="10" value="<?php if($options['date_stock_2']!='0') {echo $options['date_stock_2'];} ?>" /></td>
            </tr>
            <tr>
            <td><label>User</label></td>
            <td><select name="user_stock" width="10">
            <option value="0">Tous les users</option>
            <?php foreach ($users as $user) { ?>
            <?php if (isset($user->nom)) {echo "<option value=".$user->id_user ; if($user->id_user==$options['user_stock']) {echo ' selected="selected"' ;} echo ">". $user->nom ."</option>" ;} ?>
            <?php } ?>
            </select></td>
            </tr>

            <tr>
            <td><label>Type de mouvement :</label></td>
            <td><select name="type_mouvement_stock" >
            <option value="0" >Tous mouvements</option>
            <option value="approvisionnement" value="<?php if($options['type_mouvement_stock']=='approvisionnement') {echo 'selected="selected"';} ?>">Approvisionnement</option>
            <option value="sortie" "<?php if($options['type_mouvement_stock']=='sortie'){echo 'selected="selected"' ;} ?>" >Sortie</option>
            </select></td>
            </tr>

            <tr>
            <td><input type="submit" name="valider_consulter_historique" value="Envoyer"/></td>
            <td><input type="reset" value="Annuler"/></td>
            </tr>

            </tbody>
        </table>
    </form>

    <table class="table-fill">

            <thead>
            <tr>
                <th class="text-center">N°</th>
                <th class="text-center">Produit</th>
                <th class="text-center">Entrepot</th>
                <th class="text-center">Date</th>
                <th class="text-center">User</th>
                <th class="text-center">Quantite</th>
                <th class="text-center">Type de mouvement</th>
                <th class="text-center">Type de soritie</th>
            </tr>
            </thead>
            <tbody>
                <?php 
                $compteur = 0;
                foreach ($historique as $hist) 
                { 
                    $compteur ++?>
                    <tr>
                        <td class="text-left"><?php echo $compteur; ?></td>
                        <td class="text-left"><?php echo $hist->nom_produit ; ?></td>
                        <td class="text-left"><?php echo $hist->nom_entrepot ; ?></td>
                        <td class="text-left"><?php echo $hist->date_stock ; ?></td>
                        <td class="text-left"><?php echo $hist->nom ; ?></td> <!--user-->
                        <td class="text-left"><?php echo $hist->quantite_stock ; ?></td>
                        <td class="text-left"><?php echo $hist->type_mouvement_stock ; ?></td>
                        <td class="text-left"><?php echo $hist->type_sortie_stock ; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

</div>

<script type="text/javascript" src="<?php echo URL; ?>js/jsDatePick.min.1.3.js"></script>

<script type="text/javascript">
    window.onload = function(){
        new JsDatePick({
            useMode:2,
            target:"date_stock_1",
            dateFormat:"%Y-%m-%d"
        });
        new JsDatePick({
            useMode:2,
            target:"date_stock_2",
            dateFormat:"%Y-%m-%d"
        });
    };
</script>

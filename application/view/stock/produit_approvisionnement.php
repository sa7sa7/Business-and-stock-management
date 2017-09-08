<div class="table-title">
<h3>Approvisionner le produit <?php echo $produit_cible->nom_produit ?></h3>
</div>
<br><br><br>
<div class= "container">
    <form action= "<?php echo URL; ?>stock/approvisionnerproduit" method="POST">
        <h3>Repartissez votre approvisinnement sur différents entrepots</h3>
        <table class="table">
        	<tbody id="dynamicInput">
            <tr>
            <td><label>Choisir L'entrepot </label></td>
            <td><select name="entrepot_choisi[]">
            <?php foreach ($entrepots as $entrepot) { ?>
            <?php if (isset($entrepot->nom_entrepot)) echo "<option value=".$entrepot->id_entrepot .">".$entrepot->nom_entrepot."</option>" ; ?>
            <?php } ?>
            </select></td>
            <td><label>Quantité :</label></td>
            <td><input type="text" name="quantite_entrepot[]" value="" /></td>
            </tr>
            </tbody>
        </table>
        
        <table>
            <tr>
            <td><input type="hidden" name="id_produit" value="<?php echo $produit_cible->id_produit ?>" /></td>
            <td><input type="button" value="Utiliser un autre entrepot..." onclick="addInput('dynamicInput');" /></td>
            <td><input type="submit" name="valider_approvisionner_produit" value="Envoyer"/></td>
            <td><input type="reset" value="Annuler"/></td>
            </tr>
        </table>
    </form>
</div>

<script language="javascript">
    function addInput(divName)
    {
        var newElm=document.createElement('tr');
        var str = "<td><label>Choisir L'entrepot </label></td>" ;
        str = str + '<td><select name="entrepot_choisi[]">' ;
        str += '<?php foreach ($entrepots as $entrepot) { ?> <?php if (isset($entrepot->nom_entrepot)) echo "<option value=".$entrepot->id_entrepot .">".$entrepot->nom_entrepot."</option>" ; ?> <?php } ?>' ;
        //alert(str) ;
        str = str + "</select>" ;
        str = str + "</td>" ;
        str = str + '<td><label>Quantité :</label></td> <td><input type="text" name="quantite_entrepot[]" value="" /></td><br><br>';
        newElm.innerHTML=str;
        document.getElementById(divName).appendChild(newElm);
    }
</script>


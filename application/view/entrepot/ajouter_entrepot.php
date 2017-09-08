<br><br><br>
<div class= "container">
    <form action= "<?php echo URL; ?>entrepot" method="POST">
        <table class="table">

            <tr>
            <td><label>Nom du entrepot</label></td>
            <td><input type="text" name="nom_entrepot" required /></td>
            </tr>

            <tr>
            <td><label>L'adresse</label></td>
            <td><input type="text" name="addresse_entrepot" required /></td>
            </tr>

            <tr>
            <td><input type="submit" name="valider_ajouter_entrepot" value="Envoyer"/></td>
            <td><input type="reset" value="Annuler"/></td>
            </tr>

        </table>
    </form>
</div>

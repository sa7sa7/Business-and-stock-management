<br><br><br>
<div class="container">
    <h3>Modifier Un Profil</h3>
    <form action="<?php echo URL; ?>profil/modifierprofil" method="POST">
        <table class="table">

            <tr>
            <td><label>Nom</label></td>
            <td><input type="text" name="name" value="<?php echo $profil->nom; ?>" required /></td>
            </tr>

            <input type="hidden" name="id" value="<?php echo $profil->id_profil; ?>" />
            <tr>
            <td><input type="submit" name="valider_modifier" value="Modifier" /></td>
            <td><input type="submit" name="annuler" value="Annuler" /></td>
            </tr>
        <table>
    </form>
</div>
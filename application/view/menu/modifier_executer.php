<br><br><br>
<div class="container">
    <h3>Modifier Un Menu</h3>
    <form action="<?php echo URL; ?>menu/modifiermenu" method="POST">
        <table class="table">

            <tr>
            <td><label>Nom</label></td>
            <td><input type="text" name="nom" value="<?php echo $menu_cible->nom; ?>" required /></td>
            </tr>

            <tr>
            <td><label>Lien</label></td>
            <td><input id="lien" type="text" name="lien" value="<?php echo $menu_cible->lien; ?>" required  <?php if(isset($parent->nom) == false) echo 'readonly'; ?>/></td>
            </tr>

            <tr>
            <td><label>Parent</label></td>
            <td>
            <select id= "parent" name="parent" onchange ="changer_menu()" >
                <option <?php if(isset($parent->nom) == false) echo 'selected';?> >Pas de Parent</option>
                <?php
                foreach ($menus as $menu) 
                { ?>
                    <option <?php if((isset($parent->nom) == true) && ($parent->nom == $menu->nom )) echo 'selected';?> ><?php echo $menu->nom;?></option>
               <?php }?>
                
            </select>
            </td>
            </tr>

            <input type="hidden" name="id" value="<?php echo $menu_cible->id_menu; ?>" />
            <tr>
            <td><input type="submit" name="valider_modifier" value="Modifier" /></td>
            <td><input type="submit" name="annuler" value="Annuler" /></td>
            </tr>
        <table>
    </form>
</div>

<script language="javascript">
function changer_menu()
{ 
    var bool = false;
    var select = document.getElementById("parent");

    for (i=0; i<select.options.length; i++) 
    { 
      if ((select.options[i].selected ) && (select.options[i].text == "Pas de Parent" ))
      { 
        bool = true;
        document.getElementById("lien").readOnly = true;
      } 
    }

    if(bool == false)
    {
        document.getElementById("lien").readOnly = false;
    } 
}
</script>
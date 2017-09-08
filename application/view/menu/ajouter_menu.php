<br><br><br>
<div class= "container">
    <form action= "<?php echo URL; ?>menu" method="POST">
        <table class="table">

            <tr>
            <td><label>Nom</label></td>
            <td><input type="text" name="nom" required /></td>
            </tr>

            <tr>
            <td><label>Lien</label></td>
            <td><input type="text" name="lien" id = "lien" value="<?php echo $lien;?>" required readonly/></td>
            </tr>

            <tr>
            <td><label>Parent</label></td>
            <td>
            <select id= "parent" name="parent" onchange ="changer_menu()" >
                <option <?php if($parent_selecte == 'NULL') echo 'selected';?> >Pas de Parent</option>
                <?php
                foreach ($menus as $menu) 
                { ?>
                    <option <?php if($parent_selecte == $menu->nom) echo 'selected';?> ><?php echo $menu->nom;?></option>
               <?php }?>
                
            </select>
            </td>
            </tr>
            
            <tr>
            <td><input type="submit" name="valider_ajouter" value="Envoyer"/></td>
            <td><input type="reset" value="Annuler"/></td>
            </tr>

        </table>
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
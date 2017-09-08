<br><br><br>
<div class= "container">
    <form action= "<?php echo URL; ?>profil" method="POST">

        <table class="table">
            <tr>
            <td><label>Nom</label></td>
            <td><input type="text" name="nom" required /></td>
            </tr>
        </table> 

        <table class="table">
            <?php 
            $all_menus = $this->model->get_all_menu();
            $compteur = 0;
            foreach ($all_menus as $all_menu) 
            { 
                $compteur ++;
                $sous_menus = $this->model->get_all_sous_menu($all_menu->id_menu);
                ?>
                
                <tr> 

                <td rowspan="<?php echo count($sous_menus); ?>"><?php echo $all_menu->nom;?></td>
                <td rowspan="<?php echo count($sous_menus); ?>">
                    <input type="checkbox" onclick="toucher_pere_<?php echo $compteur; ?>(this)"  id="box_pere_<?php echo $compteur; ?>">  
                </td>
                 
                <script language="javascript">
                function toucher_pere_<?php echo $compteur;?>(box) 
                {
                    if(box.checked == true)
                    {
                        <?php    
                        foreach ($sous_menus as $sous_menu) 
                        { ?>
                        document.getElementById("box_<?php echo $sous_menu->id_menu;?>").checked = true;
                        <?php  } ?>
                    }else
                    {
                        <?php    
                        foreach ($sous_menus as $sous_menu) 
                        { ?>
                        document.getElementById("box_<?php echo $sous_menu->id_menu;?>").checked = false;
                        <?php  } ?>
                    }
                }
                </script>

                <?php
                $compteur1 = 0;    
                foreach ($sous_menus as $sous_menu) 
                { 
                    $compteur1 ++;
                    if($compteur1 != 1)
                    {?>
                        <tr>  
                    <?php }?>      

                    <td>  <li>  <?php echo $sous_menu->nom;?> </li> </td>
                    <td>  
                        <input type="checkbox" name="box_<?php echo $sous_menu->id_menu;?>" id="box_<?php echo $sous_menu->id_menu;?>"  onclick="toucher_fils_<?php echo $sous_menu->id_menu; ?>(this)" >
                    </td> 
                    </tr>

                    <script language="javascript">
                    function toucher_fils_<?php echo $sous_menu->id_menu; ?>(box) 
                    {
                        if(box.checked == true)
                        {
                            document.getElementById("box_pere_<?php echo $compteur; ?>").checked = true;
                        }else
                        if(
                        <?php    
                        foreach ($sous_menus as $sous_menu) 
                        { ?>
                        (document.getElementById("box_<?php echo $sous_menu->id_menu;?>").checked == false) &&
                        <?php  } ?>
                            1 )
                        {
                            document.getElementById("box_pere_<?php echo $compteur; ?>").checked = false;
                        }
                    }
                    </script>

            <?php  }
            } ?>

            <tr>
            <td><input type="submit" name="valider_ajouter" value="Envoyer"/></td>
            <td><input type="reset" value="Annuler"/></td>
            </tr>

        </table>
    </form>
</div>



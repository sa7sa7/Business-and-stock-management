<br><br><br>
<div class= "container">
    <form action="<?php echo URL; ?>profil/modifierdroitacces" method="POST">

        <div id="container">

            <div id="parentVerticalTab">

                <ul class="resp-tabs-list hor_1">
                <?php 
                    foreach ($profils as $profil) 
                    { ?>

                    <li <?php if($profil->nom == $nom) echo 'class="resp-tab-item hor_1 resp-tab-active"';?> ><?php echo $profil->nom; ?></li>  

                <?php } ?>
                </ul>

                
                <div class="resp-tabs-container hor_1">

                <?php 
                $compteur1 = 0;
                foreach ($profils as $profil) 
                { 
                    $compteur1 ++;?>
                    <div <?php if($profil->nom == $nom) echo 'class="resp-tab-content hor_1 resp-tab-content-active"';?> > 
                    <table class="table">    

                    <?php 
                    $compteur2 = 0;
                    foreach ($all_menus as $all_menu) 
                    { 
                        $compteur2 ++;
                        $sous_menus = $this->model->get_all_sous_menu($all_menu->id_menu);
                        ?>
                                
                        <tr> 

                        <td rowspan="<?php echo count($sous_menus); ?>"><?php echo $all_menu->nom;?></td>
                        <td rowspan="<?php echo count($sous_menus); ?>">
                            <input type="checkbox" onclick="toucher_pere_<?php echo $compteur1 . '_' . $compteur2; ?>(this)" id="box_pere_<?php echo $compteur1 . '_' . $compteur2; ?>" <?php if( $this->model->verifier_droit_acces($all_menu->id_menu, '', $profil->id_profil) == true) echo 'checked';?> > 
                        </td>

                        <script language="javascript">
                        function toucher_pere_<?php echo $compteur1 . '_' . $compteur2; ?>(box) 
                        {
                            if(box.checked == true)
                            {
                                <?php    
                                foreach ($sous_menus as $sous_menu) 
                                { ?>
                                document.getElementById("<?php echo 'box_' . $profil->id_profil . '_' . $sous_menu->id_menu;?>").checked = true;
                                <?php  } ?>
                            }else
                            {
                                <?php    
                                foreach ($sous_menus as $sous_menu) 
                                { ?>
                                document.getElementById("<?php echo 'box_' . $profil->id_profil . '_' . $sous_menu->id_menu;?>").checked = false;
                                <?php  } ?>
                            }
                        }
                        </script>
                        
                        <?php    
                            $compteur3 = 0; 
                            foreach ($sous_menus as $sous_menu) 
                            { 
                                $compteur3 ++;
                                if($compteur3 != 1)
                                {?>
                                    <tr>  
                                <?php }?> 
                                        
                                <td>  <li>  <?php echo $sous_menu->nom;?> </li> </td>
                                <td>
                                    <input type="checkbox" name="<?php echo 'box_' . $profil->id_profil . '_' . $sous_menu->id_menu;?>" id= "<?php echo 'box_' . $profil->id_profil . '_' . $sous_menu->id_menu;?>" onclick="toucher_fils_<?php echo $profil->id_profil .'_'. $sous_menu->id_menu; ?>(this)" <?php if( $this->model->verifier_droit_acces($sous_menu->id_menu, '', $profil->id_profil) == true) echo 'checked';?> />
                                </td> 
                                </tr> 

                                <script language="javascript">
                                function toucher_fils_<?php echo $profil->id_profil .'_'. $sous_menu->id_menu; ?>(box) 
                                {
                                    if(box.checked == true)
                                    {
                                        document.getElementById("box_pere_<?php echo $compteur1 . '_' . $compteur2; ?>").checked = true;
                                    }else
                                    if(
                                    <?php    
                                    foreach ($sous_menus as $sous_menu) 
                                    { ?>
                                    (document.getElementById("<?php echo 'box_' . $profil->id_profil . '_' . $sous_menu->id_menu;?>").checked == false) &&
                                    <?php  } ?>
                                        1 )
                                    {
                                        document.getElementById("box_pere_<?php echo $compteur1 . '_' . $compteur2; ?>").checked = false;
                                    }
                                }
                                </script> 

                        <?php  } 
                     } ?>
                    </table>
                    </div>
                    <?php } ?>

                </div>

            </div>

            <div class="box">
                <table>
                    <input type="hidden" id= "nom_profil" name="nom_profil" value="<?php echo $nom;?>" />
                    <tr><td><input type="submit" name="valider_modifierdroitacces" value="Valider" /></td></tr>
                </table>
            </div>

        </div>

    </form>
</div>



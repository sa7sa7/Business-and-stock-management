<?php

class Menu extends Controller
{
    function __construct()
    {
        Controller::__construct('model/model_menu.php','Model_menu');
    }

    public function index()
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_ajoutermenu, $_SESSION['id_user']) == true)
            {
                $nom = '';
                $lien = '';
                $parent_selecte = 'Pas de Parent';

                if (( isset($_POST["valider_ajouter"]) == true ) && ( isset($_POST["nom"]) == true ) && ( isset($_POST["lien"]) == true ) && ( isset($_POST["parent"]) == true ) )
                { 
                    $retour = false;

                    $nom = $_POST["nom"];
                    $lien = $_POST["lien"];
                    $parent_selecte = $_POST["parent"];

                    $retour = $this->model->add_menu($nom, $lien, $parent_selecte);
                    $menus = $this->model->get_all_menu();

                    if($retour == true )
                    {
                        $nom = '';
                        $lien = '';
                        $parent_selecte = 'NULL';

                        require APP . 'view/_templates/header.php';
                        require APP . 'view/menu/done_ajouter.php';
                        require APP . 'view/menu/ajouter_menu.php';
                        require APP . 'view/_templates/footer.php';
                    }else
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/menu/echec_ajouter.php';
                        require APP . 'view/menu/ajouter_menu.php';
                        require APP . 'view/_templates/footer.php';
                    }
                }else
                {
                    $menus = $this->model->get_all_menu();

                    require APP . 'view/_templates/header.php';
                    require APP . 'view/menu/ajouter_menu.php';
                    require APP . 'view/_templates/footer.php';
                }
            }else
                header('location: ' . URL . 'error');
        }else
            header('location: ' . URL);
    }

    public function supprimermenu($id_menu = '')
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_supprimermenu, $_SESSION['id_user']) == true)
            {

                if((isset($_POST["valider_supprimer"]) == true) && (isset($_POST["id"]) == true))
                {
                    $retour = false;
                    $retour = $this->model->delete_menu($_POST["id"]);
                    $all_menus = $this->model->get_all();

                    if($retour == true)
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/menu/done_supprimer.php';
                        require APP . 'view/menu/supprimer_menu.php';
                        require APP . 'view/_templates/footer.php';
                    }else
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/menu/echec_supprimer.php';
                        require APP . 'view/menu/supprimer_menu.php';
                        require APP . 'view/_templates/footer.php';
                    }
                }else
                if($id_menu != '') 
                {
                    $menu_cible = $this->model->get_menu_id($id_menu);
                    
                    if($menu_cible != NULL)
                    {
                        $all_menus = $this->model->get_all();

                        require APP . 'view/_templates/header.php';
                        require APP . 'view/menu/supprimer_executer.php';
                        require APP . 'view/menu/supprimer_menu.php';
                        require APP . 'view/_templates/footer.php';  
                    }else
                        header('location: ' . URL . 'error');
                }else
                {
                    $all_menus = $this->model->get_all();

                    require APP . 'view/_templates/header.php';
                    require APP . 'view/menu/supprimer_menu.php';
                    require APP . 'view/_templates/footer.php'; 
                }
            }else
                header('location: ' . URL . 'error');
        }else
            header('location: ' . URL);
    }

    public function modifiermenu($menu_id = '')
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_modifiermenu, $_SESSION['id_user']) == true)
            {

                if((isset($_POST["valider_modifier"]) == true) && (isset($_POST["id"]) == true) && ( isset($_POST["nom"]) == true ) && ( isset($_POST["lien"]) == true ) && ( isset($_POST["parent"]) == true ) )
                {
                    $id_menu = $_POST["id"];
                    $parent =$_POST["parent"];
                    $lien = $_POST["lien"];

                    if($parent == 'Pas de Parent')
                    {
                        $id_menu_parent = 0;
                        $lien = NULL;
                    }
                    else
                        $id_menu_parent = $this->model->get_menu_nom($parent)->id_menu;

                    if($id_menu != $id_menu_parent)
                    {
                        $retour = false;
                        $retour = $this->model->update_menu($id_menu, $_POST["nom"], $id_menu_parent, $lien);
                        $all_menus = $this->model->get_all();

                        if($retour == true)
                        {
                            require APP . 'view/_templates/header.php';
                            require APP . 'view/menu/done_modifier.php';
                            require APP . 'view/menu/modifier_menu.php';
                            require APP . 'view/_templates/footer.php';
                        }
                    }

                    if(($id_menu == $id_menu_parent) || ($retour == false))
                    {
                        $all_menus = $this->model->get_all();

                        require APP . 'view/_templates/header.php';
                        require APP . 'view/menu/echec_modifier.php';
                        require APP . 'view/menu/modifier_menu.php';
                        require APP . 'view/_templates/footer.php';
                    }
                }else
                if($menu_id != '') 
                {
                    $menu_cible = $this->model->get_menu_id($menu_id);
                    $menus = $this->model->get_all_menu();

                    if($menu_cible != NULL)
                    {
                        $parent = $this->model->get_menu_id($menu_cible->id_menu_parent);

                        require APP . 'view/_templates/header.php';
                        require APP . 'view/menu/modifier_executer.php';
                        require APP . 'view/_templates/footer.php';  
                    }else
                        header('location: ' . URL . 'error');
                }else
                {
                    $all_menus = $this->model->get_all();

                    require APP . 'view/_templates/header.php';
                    require APP . 'view/menu/modifier_menu.php';
                    require APP . 'view/_templates/footer.php'; 
                }

            }else
                header('location: ' . URL . 'error');
        }else
            header('location: ' . URL);
    }
}

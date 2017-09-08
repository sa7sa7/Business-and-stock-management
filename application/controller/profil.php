<?php

class Profil extends Controller
{
    function __construct()
    {
        Controller::__construct('model/model_profil.php','Model_profil');
    }

    public function index()
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {
            if( $this->model->verifier_droit_acces(id_ajouterprofil, $_SESSION['id_user']) == true)
            {
                $nom = '';

                if (( isset($_POST["valider_ajouter"]) == true ) && ( isset($_POST["nom"]) == true ))
                { 
                    $retour = false;
                    $nom = $_POST["nom"];

                    $retour = $this->model->add_profil($nom);

                    if($retour == true )
                    {
                        $id_profil = $this->model->get_profil_nom($nom)->id_profil;
                        $all_menus = $this->model->get_all_menu();
                        
                        foreach ($all_menus as $all_menu) 
                        { 
                            $boolean = true;
                            $sous_menus = $this->model->get_all_sous_menu($all_menu->id_menu);
                            
                            foreach ($sous_menus as $sous_menu) 
                            {   
                                if(isset($_POST["box_" . $sous_menu->id_menu]) == true)
                                {
                                    if($boolean == true)
                                    {
                                        $boolean =false;
                                        $this->model->add_permission($all_menu->id_menu, $id_profil);
                                    }
                                    $this->model->add_permission($sous_menu->id_menu, $id_profil);
                                }
                            }
                        }
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/profil/done_ajouter.php';
                        require APP . 'view/profil/ajouter_profil.php';
                        require APP . 'view/_templates/footer.php';
                    }else
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/profil/echec_ajouter.php';
                        require APP . 'view/profil/ajouter_profil.php';
                        require APP . 'view/_templates/footer.php';
                    }
                }else
                {
                    require APP . 'view/_templates/header.php';
                    require APP . 'view/profil/ajouter_profil.php';
                    require APP . 'view/_templates/footer.php';
                }
            }else
                header('location: ' . URL . 'error');
        }else
            header('location: ' . URL);
    }

    public function supprimerprofil($id_profil = '')
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_supprimerprofil, $_SESSION['id_user']) == true)
            {
                if((isset($_POST["valider_supprimer"]) == true) && (isset($_POST["id"]) == true))
                {
                    $retour = false;
                    $retour = $this->model->delete_profil($_POST["id"]);
                    $profils = $this->model->get_all_profil();

                    if($retour == true)
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/profil/done_supprimer.php';
                        require APP . 'view/profil/supprimer_profil.php';
                        require APP . 'view/_templates/footer.php';
                    }else
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/profil/echec_supprimer.php';
                        require APP . 'view/profil/supprimer_profil.php';
                        require APP . 'view/_templates/footer.php';
                    }
                }else
                if($id_profil != '') 
                {
                    $profil = $this->model->get_profil_id($id_profil);

                    if($profil != NULL)
                    {
                        $profils = $this->model->get_all_profil();

                        require APP . 'view/_templates/header.php';
                        require APP . 'view/profil/supprimer_executer.php';
                        require APP . 'view/profil/supprimer_profil.php';
                        require APP . 'view/_templates/footer.php';  
                    }else
                        header('location: ' . URL . 'error');
                }else
                {
                    $profils = $this->model->get_all_profil();

                    require APP . 'view/_templates/header.php';
                    require APP . 'view/profil/supprimer_profil.php';
                    require APP . 'view/_templates/footer.php'; 
                }
            }else
                header('location: ' . URL . 'error');
        }else
            header('location: ' . URL);
    }

    public function modifierprofil($id_profil = '')
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_modifierprofil, $_SESSION['id_user']) == true)
            {
                if((isset($_POST["valider_modifier"]) == true) && (isset($_POST["name"]) == true) && (isset($_POST["id"]) == true))
                {
                    $retour = false;
                    $retour = $this->model->update_profil($_POST["id"], $_POST["name"]);
                    $profils = $this->model->get_all_profil();
                    if($retour == true)
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/profil/done_modifier.php';
                        require APP . 'view/profil/modifier_profil.php';
                        require APP . 'view/_templates/footer.php';
                    }else
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/profil/echec_modifier.php';
                        require APP . 'view/profil/modifier_profil.php';
                        require APP . 'view/_templates/footer.php';
                    }
                }else
                if($id_profil != '') 
                {
                    $profil = $this->model->get_profil_id($id_profil);

                    if($profil != NULL)
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/profil/modifier_executer.php';
                        require APP . 'view/_templates/footer.php';  
                    }else
                        header('location: ' . URL . 'error');
                }else
                {
                    $profils = $this->model->get_all_profil();

                    require APP . 'view/_templates/header.php';
                    require APP . 'view/profil/modifier_profil.php';
                    require APP . 'view/_templates/footer.php'; 
                }

            }else
                header('location: ' . URL . 'error');
        }else
            header('location: ' . URL);
    }

    public function modifierdroitacces()
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_modifierdroitacces, $_SESSION['id_user']) == true)
            {
                $profils = $this->model->get_all_profil();
                $all_menus = $this->model->get_all_menu();
                $nom = $profils[0]->nom;
                
                if (( isset($_POST["valider_modifierdroitacces"]) == true ) && (isset($_POST["nom_profil"]) == true))
                { 
                    $nom = $_POST["nom_profil"];
                    $id_profil = $this->model->get_profil_nom($nom)->id_profil;

                    foreach ($all_menus as $all_menu) 
                    { 
                        $boolean = true;
                        $sous_menus = $this->model->get_all_sous_menu($all_menu->id_menu);
                        
                        foreach ($sous_menus as $sous_menu) 
                        {   
                            if(isset($_POST["box_" . $id_profil . '_' . $sous_menu->id_menu]) == true)
                            {
                                if($boolean == true)
                                {
                                    $boolean =false;
                                    $this->model->add_permission($all_menu->id_menu, $id_profil);
                                }
                                $this->model->add_permission($sous_menu->id_menu, $id_profil);
                            }else
                                $this->model->delete_permission($sous_menu->id_menu, $id_profil);
                        }

                        if($boolean == true)
                            $this->model->delete_permission($all_menu->id_menu, $id_profil);
                    }

                    require APP . 'view/_templates/header.php';
                    require APP . 'view/profil/done_mise_a_jour.php';
                    require APP . 'view/profil/modifier_acces.php';
                    require APP . 'view/_templates/footer.php';
                }else
                {        
                    require APP . 'view/_templates/header.php';
                    require APP . 'view/profil/modifier_acces.php';
                    require APP . 'view/_templates/footer.php';
                }
             }else
                header('location: ' . URL . 'error');
        }else
            header('location: ' . URL);
    }
}

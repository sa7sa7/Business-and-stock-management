<?php

class Categorie extends Controller
{
    function __construct()
    {
        Controller::__construct('model/model_categorie.php','Model_categorie');
    }

    public function index()
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_ajoutercategorie, $_SESSION['id_user']) == true)
            {
                require APP . 'view/_templates/header.php';

                if ( ( isset($_POST["valider_ajouter"]) == true ) && ( isset($_POST["nom_categorie"]) == true ) && ( isset($_POST["description_categorie"]) == true ) && ( isset($_POST["image_categorie"]) == true ) )
                { 
                    $retour = true;
                    $arg = array("nom_categorie" => $_POST["nom_categorie"], "description_categorie" => $_POST["description_categorie"], "image_categorie" => $_POST["image_categorie"] ) ;
                    $retour = $this->model->ajouter_categorie($arg);
                    if($retour == true )
                    {
                        require APP . 'view/categorie/done_ajouter.php';
                    }else
                    {
                        require APP . 'view/categorie/echec_ajouter.php';
                    }
                }

                require APP . 'view/categorie/ajouter_categorie.php';
                require APP . 'view/_templates/footer.php';
            }else
                header('location: ' . URL . 'error');
        }else
            header('location: ' . URL);
    }

    public function supprimercategorie($id_categorie = '')
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_supprimercategorie, $_SESSION['id_user']) == true)
            {

                if((isset($_POST["valider_supprimer"]) == true) && (isset($_POST["id"]) == true))
                {
                    $retour = false;
                    $retour = $this->model->delete_categorie($_POST["id"]);
                    $categories = $this->model->get_all_categories();

                    if($retour == true)
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/categorie/done_supprimer.php';
                        require APP . 'view/categorie/supprimer_categorie.php';
                        require APP . 'view/_templates/footer.php';
                    }else
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/categorie/echec_supprimer.php';
                        require APP . 'view/categorie/supprimer_categorie.php';
                        require APP . 'view/_templates/footer.php';
                    }
                }else
                if($id_categorie != '') 
                {
                    $categorie_cible = $this->model->get_categorie_by_id($id_categorie);
                    
                    if($categorie_cible != NULL)
                    {
                        $categories = $this->model->get_all_categories();
                        
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/categorie/supprimer_executer.php';
                        require APP . 'view/categorie/supprimer_categorie.php';
                        require APP . 'view/_templates/footer.php';  
                    }else
                        header('location: ' . URL . 'error');
                }else
                {
                    $categories = $this->model->get_all_categories();

                    require APP . 'view/_templates/header.php';
                    require APP . 'view/categorie/supprimer_categorie.php';
                    require APP . 'view/_templates/footer.php'; 
                }
            }else
                header('location: ' . URL . 'error');
        }else
            header('location: ' . URL);
    }

    public function modifiercategorie($id_categorie='')
    {

        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_modifiercategorie, $_SESSION['id_user']) == true)
            {
                if((isset($_POST["valider_modifier"]) == true) && ( isset($_POST["nom_categorie"]) == true ) && ( isset($_POST["description_categorie"]) == true ) && ( isset($_POST["image_categorie"]) == true ) )
                {
                    $retour = true;
                    $arg = array("id_categorie" => $_POST["id"], "nom_categorie" => $_POST["nom_categorie"], "description_categorie" => $_POST["description_categorie"], "image_categorie" => $_POST["image_categorie"] ) ;
                    $retour = $this->model->update_categorie($arg);
                    $categories = $this->model->get_all_categories();
                    if($retour == true)
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/categorie/done_modifier.php';
                        require APP . 'view/categorie/modifier_categorie.php';
                        require APP . 'view/_templates/footer.php';
                    }else
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/categorie/echec_modifier.php';
                        require APP . 'view/categorie/modifier_categorie.php';
                        require APP . 'view/_templates/footer.php';
                    }
                }else
                if($id_categorie != '') 
                {
                    $categorie_cible = $this->model->get_categorie_by_id($id_categorie);
                    
                    if($categorie_cible != NULL)
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/categorie/modifier_executer.php';
                        require APP . 'view/_templates/footer.php';  
                    }else
                        header('location: ' . URL . 'error');
                }else
                {
                    $categories = $this->model->get_all_categories();

                    require APP . 'view/_templates/header.php';
                    require APP . 'view/categorie/modifier_categorie.php';
                    require APP . 'view/_templates/footer.php'; 
                }

            }else
                header('location: ' . URL . 'error');
        }else
            header('location: ' . URL);
    }
}
<?php

class Fournisseur extends Controller
{
    function __construct()
    {
        Controller::__construct('model/model_fournisseur.php','Model_fournisseur');
    }

    public function index()
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_ajouterfournisseur, $_SESSION['id_user']) == true)
            {
                require APP . 'view/_templates/header.php';

                if ( ( isset($_POST["valider_ajouter_fournisseur"]) == true ) && ( isset($_POST["nom_fournisseur"]) == true ) && ( isset($_POST["addresse_fournisseur"]) == true ) && ( isset($_POST["num_tel_fournisseur"]) == true ) )
                { 
                    $retour = true;
                    $arg = array("nom_fournisseur" => $_POST["nom_fournisseur"], "addresse_fournisseur" => $_POST["addresse_fournisseur"], "num_tel_fournisseur" => $_POST["num_tel_fournisseur"] ) ;
                    $retour = $this->model->ajouter_fournisseur($arg);
                    if($retour == true )
                    {
                        require APP . 'view/Fournisseur/done_ajouter.php';
                    }else
                    {
                        require APP . 'view/Fournisseur/echec_ajouter.php';
                    }
                }

                require APP . 'view/Fournisseur/ajouter_fournisseur.php';
                require APP . 'view/_templates/footer.php';
            }
        }else
            header('location: ' . URL);
    }

    public function supprimerFournisseur($id_fournisseur = '')
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_supprimerfournisseur, $_SESSION['id_user']) == true)
            {

                if((isset($_POST["valider_supprimer"]) == true) && (isset($_POST["id"]) == true))
                {
                    $retour = false;
                    $retour = $this->model->delete_fournisseur($_POST["id"]);
                    $fournisseurs = $this->model->get_all_fournisseurs();

                    if($retour == true)
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/fournisseur/done_supprimer.php';
                        require APP . 'view/fournisseur/supprimer_fournisseur.php';
                        require APP . 'view/_templates/footer.php';
                    }else
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/fournisseur/echec_supprimer.php';
                        require APP . 'view/fournisseur/supprimer_fournisseur.php';
                        require APP . 'view/_templates/footer.php';
                    }
                }else
                if($id_fournisseur != '') 
                {
                    $fournisseur_cible = NULL;
                    $fournisseur_cible = $this->model->get_fournisseur_by_id($id_fournisseur);
                    
                    if($fournisseur_cible != NULL)
                    {
                        $fournisseurs = $this->model->get_all_fournisseurs();

                        require APP . 'view/_templates/header.php';
                        require APP . 'view/fournisseur/supprimer_executer.php';
                        require APP . 'view/fournisseur/supprimer_fournisseur.php';
                        require APP . 'view/_templates/footer.php';  
                    }else
                        header('location: ' . URL . 'error');
                }else
                {
                    $fournisseurs = $this->model->get_all_fournisseurs();

                    require APP . 'view/_templates/header.php';
                    require APP . 'view/fournisseur/supprimer_fournisseur.php';
                    require APP . 'view/_templates/footer.php'; 
                }
            }else
                header('location: ' . URL . 'error');
        }else
            header('location: ' . URL);
    }

    public function modifierfournisseur($id_fournisseur='')
    {

        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_modifierfournisseur, $_SESSION['id_user']) == true)
            {
                if((isset($_POST["valider_modifier"]) == true) && ( isset($_POST["nom_fournisseur"]) == true ) && ( isset($_POST["addresse_fournisseur"]) == true ) && ( isset($_POST["num_tel_fournisseur"]) == true ) )
                {
                    $retour = true;
                    $arg = array("id_fournisseur" => $_POST["id"], "nom_fournisseur" => $_POST["nom_fournisseur"], "addresse_fournisseur" => $_POST["addresse_fournisseur"], "num_tel_fournisseur" => $_POST["num_tel_fournisseur"] ) ;
                    $retour = $this->model->update_fournisseur($arg);
                    $fournisseurs = $this->model->get_all_fournisseurs();
                    if($retour == true)
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/fournisseur/done_modifier.php';
                        require APP . 'view/fournisseur/modifier_fournisseur.php';
                        require APP . 'view/_templates/footer.php';
                    }else
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/fournisseur/echec_modifier.php';
                        require APP . 'view/fournisseur/modifier_fournisseur.php';
                        require APP . 'view/_templates/footer.php';
                    }
                }else
                if($id_fournisseur != '') 
                {
                    $fournisseur_cible = $this->model->get_fournisseur_by_id($id_fournisseur);
                    
                    if($fournisseur_cible != NULL)
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/fournisseur/modifier_executer.php';
                        require APP . 'view/_templates/footer.php';  
                    }else
                        header('location: ' . URL . 'error');
                }else
                {
                    $fournisseurs = $this->model->get_all_fournisseurs();

                    require APP . 'view/_templates/header.php';
                    require APP . 'view/fournisseur/modifier_fournisseur.php';
                    require APP . 'view/_templates/footer.php'; 
                }

            }else
                header('location: ' . URL . 'error');
        }else
            header('location: ' . URL);
    }
}
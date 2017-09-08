<?php

class Entrepot extends Controller
{
    function __construct()
    {
        Controller::__construct('model/model_entrepot.php','Model_entrepot');
    }

    public function index()
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_ajouterentrepot, $_SESSION['id_user']) == true)
            {
                require APP . 'view/_templates/header.php';

                if ( ( isset($_POST["valider_ajouter_entrepot"]) == true ) && ( isset($_POST["nom_entrepot"]) == true ) && ( isset($_POST["addresse_entrepot"]) == true ) )
                { 
                    $retour = true;
                    $arg = array("nom_entrepot" => $_POST["nom_entrepot"], "addresse_entrepot" => $_POST["addresse_entrepot"] ) ;
                    $retour = $this->model->ajouter_entrepot($arg);
                    if($retour == true )
                    {
                        require APP . 'view/entrepot/done_ajouter.php';
                    }else
                    {
                        require APP . 'view/entrepot/echec_ajouter.php';
                    }
                }
                require APP . 'view/entrepot/ajouter_entrepot.php';
                require APP . 'view/_templates/footer.php';
            }
        }else
            header('location: ' . URL);
    }

    public function supprimerentrepot($id_entrepot = '')
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_supprimerentrepot, $_SESSION['id_user']) == true)
            {

                if((isset($_POST["valider_supprimer"]) == true) && (isset($_POST["id"]) == true))
                {
                    $retour = false;
                    $retour = $this->model->delete_entrepot($_POST["id"]);
                    $entrepots = $this->model->get_all_entrepots();

                    if($retour == true)
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/entrepot/done_supprimer.php';
                        require APP . 'view/entrepot/supprimer_entrepot.php';
                        require APP . 'view/_templates/footer.php';
                    }else
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/entrepot/echec_supprimer.php';
                        require APP . 'view/entrepot/supprimer_entrepot.php';
                        require APP . 'view/_templates/footer.php';
                    }
                }else
                if($id_entrepot != '') 
                {
                    $entrepot_cible = $this->model->get_entrepot_by_id($id_entrepot);
                    
                    if($entrepot_cible != NULL)
                    {
                        $entrepots = $this->model->get_all_entrepots();

                        require APP . 'view/_templates/header.php';
                        require APP . 'view/entrepot/supprimer_executer.php';
                        require APP . 'view/entrepot/supprimer_entrepot.php';
                        require APP . 'view/_templates/footer.php';  
                    }else
                        header('location: ' . URL . 'error');
                }else
                {
                    $entrepots = $this->model->get_all_entrepots();

                    require APP . 'view/_templates/header.php';
                    require APP . 'view/entrepot/supprimer_entrepot.php';
                    require APP . 'view/_templates/footer.php'; 
                }
            }else
                header('location: ' . URL . 'error');
        }else
            header('location: ' . URL);
    }

    public function modifierentrepot($id_entrepot='')
    {

        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_modifierentrepot, $_SESSION['id_user']) == true)
            {
                if((isset($_POST["valider_modifier"]) == true) && ( isset($_POST["nom_entrepot"]) == true ) && ( isset($_POST["addresse_entrepot"]) == true ) )
                {
                    $retour = true;
                    $arg = array("id_entrepot" => $_POST["id"], "nom_entrepot" => $_POST["nom_entrepot"], "addresse_entrepot" => $_POST["addresse_entrepot"] ) ;
                    $retour = $this->model->update_entrepot($arg);
                    $entrepots = $this->model->get_all_entrepots();
                    if($retour == true)
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/entrepot/done_modifier.php';
                        require APP . 'view/entrepot/modifier_entrepot.php';
                        require APP . 'view/_templates/footer.php';
                    }else
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/entrepot/echec_modifier.php';
                        require APP . 'view/entrepot/modifier_entrepot.php';
                        require APP . 'view/_templates/footer.php';
                    }
                }else
                if($id_entrepot != '') 
                {
                    $entrepot_cible = $this->model->get_entrepot_by_id($id_entrepot);
                    
                    if($entrepot_cible != NULL)
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/entrepot/modifier_executer.php';
                        require APP . 'view/_templates/footer.php';  
                    }else
                        header('location: ' . URL . 'error');
                }else
                {
                    $entrepots = $this->model->get_all_entrepots();

                    require APP . 'view/_templates/header.php';
                    require APP . 'view/entrepot/modifier_entrepot.php';
                    require APP . 'view/_templates/footer.php'; 
                }

            }else
                header('location: ' . URL . 'error');
        }else
            header('location: ' . URL);
    }
}
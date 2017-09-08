<?php

class Commande extends Controller
{
    function __construct()
    {
        Controller::__construct('model/model_commande.php','Model_commande');
    }

    public function index()
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_ajoutercommande, $_SESSION['id_user']) == true)
            {

                require APP . 'view/_templates/header.php';

                $fournisseurs = $this->model->get_all_fournisseurs() ;
                $produits = $this->model->get_all_produits() ;
                $users = $this->model->get_all_users() ;

                if ( ( isset($_POST["valider_ajouter_commande"]) == true ) && ( isset($_POST["fournisseur_commande"]) == true ) && ( isset($_POST["produit_commande"]) == true ) && ( isset($_POST["quantite_commande"]) == true ) && ( isset($_POST["user_commande"]) == true ) )
                { 
                    $retour = $this->model->ajouter_commande($_POST);
                    if($retour == true )
                    {
                        require APP . 'view/commande/done_ajouter.php';
                    }else
                    {
                        require APP . 'view/commande/echec_ajouter.php';
                    }
                }

                require APP . 'view/commande/ajouter_commande.php';
                require APP . 'view/_templates/footer.php';
            }
        }else
            header('location: ' . URL);
    }

    public function supprimercommande($id_commande = '')
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_supprimercommande, $_SESSION['id_user']) == true)
            {

                require APP . 'view/_templates/header.php';

                if((isset($_POST["valider_supprimer"]) == true) && (isset($_POST["id"]) == true))
                {
                    $retour = $this->model->delete_commande($_POST["id"]);
                    $commandes = $this->model->get_all_commandes();

                    if($retour == true)
                    {
                        require APP . 'view/commande/done_supprimer.php';
    
                    }else
                    {
                        require APP . 'view/commande/echec_supprimer.php';
    
                    }

                    require APP . 'view/commande/supprimer_commande.php';
                }
                else if($id_commande != '') 
                {
                    $commande_cible = NULL;
                    $commande_cible = $this->model->get_commande_by_id($id_commande);
                    
                    if($commande_cible != NULL)
                    {
                        $commandes = $this->model->get_all_commandes();

                        require APP . 'view/commande/supprimer_executer.php';
                        require APP . 'view/commande/supprimer_commande.php';
      
                    }else
                        header('location: ' . URL . 'error');
                }else
                {
                    $commandes = $this->model->get_all_commandes();
                    require APP . 'view/commande/supprimer_commande.php';
 
                }
            }else
                header('location: ' . URL . 'error');
        }else
            header('location: ' . URL);

        require APP . 'view/_templates/footer.php';
    }

    public function modifiercommande($id_commande='')
    {

        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_modifiercommande, $_SESSION['id_user']) == true)
            {
                require APP . 'view/_templates/header.php';

                if((isset($_POST["valider_modifier"]) == true) && ( isset($_POST["fournisseur_commande"]) == true ) && ( isset($_POST["produit_commande"]) == true ) && ( isset($_POST["date_commande"]) == true ) && ( isset($_POST["quantite_commande"]) == true ) && ( isset($_POST["user_commande"]) == true ) && ( isset($_POST["etat_commande"]) == true ))
                {

                    $retour = $this->model->update_commande($_POST);
                    $commandes = $this->model->get_all_commandes();

                    if($retour == true)
                    {

                        require APP . 'view/commande/done_modifier.php';

                    }else
                    {

                        require APP . 'view/commande/echec_modifier.php';

                    }
                    require APP . 'view/commande/modifier_commande.php';
                }
                else if($id_commande != '') 
                {
                    $commande_cible = $this->model->get_commande_by_id($id_commande);
                    
                    if($commande_cible != NULL)
                    {

                        require APP . 'view/commande/modifier_executer.php';
  
                    }else
                        header('location: ' . URL . 'error');
                }else
                {
                    $commandes = $this->model->get_all_commandes();

                    require APP . 'view/commande/modifier_commande.php'; 
                }

            }else
                header('location: ' . URL . 'error');
        }else
            header('location: ' . URL);

        require APP . 'view/_templates/footer.php';
    }
}
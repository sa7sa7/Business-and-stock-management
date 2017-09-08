<?php

class Produit extends Controller
{
    function __construct()
    {
        Controller::__construct('model/model_produit.php','Model_produit');
    }

    public function index()
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_ajouterproduit, $_SESSION['id_user']) == true)
            {

                $categories = $this->model->get_all_categories() ;
                require APP . 'view/_templates/header.php';

                if ( ( isset($_POST["valider_ajouter_produit"]) == true ) && ( isset($_POST["nom_produit"]) == true ) && ( isset($_POST["code_produit"]) == true ) && ( isset($_POST["categorie_produit"]) == true ) && ( isset($_POST["prix_achat_produit"]) == true ) && ( isset($_POST["stock_minimal_produit"]) == true ) )
                { 
                    $retour = true;
                    $arg = array('nom_produit' => $_POST['nom_produit'], 'code_produit' => $_POST['code_produit'], 'categorie_produit' => $_POST['categorie_produit'] , 'prix_achat_produit' => $_POST['prix_achat_produit'], 'stock_minimal_produit' => $_POST['stock_minimal_produit']) ;
                    $retour = $this->model->ajouter_produit($arg);
                    if($retour == true )
                    {
                        require APP . 'view/produit/done_ajouter.php';
                    }else
                    {
                        require APP . 'view/produit/echec_ajouter.php';
                    }
                }

                require APP . 'view/produit/ajouter_produit.php';
                require APP . 'view/_templates/footer.php';
            }
        }else
            header('location: ' . URL);
    }

    public function supprimerproduit($id_produit = '')
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_supprimerproduit, $_SESSION['id_user']) == true)
            {

                if((isset($_POST["valider_supprimer"]) == true) && (isset($_POST["id"]) == true))
                {
                    $retour = false;
                    $retour = $this->model->delete_produit($_POST["id"]);
                    $produits = $this->model->get_all_produits();

                    if($retour == true)
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/produit/done_supprimer.php';
                        require APP . 'view/produit/supprimer_produit.php';
                        require APP . 'view/_templates/footer.php';
                    }else
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/produit/echec_supprimer.php';
                        require APP . 'view/produit/supprimer_produit.php';
                        require APP . 'view/_templates/footer.php';
                    }
                }else
                if($id_produit != '') 
                {
                    $produit_cible = NULL;
                    $produit_cible = $this->model->get_produit_by_id($id_produit);
                    
                    if($produit_cible != NULL)
                    {
                        $produits = $this->model->get_all_produits();

                        require APP . 'view/_templates/header.php';
                        require APP . 'view/produit/supprimer_executer.php';
                        require APP . 'view/produit/supprimer_produit.php';
                        require APP . 'view/_templates/footer.php';  
                    }else
                        header('location: ' . URL . 'error');
                }else
                {
                    $produits = $this->model->get_all_produits();

                    require APP . 'view/_templates/header.php';
                    require APP . 'view/produit/supprimer_produit.php';
                    require APP . 'view/_templates/footer.php'; 
                }
            }else
                header('location: ' . URL . 'error');
        }else
            header('location: ' . URL);
    }

    public function modifierproduit($id_produit='')
    {

        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_modifierproduit, $_SESSION['id_user']) == true)
            {
                if((isset($_POST["valider_modifier"]) == true) && ( isset($_POST["nom_produit"]) == true ) && ( isset($_POST["code_produit"]) == true ) && ( isset($_POST["nom_categorie"]) == true ) && ( isset($_POST["prix_achat_produit"]) == true ) && ( isset($_POST["stock_minimal_produit"]) == true ) && ( isset($_POST["id"]) == true ) )
                {
                    $retour = false;
                    $arg = array('nom_produit' => $_POST['nom_produit'], 'code_produit' => $_POST['code_produit'], 'nom_categorie' => $_POST['nom_categorie'], 'prix_achat_produit' => $_POST['prix_achat_produit'], 'stock_minimal_produit' => $_POST['stock_minimal_produit'], 'id_produit' => $_POST['id']) ;
                    $retour = $this->model->update_produit($arg);
                    $produits = $this->model->get_all_produits();
                    if($retour == true)
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/produit/done_modifier.php';
                        require APP . 'view/produit/modifier_produit.php';
                        require APP . 'view/_templates/footer.php';
                    }else
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/produit/echec_modifier.php';
                        require APP . 'view/produit/modifier_produit.php';
                        require APP . 'view/_templates/footer.php';
                    }
                }else
                if($id_produit != '') 
                {
                    $produit_cible = $this->model->get_produit_by_id($id_produit);
                    
                    if($produit_cible != NULL)
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/produit/modifier_executer.php';
                        require APP . 'view/_templates/footer.php';  
                    }else
                        header('location: ' . URL . 'error');
                }else
                {
                    $produits = $this->model->get_all_produits();

                    require APP . 'view/_templates/header.php';
                    require APP . 'view/produit/modifier_produit.php';
                    require APP . 'view/_templates/footer.php'; 
                }

            }else
                header('location: ' . URL . 'error');
        }else
            header('location: ' . URL);
    }
}
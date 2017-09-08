<?php

class Stock extends Controller
{
    function __construct()
    {
        Controller::__construct('model/model_stock.php','Model_stock');
    }

    public function index()
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_listerproduits, $_SESSION['id_user']) == true)
            {
                $produits = $this->model->get_all_produits() ; 

                require APP . 'view/_templates/header.php';
                require APP . 'view/stock/list_produits.php';
                require APP . 'view/_templates/footer.php';
            }
        }else
            header('location: ' . URL);
    }

    public function approvisionnerproduit($id_produit='')
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            //if($this->model->verifier_droit_acces(id_approvisionnerproduit, $_SESSION['id_user']) == true)
            //{
                if($id_produit=='')
                {
                    if(isset($_POST['id_produit']) == true)
                    {
                        $id_produit = $_POST['id_produit'] ; 
                    }
                }
                $produit_cible = $this->model->get_produit_by_id($id_produit) ; 
                $entrepots = $this->model->get_all_entrepots() ; 

                require APP . 'view/_templates/header.php';

                if ( ( isset($_POST["valider_approvisionner_produit"]) == true )  )
                { 
                    for($compteur = 0 ; $compteur<count($_POST['entrepot_choisi']) ; $compteur++)
                    {
                        $arg = array('id_produit' => $_POST['id_produit'],'entrepot_choisi' => $_POST['entrepot_choisi'][$compteur] ,'quantite_entrepot' => $_POST['quantite_entrepot'][$compteur],'user' => $_SESSION['id_user'] );
                        $retour = $this->model->set_approvisionnement_produit($arg) ;
                    }
                    if($retour == true )
                    {
                        require APP . 'view/stock/done_approvisionner.php';
                    }else
                    {
                        require APP . 'view/stock/echec_approvisionner.php';
                    }
                }

                require APP . 'view/stock/produit_approvisionnement.php';
                require APP . 'view/_templates/footer.php';
            //}
        }else
            header('location: ' . URL);
    }

    public function sortirproduit($id_produit='')
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            //if($this->model->verifier_droit_acces(id_approvisionnerproduit, $_SESSION['id_user']) == true)
            //{
                if($id_produit=='')
                {
                    if(isset($_POST['id_produit']) == true)
                    {
                        $id_produit = $_POST['id_produit'] ; 
                    }
                }
                $produit_cible = $this->model->get_produit_by_id($id_produit) ; 
                $entrepots = $this->model->get_emplacement($id_produit) ;

                require APP . 'view/_templates/header.php';

                if ( ( isset($_POST["valider_sortir_produit"]) == true )  )
                { 
                    for($compteur = 0 ; $compteur<count($_POST['entrepot_choisi']) ; $compteur++)
                    {
                        $arg = array('id_produit' => $_POST['id_produit'],'entrepot_choisi' => $_POST['entrepot_choisi'][$compteur] ,'quantite_entrepot' => $_POST['quantite_entrepot'][$compteur],'user' => $_SESSION['id_user'],'type_sortie' => $_POST['type_sortie'][$compteur]);
                        $retour = $this->model->set_sortie_produit($arg) ;
                    }
                    if($retour == true )
                    {
                        require APP . 'view/stock/done_sortir.php';
                    }else
                    {
                        require APP . 'view/stock/echec_sortir.php';
                    }
                }
                require APP . 'view/stock/produit_sortir.php';
                require APP . 'view/_templates/footer.php';
            //}
        }else
            header('location: ' . URL);
    }

    public function repartitionproduit($id_produit='')
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            //if($this->model->verifier_droit_acces(id_approvisionnerproduit, $_SESSION['id_user']) == true)
            //{
                $produit_cible = $this->model->get_produit_by_id($id_produit) ; 
                $entrepots = $this->model->get_emplacement($id_produit) ;

                require APP . 'view/_templates/header.php';
                require APP . 'view/stock/produit_repartition.php';
                require APP . 'view/_templates/footer.php';
            //}
        }else
            header('location: ' . URL);
    }

    public function consulterhistorique()
    {
        session_start() ; 
        if(isset($_SESSION['id_user']) == true)
        {
            if($this->model->verifier_droit_acces(id_consulterstock, $_SESSION['id_user']) == true)
            {
                $historique = array() ; 
                $produits = $this->model->get_all_produits() ; 
                $entrepots = $this->model->get_all_entrepots() ; 
                $users = $this->model->get_all_users() ;

                $options = array('produit_stock' => '0', 'entrepot_stock' => '0', 'date_stock_1' => '0', 'date_stock_2' => '0', 'user_stock' => '0' , 'type_mouvement_stock' => '0' ) ;

                if ( ( isset($_POST["valider_consulter_historique"] ) == true )  )
                { 
                    if($_POST['produit_stock']!='0' || $_POST['entrepot_stock']!='0' || $_POST['date_stock_1']!='0' || $_POST['date_stock_2']!='0' || $_POST['user_stock']!='0' || $_POST['type_mouvement_stock']!='0')
                    {
                        $options = $_POST ;
                        $historique = $this->model->get_all_historique($_POST) ; 
                    }
                    else
                        $historique = $this->model->get_all_historique() ;
                }
                else
                    $historique = $this->model->get_all_historique() ;

                require APP . 'view/_templates/header.php';
                require APP . 'view/stock/affiche_historique.php';
                require APP . 'view/_templates/footer.php';
            }
        }else
            header('location: ' . URL);
    }
}
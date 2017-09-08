<?php

class Model_commande extends Model
{    
    function __construct($db)
    {
        Model::__construct($db);
    }

    public function ajouter_commande($arg)
    {
        $sys_date = date("Y-m-d H:i:s") ;

        $sql = "INSERT INTO commande (fournisseur_commande,produit_commande,date_commande,quantite_commande,user_commande,etat_commande) VALUES (:fournisseur_commande,:produit_commande,:date_commande,:quantite_commande,:user_commande,:etat_commande)" ;
        $query = $this->db->prepare($sql) ;
        $parameters = array(':fournisseur_commande' => $arg['fournisseur_commande'], ':produit_commande' => $arg['produit_commande'], ':date_commande' => $sys_date , ':quantite_commande' => $arg['quantite_commande'], ':user_commande' => $arg['user_commande'], ':etat_commande' => 'non_achevé') ;
        try
        {
            $query->execute($parameters);
        } 
        catch (PDOException $e) 
        {
            echo "$e";
            return false;
        }
        return true;
    }


    public function get_all_commandes()
    {

        $sql = "SELECT id_commande,nom_fournisseur,nom_produit,date_commande,quantite_commande,user.nom,etat_commande FROM commande INNER JOIN fournisseur ON (commande.fournisseur_commande=fournisseur.id_fournisseur) INNER JOIN produit ON (commande.produit_commande=produit.id_produit) INNER JOIN user ON (commande.user_commande=user.id_user)";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function get_all_produits()
    {

        $sql = "SELECT nom_produit, id_produit FROM produit" ;
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function get_all_fournisseurs()
    {

        $sql = "SELECT nom_fournisseur, id_fournisseur FROM fournisseur" ;
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function get_all_users()
    {

        $sql = "SELECT nom, id_user FROM user" ;
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function get_commande_by_id($id_commande)
    {

        $sql = "SELECT id_commande,nom_fournisseur,nom_produit,date_commande,quantite_commande,user.nom,etat_commande FROM commande INNER JOIN fournisseur ON (commande.fournisseur_commande=fournisseur.id_fournisseur) INNER JOIN produit ON (commande.produit_commande=produit.id_produit) INNER JOIN user ON (commande.user_commande=user.id_user) WHERE id_commande = :id_commande LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_commande' => $id_commande);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function delete_commande($id_commande)
    {
        $sql = "DELETE FROM commande WHERE id_commande=:id_commande" ; 
        $query = $this->db->prepare($sql) ; 
        $parameters = array(':id_commande' => $id_commande) ; 
        try {
            $query->execute($parameters) ;
        } catch (PDOException $e) {
            return false ; 
        }
        return true ; 
    }


    public function update_commande($arg)
    {
        $sql = "UPDATE commande SET fournisseur_commande = :fournisseur_commande, produit_commande = :produit_commande ,date_commande = :date_commande, quantite_commande = :quantite_commande, user_commande = :user_commande, etat_commande = :etat_commande WHERE id_commande = :id_commande";

        $query = $this->db->prepare($sql);
        $parameters = array(':nom_commande' => $arg['nom_commande'], ':code_commande' => $arg['code_commande'], ':categorie_commande' => $id_categorie->id_categorie, ':prix_achat_commande' => $arg['prix_achat_commande'], ':stock_minimal_commande' => $arg['stock_minimal_commande'], ':id_commande' => $arg['id_commande']) ;
        try
        {
            $query->execute($parameters);
        } 
        catch (PDOException $e) 
        {
            echo "$e";
            return false;
        }

        return true;
    }


}



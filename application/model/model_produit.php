<?php

class Model_produit extends Model
{    
    function __construct($db)
    {
        Model::__construct($db);
    }

    public function ajouter_produit($arg)
    {

        $sql = "INSERT INTO produit (nom_produit,code_produit,categorie_produit,prix_achat_produit,stock_minimal_produit,quantite_total_produit) VALUES (:nom_produit,:code_produit,:categorie_produit,:prix_achat_produit,:stock_minimal_produit,0)" ;
        $query = $this->db->prepare($sql) ;
        $parameters = array(':nom_produit' => $arg['nom_produit'], ':code_produit' => $arg['code_produit'], ':categorie_produit' => $arg['categorie_produit'] , ':prix_achat_produit' => $arg['prix_achat_produit'], ':stock_minimal_produit' => $arg['stock_minimal_produit']) ;
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

    public function get_all_categories()
    {

        $sql = "SELECT * FROM categorie";
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function get_all_produits()
    {

        $sql = "SELECT id_produit,nom_produit,code_produit,nom_categorie,prix_achat_produit,stock_minimal_produit,quantite_total_produit FROM produit INNER JOIN categorie ON (produit.categorie_produit=categorie.id_categorie)";
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }


    public function get_produit_by_id($id_produit)
    {

        $sql = "SELECT id_produit,nom_produit,code_produit,nom_categorie,prix_achat_produit,stock_minimal_produit,quantite_total_produit FROM produit INNER JOIN categorie ON (produit.categorie_produit=categorie.id_categorie) WHERE id_produit = :id_produit LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_produit' => $id_produit);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function delete_produit($id_produit)
    {
        $sql = "DELETE FROM produit WHERE id_produit=:id_produit" ; 
        $query = $this->db->prepare($sql) ; 
        $parameters = array(':id_produit' => $id_produit) ; 
        try {
            $query->execute($parameters) ;
        } catch (PDOException $e) {
            return false ; 
        }
        return true ; 
    }


    public function update_produit($arg)
    {

        $sql_categorie = "SELECT id_categorie FROM categorie WHERE nom_categorie = :nom_categorie" ;
        $query_categorie= $this->db->prepare($sql_categorie) ;
        $parameters_categorie= array(':nom_categorie'=> $arg['nom_categorie']) ;
        try
        {
            $query_categorie->execute($parameters_categorie) ;
            $id_categorie  = $query_categorie->fetch() ;
        } 
        catch (PDOException $e) 
        {
            return false;
        }

        $sql = "UPDATE produit SET nom_produit = :nom_produit, code_produit = :code_produit ,categorie_produit = :categorie_produit, prix_achat_produit = :prix_achat_produit, stock_minimal_produit = :stock_minimal_produit WHERE id_produit = :id_produit";
        $query = $this->db->prepare($sql);
        $parameters = array(':nom_produit' => $arg['nom_produit'], ':code_produit' => $arg['code_produit'], ':categorie_produit' => $id_categorie->id_categorie, ':prix_achat_produit' => $arg['prix_achat_produit'], ':stock_minimal_produit' => $arg['stock_minimal_produit'], ':id_produit' => $arg['id_produit']) ;
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



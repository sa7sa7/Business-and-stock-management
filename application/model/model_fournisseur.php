<?php

class Model_fournisseur extends Model
{    
    function __construct($db)
    {
        Model::__construct($db);
    }

    public function ajouter_fournisseur($arg)
    {
        $sql = "INSERT INTO fournisseur (nom_fournisseur,addresse_fournisseur,num_tel_fournisseur) VALUES (:nom_fournisseur, :addresse_fournisseur, :num_tel_fournisseur)" ;
        $query = $this->db->prepare($sql) ;
        $parameters = array(':nom_fournisseur' => $arg['nom_fournisseur'], ':addresse_fournisseur' => $arg['addresse_fournisseur'], ':num_tel_fournisseur' => $arg['num_tel_fournisseur']) ;
        try
        {
            $query->execute($parameters);
        } 
        catch (PDOException $e) 
        {
            return false;
        }

        return true;
    }


    public function get_all_fournisseurs()
    {

        $sql = "SELECT * FROM fournisseur";
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }


    public function get_fournisseur_by_id($id_fournisseur)
    {

        $sql = "SELECT * FROM fournisseur WHERE id_fournisseur = :id_fournisseur LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_fournisseur' => $id_fournisseur);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function delete_fournisseur($id_fournisseur)
    {
        $sql = "DELETE FROM fournisseur WHERE id_fournisseur=:id_fournisseur" ; 
        $query = $this->db->prepare($sql) ; 
        $parameters = array(':id_fournisseur' => $id_fournisseur) ; 
        try {
            $query->execute($parameters) ;
        } catch (PDOException $e) {
            return false ; 
        }
        return true ; 
    }


    public function update_fournisseur($arg)
    {
        $sql = "UPDATE fournisseur SET nom_fournisseur = :nom_fournisseur, addresse_fournisseur = :addresse_fournisseur, num_tel_fournisseur = :num_tel_fournisseur WHERE id_fournisseur = :id_fournisseur";
        $query = $this->db->prepare($sql);
        $parameters = array('id_fournisseur' => $arg['id_fournisseur'], 'nom_fournisseur' => $arg['nom_fournisseur'], 'addresse_fournisseur' => $arg['addresse_fournisseur'], 'num_tel_fournisseur' => $arg['num_tel_fournisseur'] );
        try
        {
            $query->execute($parameters);
        } 
        catch (PDOException $e) 
        {
            return false;
        }

        return true;
    }
}



<?php

class Model_entrepot extends Model
{    
    function __construct($db)
    {
        Model::__construct($db);
    }

    public function ajouter_entrepot($arg)
    {
        $sql = "INSERT INTO entrepot (nom_entrepot,addresse_entrepot) VALUES (:nom_entrepot, :addresse_entrepot)" ;
        $query = $this->db->prepare($sql) ;
        $parameters = array(':nom_entrepot' => $arg['nom_entrepot'], ':addresse_entrepot' => $arg['addresse_entrepot'] ) ;
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


    public function get_all_entrepots()
    {

        $sql = "SELECT * FROM entrepot";
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }


    public function get_entrepot_by_id($id_entrepot)
    {

        $sql = "SELECT * FROM entrepot WHERE id_entrepot = :id_entrepot LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_entrepot' => $id_entrepot);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function delete_entrepot($id_entrepot)
    {
        $sql = "DELETE FROM entrepot WHERE id_entrepot=:id_entrepot" ; 
        $query = $this->db->prepare($sql) ; 
        $parameters = array(':id_entrepot' => $id_entrepot) ; 
        try {
            $query->execute($parameters) ;
        } catch (PDOException $e) {
            return false ; 
        }
        return true ; 
    }


    public function update_entrepot($arg)
    {
        $sql = "UPDATE entrepot SET nom_entrepot = :nom_entrepot, addresse_entrepot = :addresse_entrepot WHERE id_entrepot = :id_entrepot";
        $query = $this->db->prepare($sql);
        $parameters = array('id_entrepot' => $arg['id_entrepot'], 'nom_entrepot' => $arg['nom_entrepot'], 'addresse_entrepot' => $arg['addresse_entrepot'] );
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



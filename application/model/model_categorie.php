<?php

class Model_categorie extends Model
{    
    function __construct($db)
    {
        Model::__construct($db);
    }

    public function ajouter_categorie($arg)
    {
        $sql = "INSERT INTO categorie (nom_categorie,description_categorie,image_categorie) VALUES (:nom_categorie, :description_categorie, :image_categorie)" ;
        $query = $this->db->prepare($sql) ;
        $parameters = array(':nom_categorie' => $arg['nom_categorie'], ':description_categorie' => $arg['description_categorie'], ':image_categorie' => $arg['image_categorie']) ;
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


    public function get_all_categories()
    {

        $sql = "SELECT * FROM categorie";
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }


    public function get_categorie_by_id($id_categorie)
    {

        $sql = "SELECT * FROM categorie WHERE id_categorie = :id_categorie LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_categorie' => $id_categorie);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function delete_categorie($id_categorie)
    {
        $sql = "DELETE FROM categorie WHERE id_categorie=:id_categorie" ; 
        $query = $this->db->prepare($sql) ; 
        $parameters = array(':id_categorie' => $id_categorie) ; 
        try {
            $query->execute($parameters) ;
        } catch (PDOException $e) {
            return false ; 
        }
        return true ; 
    }


    public function update_categorie($arg)
    {
        $sql = "UPDATE categorie SET nom_categorie = :nom_categorie, description_categorie = :description_categorie, image_categorie = :image_categorie WHERE id_categorie = :id_categorie";
        $query = $this->db->prepare($sql);
        $parameters = array('id_categorie' => $arg['id_categorie'], 'nom_categorie' => $arg['nom_categorie'], 'description_categorie' => $arg['description_categorie'], 'image_categorie' => $arg['image_categorie'] );
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



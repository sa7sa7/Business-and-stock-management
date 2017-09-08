<?php

class Model_menu extends Model
{    
    function __construct($db)
    {
        Model::__construct($db);
    }

    public function get_all_menu()
    {

        $sql = "SELECT * FROM `menu` WHERE  id_menu_parent = 0";
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function add_menu($nom, $lien, $parent)
    {
        if($parent == 'Pas de Parent')
        {
            $id_menu_parent = 0;
            $lien = NULL;
        }
        else
            $id_menu_parent = $this->get_menu_nom($parent)->id_menu;

        $sql = "INSERT INTO menu (nom, id_menu_parent, lien) VALUES (:nom, :id_menu_parent, :lien)";
        $query = $this->db->prepare($sql);
                                
        $parameters = array('nom' => $nom, 'id_menu_parent' => $id_menu_parent, 'lien' => $lien);
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

    //cette fontion permet de liste le contenu de la table menu
    public function get_all()
    {

        $sql = "SELECT * FROM `menu`";
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function get_menu_nom($nom)
    {
        $sql = "SELECT * FROM menu WHERE nom = :nom LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':nom' => $nom);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function get_menu_id($id_menu)
    {
        $sql = "SELECT * FROM menu WHERE id_menu = :id_menu LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_menu' => $id_menu);

        try
        {
            $query->execute($parameters);
        } 
        catch (PDOException $e) 
        {
            return NULL;
        }

        return $query->fetch();
    }

    public function delete_menu($id_menu)
    {
        $sql = "DELETE FROM menu WHERE id_menu = :id_menu";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_menu' => $id_menu);

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

    //cette fonction permet de mettre à jour un profil dans la table profil
    public function update_menu($id_menu, $nom, $id_menu_parent, $lien)
    {
        $sql = "UPDATE menu SET id_menu_parent = :id_menu_parent, nom = :nom, lien = :lien WHERE id_menu = :id_menu";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_menu' => $id_menu, ':nom' => $nom, ':lien' => $lien, ':id_menu_parent' => $id_menu_parent);

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

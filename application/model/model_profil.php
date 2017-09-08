<?php

class Model_profil extends Model
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

    public function get_all_sous_menu($id_menu = '')
    {
        if( $id_menu != '')
        {
            $sql = "SELECT *  FROM menu WHERE  id_menu_parent = :id_menu";
            $query = $this->db->prepare($sql);
            $parameters = array(':id_menu' => $id_menu);

            $query->execute($parameters);
        }else
        {
            $sql = "SELECT * FROM `menu` WHERE  id_menu_parent <> 0";
            $query = $this->db->prepare($sql);

            $query->execute();
        }
        return $query->fetchAll();
    }
    
    public function add_profil($nom)
    {
            $sql = "INSERT INTO profil (nom) VALUES (:nom)";
            $query = $this->db->prepare($sql);
                                
            $parameters = array('nom' => $nom);
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

    public function get_profil_nom($nom)
    {
        $sql = "SELECT * FROM profil WHERE nom = :nom LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':nom' => $nom);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function get_profil_id($id_profil)
    {
        $sql = "SELECT * FROM profil WHERE id_profil = :id_profil LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_profil' => $id_profil);

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

    public function add_permission($id_menu, $id_profil)
    {
        
        $sql = "INSERT INTO `permission menu profil` (id_menu, id_profil) VALUES (:id_menu, :id_profil)";
        $query = $this->db->prepare($sql);
                                
        $parameters = array('id_menu' => $id_menu, 'id_profil' => $id_profil);

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

    public function delete_profil($id_profil)
    {
        $sql = "DELETE FROM profil WHERE id_profil = :id_profil";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_profil' => $id_profil);

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

    //cette fontion retourne tous le contenue de la table profil
    public function get_all_profil()
    {
        $sql = "SELECT * FROM profil";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    //cette fonction permet de mettre à jour un profil dans la table profil
    public function update_profil($id_profil, $nom)
    {
        $sql = "UPDATE profil SET nom = :nom WHERE id_profil = :id_profil";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_profil' => $id_profil, ':nom' => $nom);

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

    //cette fonction supprime une permission ou plusieurs
    public function delete_permission($id_menu, $id_profil)
    {

        $sql = "DELETE FROM `permission menu profil` WHERE id_menu = :id_menu AND id_profil = :id_profil";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_menu' => $id_menu, ':id_profil' => $id_profil);
        
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

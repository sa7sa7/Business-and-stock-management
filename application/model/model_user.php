<?php

class Model_user extends Model
{    
    function __construct($db)
    {
        Model::__construct($db);
    }

    public function get_all_user()
    {

        $sql = "SELECT * FROM `user`";
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function add_user($profil, $login, $password, $nom, $prenom, $image = NULL)
    {
        $id_profil = $this->get_profil_nom($profil)->id_profil;

        $sql = "INSERT INTO user (id_profil, login, password, nom, prenom, image) VALUES (:id_profil, :login, :password, :nom, :prenom, :image)";
        $query = $this->db->prepare($sql);
                                
        $parameters = array('id_profil' => $id_profil, 'login' => $login, 'password' => $password, 'nom' => $nom, 'prenom' => $prenom,'image' => $image);
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

        $query->execute($parameters);

        return $query->fetch();
    }

    //cette fontion retourne tous le contenue de la table profil
    public function get_all_profil()
    {
        $sql = "SELECT * FROM profil";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function delete_user($id_user)
    {
        $sql = "DELETE FROM user WHERE id_user = :id_user";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_user' => $id_user);

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
    public function update_user($id_user, $profil, $login, $nom, $prenom)
    {
        $id_profil = $this->get_profil_nom($profil)->id_profil;

        $sql = "UPDATE user SET id_profil = :id_profil, login = :login, nom = :nom, prenom = :prenom WHERE id_user = :id_user";
        $query = $this->db->prepare($sql);
        $parameters = array('id_user' => $id_user, 'id_profil' => $id_profil, 'login' => $login, 'nom' => $nom, 'prenom' => $prenom);

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

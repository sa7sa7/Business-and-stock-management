<?php

class Model
{
    protected $db = NULL; 
    
    function __construct($db)
    {
        try 
        {
            $this->db = $db;
            $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch (PDOException $e) 
        {
            exit('Database connection could not be established.');
        }
    }

    //cette fontion return true si l'utilisateur a le droit d'acceder à une methode
    public function verifier_droit_acces($id_menu, $id_user, $id_profil = '')
    {
        if( $id_profil == '')
            $id = $this->get_user_id($id_user);
        else
            $id = $id_profil;

        if ($id != NULL )
        {
            if( $id_profil == '')
                $id_profil = $id->id_profil;
            $sql = "SELECT COUNT(*) as amount_of_access FROM `permission menu profil` WHERE id_menu = :id_menu AND id_profil = :id_profil";
            $query = $this->db->prepare($sql);
            $parameters = array(':id_menu' => $id_menu, ':id_profil' => $id_profil);

            $query->execute($parameters);
            
            if($query->fetch()->amount_of_access == 1)
                return true;
            return false;
        }

        return 1;
    }

    //cette fontion retourne un utilisateur de la table user a partie de son id
    public function get_user_id($id_user)
    {
        $sql = "SELECT * FROM `user` WHERE id_user = :id_user LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_user' => $id_user);

        $query->execute($parameters);

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

    //cette fontion retourne un utilisateur de la table user a partie de son login
    public function get_user_login($login)
    {
        $sql = "SELECT * FROM `user` WHERE login = :login LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':login' => $login);

        $query->execute($parameters);

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

    //cette fontion retourne les menu principale pour un utilisateur identifié par id
    public function get_all_menu_user($id_user)
    {
        $id_profil = $this->get_user_id($id_user)->id_profil;
        if($id_profil == NULL)
            return 1;
            
        $sql = "SELECT * FROM `menu` m, `permission menu profil` p 
                WHERE p.id_profil = :id_profil AND m.id_menu = p.id_menu AND m.id_menu_parent = 0";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_profil' => $id_profil);

        $query->execute($parameters);

        return $query->fetchAll();
    }

    //cette fontion retourne un profil de la table profil a partie de son id
    public function get_all_sous_menu_user($id_user, $id_menu)
    {
        $id_profil = $this->get_user_id($id_user)->id_profil;

        $sql = "SELECT * FROM menu m, `permission menu profil` p 
                WHERE id_profil = :id_profil AND m.id_menu = p.id_menu AND id_menu_parent = :id_menu";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_profil' => $id_profil, ':id_menu' => $id_menu);

        $query->execute($parameters);

        return $query->fetchAll();
    }
}

<?php

class Model_home extends Model
{    
    function __construct($db)
    {
        Model::__construct($db);
    }

    public function verifier_login_password($login, $pwd)
    {
        $sql = "SELECT COUNT(id_user) as amount_of_users FROM user WHERE login = :login AND password = :password";
        $query = $this->db->prepare($sql);
        $parameters = array(':login' => $login, ':password' => $pwd);

        $query->execute($parameters);

        if($query->fetch()->amount_of_users == 1)
            return true;
        return false;
    }
    
    public function alerte_stock_minimal()
    {
        $sql = "SELECT * FROM produit WHERE stock_minimal_produit > quantite_total_produit";
        $query = $this->db->prepare($sql);

        $query->execute();
        
        return $query->fetchall();
    }

}

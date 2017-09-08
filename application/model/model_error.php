<?php

class Model_error extends Model
{    
    function __construct($db)
    {
        Model::__construct($db);
    }

    public function is_log_in($id_user)
    {
        $id_profil = $this->get_user_id($id_user)->id_profil;
        if($id_profil == NULL)
            return false;
        return true;
    }
}

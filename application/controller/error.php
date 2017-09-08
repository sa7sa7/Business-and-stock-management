<?php

class Error extends Controller
{
    function __construct()
    {
        Controller::__construct('model/model_error.php','Model_error');
    }
    
    public function index()
    {
    	session_start();
        if( (isset($_SESSION['id_user']) == true) && ($this->model->is_log_in($_SESSION['id_user']) == true))
        {          
            require APP . 'view/error/index.php';
        }else
            header('location: ' . URL);
    }
}

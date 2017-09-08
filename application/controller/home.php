<?php

class Home extends Controller
{
    function __construct()
    {
        Controller::__construct('model/model_home.php','Model_home');
    }

    public function index()
    {
        $wrong_login = false;
        $wrong_password = false;
        $login = '';

        session_start();
        if(isset($_SESSION['id_user']) == true)
        {         
            $produits = $this->model->alerte_stock_minimal();
            
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/home.php';
            require APP . 'view/_templates/footer.php';
        }else
        if((isset($_POST['connecter']) == true) && (isset($_POST['login']) == true) && (isset($_POST['pwd']) == true))
        {
            $login = $_POST['login'];
            $password = $_POST['pwd'];

            if($this->model->verifier_login_password($login, $password) == true)
            {
                $user = $this->model->get_user_login($_POST['login']);
                $_SESSION['id_user'] = $user->id_user;

                $produits = $this->model->alerte_stock_minimal();

                require APP . 'view/_templates/header.php';
                require APP . 'view/home/home.php';
                require APP . 'view/_templates/footer.php';
            }else
            {
                if($this->model->get_user_login($login) == NULL)
                    $wrong_login = true;
                else
                    $wrong_password = true;
                require APP . 'view/home/connection.php';
            }
        }else
            require APP . 'view/home/connection.php';
    }

    public function parametre($value = '')
    {
        session_start();
        if(isset($_SESSION['id_user']) == true)
        {         
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/parametre.php';
            require APP . 'view/_templates/footer.php';
        }else
            header('location: ' . URL);

    }
    public function deconnection()
    {
        session_start();
        if(isset($_SESSION['id_user']) == true)
        {          
            session_unset ();
            session_destroy ();
        }
            
        header('location: ' . URL);
    }

}

<?php

class User extends Controller
{
    function __construct()
    {
        Controller::__construct('model/model_user.php','Model_user');
    }

    public function index()
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_ajouteruser, $_SESSION['id_user']) == true)
            {
                $profil_user = '';
                $login = '';
                $nom = '';
                $prenom = '';
                $profils = $this->model->get_all_profil();

                if (( isset($_POST["valider_ajouter"]) == true ) && ( isset($_POST["profil"]) == true ) && ( isset($_POST["login"]) == true ) && ( isset($_POST["password1"]) == true ) && ( isset($_POST["nom"]) == true ) && ( isset($_POST["prenom"]) == true ))
                { 
                    $retour = false;
                    $boolean = false;
                    $profil_user = $_POST["profil"];
                    $login = $_POST["login"];
                    $password = $_POST["password1"];
                    $nom = $_POST["nom"];
                    $prenom = $_POST["prenom"];

                    $file_exts = array("jpg", "bmp", "jpeg", "gif", "png");
                    $tmp = explode(".", $_FILES["file"]["name"]);
                    $upload_exts = end($tmp);

                    if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/pjpeg")) && in_array($upload_exts, $file_exts) && ($_FILES["file"]["error"] == 0) &&  (!file_exists(path_image . $_FILES["file"]["name"])))
                            $boolean = true;
                    
                    if ($boolean == true)
                        $retour = $this->model->add_user($profil_user, $login, $password, $nom, $prenom, $_FILES["file"]["name"]);
                    else
                        $retour = $this->model->add_user($profil_user, $login, $password, $nom, $prenom);
                    
                    if($retour == true )
                    {

                        if ($boolean == true)
                        {
                            $dossier = $this->model->get_user_login($login)->id_user;
                            $dossier = path_image . $dossier;
                            if(is_dir($dossier) == false)
                            {
                               mkdir($dossier);
                            }
                            move_uploaded_file($_FILES["file"]["tmp_name"], $dossier . '\\' . $_FILES["file"]["name"]);
                        }

                        $profil_user = '';
                        $login = '';
                        $nom = '';
                        $prenom = '';

                        require APP . 'view/_templates/header.php';
                        require APP . 'view/user/done_ajouter.php';
                        require APP . 'view/user/ajouter_user.php';
                        require APP . 'view/_templates/footer.php';
                    }else
                    {
                        echo 'here<br>';
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/user/echec_ajouter.php';
                        require APP . 'view/user/ajouter_user.php';
                        require APP . 'view/_templates/footer.php';
                    }
                }else
                {
                    require APP . 'view/_templates/header.php';
                    require APP . 'view/user/ajouter_user.php';
                    require APP . 'view/_templates/footer.php';
                }
            }else
                header('location: ' . URL . 'error');
        }else
            header('location: ' . URL);
    }

    public function supprimeruser($id_user = '')
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_supprimeruser, $_SESSION['id_user']) == true)
            {
                if((isset($_POST["valider_supprimer"]) == true) && (isset($_POST["id"]) == true))
                {
                    $retour = false;
                    $image = NULL;

                    $image = $this->model->get_user_id($_POST["id"]);
                    if($image != NULL)
                        $image = $image->image;

                    $retour = $this->model->delete_user($_POST["id"]);
                    $users = $this->model->get_all_user();

                    if($retour == true)
                    {
                        if ($image != NULL)
                            unlink ( path_image . $_POST["id"] . '\\' . $image );

                        rmdir ( path_image . $_POST["id"] );
                        
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/user/done_supprimer.php';
                        require APP . 'view/user/supprimer_user.php';
                        require APP . 'view/_templates/footer.php';
                    }else
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/user/echec_supprimer.php';
                        require APP . 'view/user/supprimer_user.php';
                        require APP . 'view/_templates/footer.php';
                    }
                }else
                if($id_user != '') 
                {
                    $user_cible = $this->model->get_user_id($id_user);
                    
                    if($user_cible != NULL)
                    {
                        $users = $this->model->get_all_user();
                        
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/user/supprimer_executer.php';
                        require APP . 'view/user/supprimer_user.php';
                        require APP . 'view/_templates/footer.php';  
                    }else
                        header('location: ' . URL . 'error');
                }else
                {
                    $users = $this->model->get_all_user();

                    require APP . 'view/_templates/header.php';
                    require APP . 'view/user/supprimer_user.php';
                    require APP . 'view/_templates/footer.php'; 
                }
            }else
                header('location: ' . URL . 'error');
        }else
            header('location: ' . URL);
    }

    public function modifieruser($user_id = '')
    {
        session_start();
        if(isset($_SESSION['id_user']) == true) 
        {         
            if($this->model->verifier_droit_acces(id_modifieruser, $_SESSION['id_user']) == true)
            {
                if((isset($_POST["valider_modifier"]) == true) && (isset($_POST["id"]) == true) && ( isset($_POST["profil"]) == true ) && ( isset($_POST["login"]) == true ) && ( isset($_POST["nom"]) == true ) && ( isset($_POST["prenom"]) == true ))
                {
                    $id_user = $_POST["id"];
                    $profil_user = $_POST["profil"];
                    $login = $_POST["login"];
                    $nom = $_POST["nom"];
                    $prenom = $_POST["prenom"];

                    $retour = false;
                    $retour = $this->model->update_user($id_user, $profil_user, $login, $nom, $prenom);
                    $users = $this->model->get_all_user();

                    if($retour == true)
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/user/done_modifier.php';
                        require APP . 'view/user/modifier_user.php';
                        require APP . 'view/_templates/footer.php';
                    }else
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/user/echec_modifier.php';
                        require APP . 'view/user/modifier_user.php';
                        require APP . 'view/_templates/footer.php';
                    }
                }else
                if($user_id != '') 
                {
                    $user_cible = $this->model->get_user_id($user_id);
                    $profils = $this->model->get_all_profil();
                    
                    if($user_cible != NULL)
                    {
                        require APP . 'view/_templates/header.php';
                        require APP . 'view/user/modifier_executer.php';
                        require APP . 'view/_templates/footer.php';  
                    }else
                        header('location: ' . URL . 'error');
                }else
                {
                    $users = $this->model->get_all_user();

                    require APP . 'view/_templates/header.php';
                    require APP . 'view/user/modifier_user.php';
                    require APP . 'view/_templates/footer.php'; 
                }

            }else
                header('location: ' . URL . 'error');
        }else
            header('location: ' . URL);
    }
}

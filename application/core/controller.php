<?php

class Controller
{
    protected $db = null;
    protected $model = null;

    function __construct($Model  = '',$class = '')
    {
        if($Model != '')
        {
            $this->openDatabaseConnection();
            $this->loadModel($Model,$class);
        }
    }

    protected function openDatabaseConnection()
    {   
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
    }

    protected function loadModel($Model,$class)
    {
        require APP . $Model;
        $this->model = new $class($this->db);
    }
}

<?php
require_once 'database/database.php';
class Model extends DataBase
{
    protected $loggedInUser;
    protected $classification;
    public function __construct()
    {
        parent::__construct();
        if (isset($_SESSION['loggedInUser'])) {
            $this->loggedInUser = $_SESSION['loggedInUser'][0];
            switch ($this->loggedInUser['role']) {
                case 'owner':
                    $this->classification = 3;
                    break;
                case 'manager':
                    $this->classification = 2;
                    break;
                case 'sales':
                    $this->classification = 1;
                    break;
            }

        } else {
            $this->loggedInUser = null;
            $this->classification = 0;
        }
    }
    public function getLoggedInUser()
    {
        return $this->loggedInUser;
    }
    public function getClassification()
    {
        return $this->classification;
    }
}

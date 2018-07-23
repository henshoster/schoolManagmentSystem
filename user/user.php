<?php
require_once 'database/database.php';
class User extends DataBase
{
    protected $loggedInUser;
    protected $classification;

    const DB_TABLE = 'administrators';

    public function __construct()
    {
        parent::__construct();
        if (isset($_SESSION['loggedInUser'])) {
            $this->loggedInUser = $this->select(self::DB_TABLE, '*', "id = '{$_SESSION['loggedInUser'][0]['id']}'")[0];
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

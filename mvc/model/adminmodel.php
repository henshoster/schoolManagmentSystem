<?php
require_once 'mvc/model/model.php';
class AdminModel extends Model
{
    const DB_ADMINISTRATORS = 'administrators';

    protected $administrators;

    public function __construct()
    {
        parent::__construct();
        if ($this->classification < 2) {
            header('Location:index.php');
            die();
        }
        if ($this->classification < 3) {
            $this->administrators = $this->select(self::DB_ADMINISTRATORS, '*', "role NOT LIKE 'owner' ORDER BY role='manager' DESC");
        } else {
            $this->administrators = $this->select(self::DB_ADMINISTRATORS, '*', "1  ORDER BY role='owner' desc,role='manager' DESC");
        }
    }
    public function getAdministrators()
    {
        return $this->administrators;
    }

}

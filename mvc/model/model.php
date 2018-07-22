<?php
require_once 'database/database.php';
class Model extends DataBase
{
    protected $loggedInUser;
    protected $classification;

    protected $main_container_tpl;
    protected $selected_entity_info;

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
            $this->main_container_tpl = 'mvc/view/templates/' . str_replace('model', '', strtolower(get_class($this))) . '/maincontainer/default_tpl.php';
            $this->selected_entity_info = null;
        } else {
            $this->loggedInUser = null;
            $this->classification = 0;
            $this->main_container_tpl = null;
            $this->selected_entity_info = null;
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
    public function getMainContainerTpl()
    {
        return $this->main_container_tpl;
    }
    public function getSelectedEntityInfo()
    {
        return $this->selected_entity_info;
    }

    public function setMainContainerTpl($main_container_tpl)
    {
        $this->main_container_tpl = $main_container_tpl;
    }
    public function setSelectedEntityInfo($type, $id)
    {
        foreach ($this->{$type} as $entity) {
            if ($entity['id'] == $id) {
                $this->selected_entity_info = $entity;
                break;
            }
        }
    }

}

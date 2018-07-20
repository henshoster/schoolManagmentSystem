<?php
require_once 'mvc/model/model.php';
class AdminModel extends Model
{
    const DB_ADMINISTRATORS = 'administrators';

    protected $administrators;
    protected $main_container_tpl;
    protected $selected_admin_info;

    public function __construct()
    {
        parent::__construct();
        if ($this->classification < 2) {
            header('Location:index.php');
            die();
        }
        $this->administrators = $this->select(self::DB_ADMINISTRATORS);
        $this->main_container_tpl = 'mvc/view/templates/admin/maincontainer/default_tpl.php';
        $this->selected_admin_info = null;
    }
    public function getAdministrators()
    {
        return $this->administrators;
    }
    public function getMainContainerTpl()
    {
        return $this->main_container_tpl;
    }
    public function getSelectedAdminInfo()
    {
        return $this->selected_admin_info;
    }

    public function setMainContainerTpl($main_container_tpl)
    {
        $this->main_container_tpl = $main_container_tpl;
    }

    public function setMainContainerInfo($id)
    {

        $this->selected_admin_info = $this->select(self::DB_ADMINISTRATORS, '*', "id='$id'");
    }

}

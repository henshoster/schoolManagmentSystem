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

    public function setMainContainerInfo($type, $id)
    {
        $this->this_type_name = $type;
        $this->connected_type_name = str_replace('2', '', str_replace($type, '', self::DB_S2C));
        $this->this_type_info = $this->select($type, '*', "id='$id'");
        $this->connected_type_info = $this->queryTreatment(
            "SELECT id,name,image_src
            FROM students2courses
            LEFT JOIN $this->connected_type_name
            ON students2courses.{$this->connected_type_name}_id = {$this->connected_type_name}.id
            WHERE {$type}_id='$id'");
        $temp_arr = [];
        foreach ($this->connected_type_info as $key => $value) {
            $temp_arr[$value['id']] = $value;
        }
        $this->connected_type_info = $temp_arr;
        $this->courses = $this->select(self::DB_COURSES);
        $this->students = $this->select(self::DB_STUDENTS);
    }

}

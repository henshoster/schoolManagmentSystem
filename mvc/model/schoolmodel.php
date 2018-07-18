<?php
require_once 'mvc/model/model.php';
class SchoolModel extends Model
{
    const DB_STUDENTS = 'students';
    const DB_COURSES = 'courses';
    const DB_S2C = 'students2courses';

    protected $courses;
    protected $students;
    protected $main_container_tpl;
    protected $this_type_info;
    protected $connected_type_info;
    protected $this_type_name;
    protected $connected_type_name;
    protected $type_columns_names;

    public function __construct()
    {
        parent::__construct();
        if ($this->classification == 0) {
            header('Location:index.php');
            die();
        }
        $this->courses = $this->select(self::DB_COURSES);
        $this->students = $this->select(self::DB_STUDENTS);
        $this->main_container_tpl = 'mvc/view/templates/school/maincontainer/default_tpl.php';
        $this->this_type_info = null;
        $this->connected_type_info = null;
        $this->this_type_name = null;
        $this->connected_type_name = null;
        $this->type_columns_names = null;
    }
    public function getCourses()
    {
        return $this->courses;
    }
    public function getStudents()
    {
        return $this->students;
    }
    public function getMainContainerTpl()
    {
        return $this->main_container_tpl;
    }
    public function getMainContainerTypeInfo()
    {
        return $this->this_type_info;
    }
    public function getMainContainerConnectedTypeInfo()
    {
        return $this->connected_type_info;
    }
    public function getThisTypeName()
    {
        return $this->this_type_name;
    }
    public function getConnectedTypeName()
    {
        return $this->connected_type_name;
    }
    public function getTypeColumnsNames()
    {
        return $this->type_columns_names;
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
    public function setTypeColumnsNames($type)
    {
        $this->type_columns_names = $this->describeTable($type);
        unset($this->type_columns_names['0']);
    }

}

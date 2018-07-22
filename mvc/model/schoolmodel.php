<?php
require_once 'mvc/model/model.php';
class SchoolModel extends Model
{
    const DB_STUDENTS = 'students';
    const DB_COURSES = 'courses';
    const DB_S2C = 'students2courses';

    protected $courses;
    protected $students;

    protected $this_type_info;
    protected $connected_type_info;
    protected $this_type_name;
    protected $connected_type_name;
    protected $type_columns_names;

    public function __construct()
    {
        parent::__construct();
        if ($this->classification < 1) {
            header('Location:index.php');
            die();
        }
        $this->courses = $this->select(self::DB_COURSES);
        $this->students = $this->select(self::DB_STUDENTS);
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

    public function setSelectedEntityInfo($type, $id)
    {
        parent::setSelectedEntityInfo($type, $id);
        $this->this_type_name = $type;
        $this->connected_type_name = str_replace('2', '', str_replace($type, '', self::DB_S2C));
        $connected_type_info = $this->queryTreatment(
            "SELECT id,name,image_src
            FROM students2courses
            LEFT JOIN $this->connected_type_name
            ON students2courses.{$this->connected_type_name}_id = {$this->connected_type_name}.id
            WHERE {$type}_id='$id'");
        $temp_arr = [];
        foreach ($connected_type_info as $key => $value) {
            $temp_arr[$value['id']] = $value;
        }
        $this->connected_type_info = $temp_arr;
    }
    public function setTypeColumnsNames($type)
    {
        $this->type_columns_names = $this->describeTable($type);
        unset($this->type_columns_names['0']);
    }

}

<?php
require_once 'mvc/view/view.php';
class SchoolView extends View
{
    protected $courses;
    protected $students;
    protected $connected_type_info;
    protected $this_type_name;
    protected $connected_type_name;
    protected $type_columns_names;

    public function output()
    {
        $this->courses = $this->model->getCourses();
        $this->students = $this->model->getStudents();
        $this->connected_type_info = $this->model->getMainContainerConnectedTypeInfo();
        $this->this_type_name = $this->model->getThisTypeName();
        $this->connected_type_name = $this->model->getConnectedTypeName();
        $this->type_columns_names = $this->model->getTypeColumnsNames();
        parent::output();
    }
}

<?php
require_once 'mvc/view/view.php';
class SchoolView extends View
{
    public function output()
    {
        $courses = $this->model->getCourses();
        $students = $this->model->getStudents();
        $main_container_tpl = $this->model->getMainContainerTpl();
        $this_type_info = $this->model->getSelectedEntityInfo();
        $connected_type_info = $this->model->getMainContainerConnectedTypeInfo();
        $this_type_name = $this->model->getThisTypeName();
        $connected_type_name = $this->model->getConnectedTypeName();
        $type_columns_names = $this->model->getTypeColumnsNames();
        include 'mvc/view/templates/school/school_tpl.php';
        include 'mvc/view/templates/school/maincontainer/delete_confirmation_modal.php';
    }
}

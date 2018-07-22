<?php
require_once 'mvc/controller/controller.php';
class SchoolController extends Controller
{
    const DB_STUDENTS = 'students';
    const DB_COURSES = 'courses';
    const DB_S2C = 'students2courses';

    public function deleteEntity()
    {
        if ($_GET['type'] == 'students') {
            $this->model->delete(self::DB_S2C, "students_id='{$_GET['id']}'");
        }
        parent::deleteEntity();
    }
    public function newEntityForm()
    {
        if ($_GET['type'] == 'courses' && $this->model->getClassification() < 2) {
            header('Location:index.php?route=school');
            die();
        }
        $this->model->setTypeColumnsNames($_GET['type']);
        parent::newEntityForm();
    }

    public function save()
    {
        $courses = isset($_POST['courses']) ? $_POST['courses'] : null;
        unset($_POST['courses']);
        $id = parent::saveEntity();
        if ($_GET['type'] == 'students') {
            $this->model->delete(self::DB_S2C, "students_id='$id'");
            $columns = ['students_id', 'courses_id'];
            $values = [];
            foreach ($courses as $key => $value) {
                array_push($values, $id);
                array_push($values, $value);
                $this->model->insert(self::DB_S2C, $columns, $values);
                $values = [];
            }
        }

        header('Location:' . str_replace('save', 'showdetails', "index.php?{$_SERVER['QUERY_STRING']}" . (isset($_GET['id']) ? "" : "&id={$id}")));
        die();
    }
    public function editEntity()
    {
        //Prevents from admin type of 'Sales' to edit courses if he will try to do it by url.
        if ($_GET['type'] == 'courses' && $this->model->getClassification() < 2) {
            header('Location:index.php?route=school');
            die();
        }
        parent::editEntity();
    }
    public function showDetails()
    {
        $this->model->setMainContainerTpl("mvc/view/templates/school/maincontainer/details_tpl.php");
        $this->model->setSelectedEntityInfo($_GET['type'], $_GET['id']);
    }
}

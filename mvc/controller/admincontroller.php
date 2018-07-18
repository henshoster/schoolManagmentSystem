<?php
require_once 'mvc/controller/controller.php';
class AdminController extends Controller
{
    const DB_ADMINISTRATORS = 'administrators';

    public function deleteEntity()
    {
        $this->model->delete($_GET['type'], "id='{$_GET['id']}'");
        if ($_GET['type'] == 'students') {
            $this->model->delete(self::DB_S2C, "students_id='{$_GET['id']}'");
        }
        header('Location:index.php?route=school');
        die();
    }
    public function newEntityForm()
    {
        $this->model->setMainContainerTpl("mvc/view/templates/school/maincontainer/newentity_tpl.php");
        $this->model->setTypeColumnsNames($_GET['type']);
    }
    public function save()
    {
        if ($_FILES["fileToUpload"]["size"] > 0) {
            require_once 'helpers/file_upload.php';
            if ($uploadOk == 1) {
                $_POST['image_src'] = $target_file;
            } else {
                header('Location:' . str_replace('save', 'edit', "index.php?{$_SERVER['QUERY_STRING']}"));
                die();
            }
        }

        $courses = isset($_POST['courses']) ? $_POST['courses'] : null;
        unset($_POST['courses']);

        $columns = [];
        $values = [];
        foreach ($_POST as $key => $value) {
            array_push($columns, $key);
            array_push($values, $value);
        }
        if (isset($_GET['id'])) {
            $this->model->update($_GET['type'], $columns, $values, "id='{$_GET['id']}'");
            $id = $_GET['id'];
        } else {
            $this->model->insert($_GET['type'], $columns, $values);
            $id = $this->model->getLastId();
        }

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
    public function edit()
    {
        $this->model->setMainContainerTpl("mvc/view/templates/school/maincontainer/edit_tpl.php");
        $this->model->setMainContainerInfo($_GET['type'], $_GET['id']);
    }
    public function showDetails()
    {
        $this->model->setMainContainerTpl("mvc/view/templates/school/maincontainer/details_tpl.php");
        $this->model->setMainContainerInfo($_GET['type'], $_GET['id']);
    }
}

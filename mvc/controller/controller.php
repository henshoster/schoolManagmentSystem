<?php
class Controller
{

    protected $model;
    const DB_TABLE = 'administrators';

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function getName()
    {
        return get_class($this);
    }

    public function logIn()
    {
        if (!isset($_POST['log_in'])) {
            header("Location:index.php");
            die();
        }
        $hash = $this->model->select(self::DB_TABLE, 'password', "email = '{$_POST['user_email_login']}'")[0]['password'];
        if (password_verify($_POST['password_login'], $hash)) {
            $_SESSION['loggedInUser'] = $this->model->select(self::DB_TABLE, '*', "email = '{$_POST['user_email_login']}'");
            header("Location:index.php?route=school");
            die();
        } else {
            $error = 'Email or Password incorrect or do not exist';
            header("Location:index.php?loginerror={$error}");
            die();
        }
    }

    public function logOut()
    {
        unset($_COOKIE['PHPSESSID']);
        setcookie('PHPSESSID', '', time() - 3600, '/');
        session_destroy();
        header("Location:index.php");
        die();
    }

    public function saveEntity()
    {
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->checkInput($value);
        }

        if (isset($_POST['email'])) {
            $getType = "get" . ucfirst($_GET['type']);
            foreach ($this->model->{$getType}() as $key => $value) {
                if (($value['email'] == $_POST['email'])) {
                    if (isset($_GET['id']) && ($value['id'] == $_GET['id'])) {
                        break;
                    }
                    header('Location:' . str_replace('save', $_POST['last_action'], "index.php?{$_SERVER['QUERY_STRING']}&upload_error=Email already exist! Please choose another one"));
                    die();
                }
            }
        }

        if ($_FILES['fileToUpload']["tmp_name"] != null) {
            $uploadResult = $this->fileUpload();
            if ($uploadResult['uploadOk'] == 1) {
                $_POST['image_src'] = $uploadResult['target_file'];
            } else {
                header('Location:' . str_replace('save', $_POST['last_action'], "index.php?{$_SERVER['QUERY_STRING']}&upload_error={$uploadResult['error']}"));
                die();
            }
        }
        unset($_POST['last_action']);

        $columns = [];
        $values = [];
        foreach ($_POST as $key => $value) {
            array_push($columns, $key);
            array_push($values, $key == 'password' ? password_hash($value, PASSWORD_DEFAULT) : $value);
        }
        if (isset($_GET['id'])) {
            $this->model->update($_GET['type'], $columns, $values, "id='{$_GET['id']}'");
            $id = $_GET['id'];
        } else {
            $this->model->insert($_GET['type'], $columns, $values);
            $id = $this->model->getLastId();
        }
        return $id;
    }

    public function editEntity()
    {
        $this->model->setMainContainerTpl('mvc/view/templates/' . str_replace('controller', '', strtolower(get_class($this))) . '/maincontainer/edit_tpl.php');
        $this->model->setSelectedEntityInfo($_GET['type'], $_GET['id']);
    }

    public function newEntityForm()
    {
        $this->model->setMainContainerTpl('mvc/view/templates/' . str_replace('controller', '', strtolower(get_class($this))) . '/maincontainer/newentity_tpl.php');
    }

    public function deleteEntity()
    {
        $this->model->delete($_GET['type'], "id='{$_GET['id']}'");
        header('Location:index.php?route=' . str_replace('controller', '', strtolower(get_class($this))));
        die();
    }

    public function fileUpload()
    {
        $uploadResult = [];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadResult['uploadOk'] = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        $error = '';
        if ($check !== false) {
            $uploadResult['uploadOk'] = 1;
        } else {
            $uploadResult['error'] = "File is not an image.";
            $uploadResult['uploadOk'] = 0;
            return $uploadResult;
        }
        if ($_FILES["fileToUpload"]["size"] > 500000 || $_FILES["fileToUpload"]["size"] == 0) {
            $uploadResult['error'] = "Sorry, your file is too large max size is:500kb.";
            $uploadResult['uploadOk'] = 0;
            return $uploadResult;
        }
        if (($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") || $_FILES["fileToUpload"]["type"] == null) {
            $uploadResult['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadResult['uploadOk'] = 0;
            return $uploadResult;
        }
        if ($uploadResult['uploadOk'] == 0) {
            $uploadResult['error'] = "Sorry, your file was not uploaded.";
            return $uploadResult;
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $uploadResult['target_file'] = $target_file;
                return $uploadResult;
            } else {
                $uploadResult['error'] = "Sorry, there was an error uploading your file.";
                $uploadResult['uploadOk'] = 0;
                return $uploadResult;
            }
        }
    }
}

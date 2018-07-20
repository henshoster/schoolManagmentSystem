<?php
class Controller
{

    protected $model;
    const DB_TABLE = 'administrators';

    public function getName()
    {
        return get_class($this);
    }

    public function __construct(Model $model)
    {
        $this->model = $model;
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
    public function fileUpload()
    {
        $uploadResult = [];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadResult['uploadOk'] = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        $error = '';
        if ($check !== false) {
            $uploadResult['uploadOk'] = 1;
        } else {
            $uploadResult['error'] = "File is not an image.";
            $uploadResult['uploadOk'] = 0;
            return $uploadResult;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000 || $_FILES["fileToUpload"]["size"] == 0) {
            $uploadResult['error'] = "Sorry, your file is too large max size is:500kb.";
            $uploadResult['uploadOk'] = 0;
            return $uploadResult;
        }
        // Allow certain file formats
        if ((

            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") || $_FILES["fileToUpload"]["type"] == null) {
            $uploadResult['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadResult['uploadOk'] = 0;
            return $uploadResult;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadResult['uploadOk'] == 0) {
            $uploadResult['error'] = "Sorry, your file was not uploaded.";
            return $uploadResult;
            // if everything is ok, try to upload file
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

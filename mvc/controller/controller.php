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
        if ($this->model->select(self::DB_TABLE, 'password', "name = '{$_POST['user_name_login']}'")[0]['password'] == $_POST['password_login']) {
            $_SESSION['loggedInUser'] = $this->model->select(self::DB_TABLE, '*', "name = '{$_POST['user_name_login']}'");
            header("Location:index.php?route=school");
            die();
        } else {
            $error = 'User name or Password incorrect or not exist';
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
}

<?php
class View
{
    protected $model;
    protected $route;

    public function __construct(Model $model, $route = null)
    {
        $this->model = $model;
        $this->route = $route;

    }
    public function HeaderOutput()
    {
        $classification = $this->model->getClassification();
        $loggedInUser = $this->model->getLoggedInUser();
        include 'mvc/view/templates/header/header_tpl.php';
        include 'mvc/view/templates/header/login_modal.php';
    }
    public function output()
    {
        include 'mvc/view/templates/default_main_page.php';
    }
}

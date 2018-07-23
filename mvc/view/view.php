<?php
class View
{
    protected $model;
    protected $route;

    protected $main_container_tpl;
    protected $selected_entity_info;

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
        include 'mvc/view/templates/modals/login_modal.php';
    }
    public function output()
    {
        if ($this->route != null) {
            $this->main_container_tpl = $this->model->getMainContainerTpl();
            $this->selected_entity_info = $this->model->getSelectedEntityInfo();
            include 'mvc/view/templates/' . str_replace('view', '', strtolower(get_class($this))) . '/' . str_replace('view', '', strtolower(get_class($this))) . '_tpl.php';
            include 'mvc/view/templates/modals/delete_confirmation_modal.php';
        } else {
            include 'mvc/view/templates/default_main_page.php';
        }
    }
}

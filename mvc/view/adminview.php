<?php
require_once 'mvc/view/view.php';
class AdminView extends View
{
    public function output()
    {
        $administrators = $this->model->getAdministrators();
        $main_container_tpl = $this->model->getMainContainerTpl();
        $selected_admin_info = $this->model->getSelectedAdminInfo()[0];

        include 'mvc/view/templates/admin/admin_tpl.php';
        include 'mvc/view/templates/admin/maincontainer/delete_confirmation_modal.php';
    }
}

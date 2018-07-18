<?php
class FrontController
{
    protected $controller;
    protected $view;
    protected $model;

    public function __construct(Router $router, $routeName = null, $action = null)
    {
        require_once "mvc/model/{$routeName}model.php";
        require_once "mvc/controller/{$routeName}controller.php";
        require_once "mvc/view/{$routeName}view.php";
        $route = $router->getRoute($routeName);
        $modelName = $route->model;
        $controllerName = $route->controller;
        $viewName = $route->view;
        $model = new $modelName;

        $this->model = $model;
        $this->controller = new $controllerName($this->model);
        $this->view = new $viewName($this->model, $routeName);

        if (!empty($action)) {
            $this->controller->{$action}();
        }

    }

    public function getModel()
    {
        return $this->model;
    }
    public function printHeader()
    {
        return $this->view->HeaderOutput();
    }
    public function printSection()
    {
        return $this->view->output();
    }
}

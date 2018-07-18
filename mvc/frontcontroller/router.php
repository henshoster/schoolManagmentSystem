<?php
class Router
{
    protected $table = array();

    public function __construct()
    {
        $this->table['controller'] = new Route('Model', 'View', 'Controller');
        $this->table['school'] = new Route('schoolModel', 'schoolView', 'schoolController');
        $this->table['admin'] = new Route('adminModel', 'adminView', 'adminController');
    }

    public function getRoute($route)
    {
        $route = strtolower($route);
        if (!isset($this->table[$route])) {
            return $this->table['controller'];
        }
        return $this->table[$route];
    }
}

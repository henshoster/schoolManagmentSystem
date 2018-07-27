<?php
class dirView
{
    protected $model;

    protected $default_tpl;
    protected $directoryStucture;

    public function __construct($model)
    {
        $this->model = $model;
        $this->directoryStucture = $this->model->getDirectoryStructure();
    }
    public function treePrint($dirtree = null, $uniqueCounter = 0)
    {
        $dirtree == null ? $dirtree = $this->directoryStucture : $dirtree = $dirtree;
        include 'main_page/file_structure_tpl.php';
    }
}

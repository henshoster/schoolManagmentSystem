<?php
require_once 'user/user.php';

class Model extends User
{
    protected $main_container_tpl;
    protected $selected_entity_info;
    protected $directoryStucture;

    public function __construct()
    {
        parent::__construct();
        if ($this->getClassification() != 0) {
            $this->main_container_tpl = 'mvc/view/templates/' . str_replace('model', '', strtolower(get_class($this))) . '/maincontainer/default_tpl.php';
        }
        $this->directoryStucture = $this->dirTree('./');
        if (isset($this->directoryStucture['.git'])) {
            unset($this->directoryStucture['.git']);
        }
        foreach ($this->directoryStucture['uploads'] as $key => $value) {
            $imageFileType = strtolower(pathinfo("uploads/$value", PATHINFO_EXTENSION));
            if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
                || $imageFileType == "gif") {
                unset($this->directoryStucture['uploads'][$key]);
            }
        }
    }
    public function getDirectoryStructure()
    {
        return $this->directoryStucture;
    }
    public function getMainContainerTpl()
    {
        return $this->main_container_tpl;
    }
    public function getSelectedEntityInfo()
    {
        return $this->selected_entity_info;
    }

    public function setMainContainerTpl($main_container_tpl)
    {
        $this->main_container_tpl = $main_container_tpl;
    }
    public function setSelectedEntityInfo($type, $id)
    {
        foreach ($this->{$type} as $entity) {
            if ($entity['id'] == $id) {
                $this->selected_entity_info = $entity;
                break;
            }
        }
    }

    //Creates a tree-structured array of directories and files from a given root folder.
    public function dirTree($dir, $regex = '', $ignoreEmpty = false)
    {
        if (!$dir instanceof DirectoryIterator) {
            $dir = new DirectoryIterator((string) $dir);
        }
        $dirs = array();
        $files = array();
        foreach ($dir as $node) {
            if ($node->isDir() && !$node->isDot()) {
                $tree = $this->dirTree($node->getPathname(), $regex, $ignoreEmpty);
                if (!$ignoreEmpty || count($tree)) {
                    $dirs[$node->getFilename()] = $tree;
                }
            } elseif ($node->isFile()) {
                $name = $node->getFilename();
                if ('' == $regex || preg_match($regex, $name)) {
                    $files[] = $name;
                }
            }
        }
        asort($dirs);
        sort($files);
        return array_merge($dirs, $files);
    }

}

<?php
class dirModel
{
    protected $default_tpl;
    protected $directoryStucture;

    public function __construct()
    {
        $this->directoryStucture = $this->dirTree('./');
    }
    public function getDirectoryStructure()
    {
        return $this->directoryStucture;
    }
    public function getDefaultTpl()
    {
        return $this->default_tpl;
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
            if ($node->isDir() && !$node->isDot() && !(strpos($node->getFilename(), '.') === 0)) {
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

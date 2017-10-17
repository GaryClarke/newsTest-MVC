<?php



namespace OCFram;


class Managers {

    protected $api = null;
    protected $dao = null;
    protected $managers = [];

    // Constructor. This assigns the API (PDO / MySQLi) and the data access object
    public function __construct($api, $dao)
    {
        $this->api = $api;
        $this->dao = $dao;
    }

    // getManagerOf(). This takes the module as an argument. The goal is to set a DB manager object for a module and
    // return the manager for that module.
    public function getManagerOf($module)
    {
        // validate the module argument (string/not empty). Throw an invalid arg Exception if the module doesn't
        // validate.
        if (!is_string($module) || empty($module))
        {
            throw new \InvalidArgumentException('The module "'.$module.'" does not exist');
        }

        // check to see IF a manager is not set for the module (e.g. NewsManagerPDO)
        if (!isset($this->managers[$module]))
        {
            // store the $manager in the form \Model\ModuleManagerAPI - this is the form of a module manager class
            $manager = '\\Model\\'.$module.'Manager'.$this->api;

            // new up a manager using $manager (don't forget to follow the Manager construct convention)
            $this->managers[$module] = new $manager($this->dao);

        }

        // return the manager for this module
        return $this->managers[$module];
    }
}
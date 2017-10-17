<?php



namespace OCFram;


class Route {

    protected $action;
    protected $module;
    protected $url;
    protected $varsNames;
    protected $vars = [];

    /**
     * @param $action
     * @param $module
     * @param $url
     * @param array $varsNames
     */
    public function __construct($url, $module, $action, array $varsNames)
    {
        $this->setUrl($url);
        $this->setModule($module);
        $this->setAction($action);
        $this->setVarsNames($varsNames);
    }

    /**
     * @return bool
     */
    public function hasVars()
    {
        return !empty($this->varsNames);
    }


    // check to see if the user supplied url matches a stored url, return matches
    // you are seeking to use the ones from the parentheses as id, slug vars
    // if no match return false
    /**
     * @param $url
     * @return bool
     */
    public function match($url)
    {
        if (preg_match('`^'.$this->url.'$`', $url, $matches))
        {
            return $matches;
        }

        return false;

    }

    /**
     * @param $action
     */
    public function setAction($action)
    {
        if (is_string($action))
        {
            $this->action = $action;
        }

    }

    /**
     * @param $module
     */
    public function setModule($module)
    {
        if (is_string($module))
        {
            $this->module = $module;
        }

    }

    /**
     * @param $url
     */
    public function setUrl($url)
    {
        if (is_string($url))
        {
            $this->url = $url;
        }

    }

    /**
     * @param array $varsNames
     */
    public function setVarsNames(array $varsNames)
    {
        $this->varsNames = $varsNames;
    }

    /**
     * @param array $vars
     */
    public function setVars(array $vars)
    {
        $this->vars = $vars;
    }

    /**
     * @return mixed
     */
    public function action()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function module()
    {
        return $this->module;
    }

    /**
     * @return mixed
     */
    public function url()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function varsNames()
    {
        return $this->varsNames;
    }

    /**
     * @return mixed
     */
    public function vars()
    {
        return $this->vars;
    }



}
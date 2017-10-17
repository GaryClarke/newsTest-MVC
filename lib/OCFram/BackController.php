<?php



namespace OCFram;


abstract class BackController extends ApplicationComponent {

    protected $action = '';
    protected $module = '';
    protected $page = null;
    protected $view = '';
    protected $managers = null;

    public function __construct(Application $app, $module, $action)
    {
        parent::__construct($app);

        // The Managers args are api and dao
        $this->managers = new Managers('PDO', PDOFactory::getMysqlConnexion());
        $this->page = new Page($app);

        $this->setModule($module);
        $this->setAction($action);
        $this->setView($action);
    }

    // Execute method takes the form executeAction. First create the method then check that it is callable
    // on the current instance i.e. this. Then call the method.
    public function execute()
    {
        $method = 'execute'.ucfirst($this->action);

        if (!is_callable([$this, $method]))
        {
            throw new \RuntimeException('The action "'.$this->action.'" is not defined in this module');
        }

        $this->$method($this->app->httpRequest());

    }

    public function page()
    {
        return $this->page;
    }

    /**
     * @param string $action
     */
    public function setAction($action)
    {
        if (!is_string($action) || empty($action))
        {
            throw new \InvalidArgumentException('The action must be a valid character string');
        }

        $this->action = $action;
    }

    /**
     * @param string $module
     */
    public function setModule($module)
    {
        if (!is_string($module) || empty($module))
        {
            throw new \InvalidArgumentException('The module must be a valid character string');
        }

        $this->module = $module;
    }

    /**
     * @param string $view
     */
    public function setView($view)
    {
        if (!is_string($view) || empty($view))
        {
            throw new \InvalidArgumentException('The view must be a valid character string');
        }

        $this->view = $view;

        // set the content file to the view. This will be located in:
        // ApplicationName/Modules/Module/Views/$this->view.php
        $this->page->setContentFile(
            __DIR__.'/../../App/'
            .$this->app->name()
            .'/Modules/'
            .$this->module
            .'/Views/'
            .$this->view.'.php');

    }

}
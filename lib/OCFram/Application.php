<?php



namespace OCFram;



abstract class Application {

    // XmlControllerTrait - getController() method comes from this trait. It is XML specific so should routes be
    // obtained from a different type of doc in the future it is just a case of creating a different trait which
    // establishes the getController() then using that trait instead of this one.
    use XmlControllerTrait;

    protected $httpRequest;
    protected $httpResponse;
    protected $name;
    protected $user;
    protected $config;


    /**
     * Each class inheriting Application will specify their own name
     * e.g. $this->name = 'Frontend';
     */
    public function __construct()
    {
        $this->httpRequest = new HTTPRequest($this);
        $this->httpResponse = new HTTPResponse($this);
        $this->user = new User($this);
        $this->config = new Config($this);
        $this->name = '';
    }



    abstract public function run();

    public function httpRequest()
    {
        return $this->httpRequest;
    }

    public function httpResponse()
    {
        return $this->httpResponse;
    }

    public function name()
    {
        return $this->name;
    }

    public function config()
    {
        return $this->config;
    }

    public function user()
    {
        return $this->user;
    }

}
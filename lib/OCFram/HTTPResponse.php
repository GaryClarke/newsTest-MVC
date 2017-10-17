<?php



namespace OCFram;


class HTTPResponse extends ApplicationComponent {

    protected $page;

    public function addHeader($header)
    {
        header($header);
    }

    public function redirect($location)
    {
        header('Location: '.$location);
        exit;
    }

    public function redirect404()
    {
        // Create a Page instance ($page)
        $this->page = new Page($this->app);

        // Assign the 404.html to the page
        $this->page->setContentFile(__DIR__.'/../../Errors/404.html');

        // Add the not found header
        $this->addHeader("HTTP/1.0 404 Not Found");

        // Send the response
        $this->send();


    }

    public function send()
    {
        exit($this->page->getGeneratedPage());
    }

    public function setPage(Page $page)
    {
        $this->page = $page;
    }

    public function setCookie($name, $value = '', $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true)
    {
        setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
    }

}
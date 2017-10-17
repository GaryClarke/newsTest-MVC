<?php



namespace OCFram;


class Page extends ApplicationComponent {

    protected $contentFile = '';
    protected $vars = [];

    // must be a chain of characters and not null, throw invalid arg exception if not
    public function addVar($var, $value)
    {
        if (!is_string($var) || is_numeric($var) || empty($var))
        {
            throw new \InvalidArgumentException('The name of the variable must be a character string not null');
        }

        $this->vars[$var] = $value;
    }


    /**
     *
     *
     * @return string
     */
    public function getGeneratedPage()
    {
        // check if the content file exists
        if (!file_exists($this->contentFile))
        {
            // throw a runtime exception if not
            throw new \RuntimeException('The specified view does not exist');
        }

        $user = $this->app->user();

        // extract the vars from the $vars variable
        extract($this->vars);

        // start output buffering
        ob_start();
            // require the contentFile
            require $this->contentFile;
        // store the output buffering content in $content
        $content = ob_get_clean();

        // start output buffering
        ob_start();
            // require the layout template file (this will be located in AppplicationName/Templates/layout.php
            require __DIR__.'/../../App/'.$this->app->name().'/Templates/layout.php';

        // return the output buffering contents i.e. the layout file
        return ob_get_clean();

    }

    /**
     * Set the content file
     *
     * @param $contentFile
     */
    public function setContentFile($contentFile)
    {
        // check that the content file is a non-empty string value
        if (empty($contentFile) || !is_string($contentFile))
        {
            // if it is, throw an invalid arg exception
            throw new \InvalidArgumentException('The specified view is invalid');
        }
        // set the content file
        $this->contentFile = $contentFile;
    }



}
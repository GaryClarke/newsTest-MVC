<?php

namespace OCFram;


trait XmlConfigTrait {

    public function get($var)
    {
        // check if there are any vars ($vars)
        if (!$this->vars)
        {
            // new up a DOMDocument
            $xml = new \DOMDocument;

            // load app.xml from application config folder
            $xml->load(__DIR__.'/../../App/'.$this->app->name().'/Config/app.xml');

            // store all 'define' elements in an array
            $elements = $xml->getElementsByTagName('define');

            // loop through the array to obtain each element. Each will become a DOMElement object
            foreach ($elements as $element)
            {
                // store element var and value as pairs in $var
                $this->vars[$element->getAttribute('var')] = $element->getAttribute('value');
            }
        }

        // check if $var is set in $vars. If so return that value
        if (isset($this->vars[$var]))
        {
            return $this->vars[$var];
        }

        // alternatively return null
        return null;

    }
}
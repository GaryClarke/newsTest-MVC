<?php
/**
 * Created by PhpStorm.
 * User: gc
 * Date: 24/07/15
 * Time: 22:14
 */

namespace OCFram;


trait XmlControllerTrait {

    /**
     * @return Controller
     */
    public function getController()
    {
        $router = new XmlRouter();

        // new up a DOMDocument, assign to $xml
        $xml = new \DOMDocument;

        // load the routes.xml file into $xml. There are 2 applications in App (Frontend / Backend).
        // routes.xml will be found in the config folder of either of these apps
        $xml->load(__DIR__ . '/../../App/' . $this->name . '/Config/routes.xml');

        // store all <route> elements in $routes. This will create an array of DOMElement's
        $routes = $xml->getElementsByTagName('route');

        // loop through all route DOMElements
        foreach ($routes as $route)
        {
            // initialise a vars array
            $vars = [];

            // check IF the route element has a vars attribute
            if ($route->hasAttribute('vars'))
            {
                // explode the individual var names into an array (they are separated by a single comma, no space)
                $vars = explode(',', $route->getAttribute('vars'));
            }

            // add a new route to the xml router using the <route> attributes as the construct args
            $router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'),
                $route->getAttribute('action'), $vars));
        }

        // Try to get a matched route by calling the xml router - getRoute() method. Clue: the url needed for the
        // argument will come from within the httpRequest ;) - Store in matched route var
        try
        {
            $matchedRoute = $router->getRoute($this->httpRequest->requestURI());
        }
            // catch any runtime exceptions
        catch (\RuntimeException $e)
        {
            if ($e->getCode() == XmlRouter::NO_ROUTE)
            {
                // send redirect404 response
                $this->httpResponse->redirect404();
            }
        }

        // use array merge to store the matched route vars in $_GET
        $_GET = array_merge($_GET, $matchedRoute->vars());

        // build up the controller class name:
        // App\ApplicationName\Modules\module(comes from route)\moduleController
        $controller = 'App\\'.$this->name.'\\Modules\\'.$matchedRoute->module().'\\'.$matchedRoute->module().'Controller';
        // return the new controller - args: app, route-module, route-action
        return new $controller($this, $matchedRoute->module(), $matchedRoute->action());
    }

}
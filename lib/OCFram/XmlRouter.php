<?php



namespace OCFram;


class XmlRouter implements Router {

    protected $routes = [];

    const NO_ROUTE = 1;

    public function addRoute(Route $route)
    {
        // Check that $route is not already in $routes array, then add
        if (!in_array($route, $this->routes))
        {
            $this->routes[] = $route;
        }
    }


    public function getRoute($url)
    {
        // loop through the routes
        foreach ($this->routes as $route)
        {
            // check that the user-entered url matches one of the routes in the xml file
            // if so, assign the values from the preg_match matches to a $varsValues
            if (($varsValues = $route->match($url)) !== false)
            {
                // see IF the route has vars. The home page probably won't have vars (id/slug)
                // but specific pages (e.g. thissite.com/news/news-newnews-12) will have
                if ($route->hasVars())
                {
                    // assign $route->varsNames() to $varsNames var and create $listVars array
                    $varsNames = $route->varsNames();
                    $listVars = [];

                    // loop through $varsValues, obtaining the key and the match
                    foreach ($varsValues as $key => $match)
                    {
                        // The first key is the whole url string. This is not needed here as you are after the
                        // url variables (newnews, 12). So check IF the key value is NOT 0
                        if ($key !== 0)
                        {
                            // Add each $varsNames to the $listVars array one item at a time using the match from
                            // $varsValues as the value. Remember that to bring the key back one (-1) because the key
                            // will be starting at 1 due to not wanting the full string (0 index) from $varsValues
                            $listVars[$varsNames[$key - 1]] = $match;

                        }
                    }
                    // $route->setVars using the list vars values. This will assign key / value pairs the the route vars
                    // array
                    $route->setVars($listVars);
                }
                // Return the route. It will be returned if a match is found in the route xml file
                return $route;
            }

        }

        // If a route is not returned throw a runtime exception declaring that such a route does not exist. Use
        // the NO_ROUTE const as the code argument. This will equate to code 1 which means that the requested file
        // does not exist. In the real world a 404 response should be sent here
        throw new \RuntimeException('No route found which matches the entered URL', self::NO_ROUTE);

    }

}
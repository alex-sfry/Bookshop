<?php

namespace Vic\Router;

/**
 * Class Router
 */
class Router
{
    private array $routes;
    private string $namespace;

    /**
     * @param string $namespace
     */
    public function __construct(string $namespace)
    {
        $this->namespace = $namespace;
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    /**
     * @return string | null
     */
    private function getURI(): string | null
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        } else {
            return null;
        }
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~^$uriPattern$~", $uri)) {
                $internalRoute = preg_replace("~^$uriPattern$~", $path, $uri);
                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action' . ucfirst(array_shift($segments));

                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                $parameters = $segments;

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                $obj_name = '\\' . $this->namespace . '\\' . $controllerName;

                $controllerObject = new $obj_name();
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if ($result != null) {
                    break;
                }
            }
        }
    }
}

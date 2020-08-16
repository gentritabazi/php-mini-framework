<?php

namespace Core;

use Core\IRequest;

class Router
{
    protected $basePath;
    protected $requestUri;
    protected $requestMethod;
    protected $httpMethods = array('get', 'post', 'put', 'patch', 'delete');
    protected $wildCards = array('int' => '/^[0-9]+$/', 'any' => '/^[0-9A-Za-z]+$/');
 
    public function __construct($basePath = APP_SUB_DIRECTORY)
    {
        $this->basePath = $basePath;
 
        $this->requestUri = rtrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
        $this->requestMethod = $this->determineHttpMethod();
    }
 
    private function determineHttpMethod()
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
 
        if (in_array($method, $this->httpMethods)) {
            return $method;
        }

        return 'get';
    }

    public function respond($method, $route, $callable)
    {
        $method = strtolower($method);
     
        if ($route == '/') {
            $route = $this->basePath;
        } else {
            $route = $this->basePath . $route;
        }
     
        $matches = $this->matchWildCards($route);

        if (is_array($matches) && $method == $this->requestMethod) {
            call_user_func_array($callable, $matches);
        }
    }

    private function matchWildCards($route)
    {
        $variables = array();
     
        $exp_request = explode('/', $this->requestUri);
        $exp_route = explode('/', $route);
     
        if (count($exp_request) == count($exp_route)) {
            foreach ($exp_route as $key => $value) {
                if ($value == $exp_request[$key]) {
                    continue;
                } elseif ($value[0] == '(' && substr($value, -1) == ')') {
                    $strip = str_replace(array('(', ')'), '', $value);
                    $exp = explode(':', $strip);
     
                    if (array_key_exists($exp[0], $this->wildCards)) {
                        $pattern = $this->wildCards[$exp[0]];
                    
                        if (preg_match($pattern, $exp_request[$key])) {
                            if (isset($exp[1])) {
                                $variables[$exp[1]] = $exp_request[$key];
                            }
     
                            continue;
                        }
                    }
                }
     
                return false;
            }
     
            return $variables;
        }
     
        return false;
    }
}

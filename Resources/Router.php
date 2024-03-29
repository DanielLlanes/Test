<?php
class Router
{
    private $routes = [];

    public function get($url, $controllerAction)
    {
        $this->routes['GET'][$url] = $controllerAction;
    }

    public function post($url, $controllerAction)
    {
        $this->routes['POST'][$url] = $controllerAction;
    }

    public function put($url, $controllerAction)
    {
        $this->routes['PUT'][$url] = $controllerAction;
    }

    public function patch($url, $controllerAction)
    {
        $this->routes['PATCH'][$url] = $controllerAction;
    }

    public function delete($url, $controllerAction)
    {
        $this->routes['DELETE'][$url] = $controllerAction;
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = rtrim($_GET['url'] ?? '', '/');

        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $route => $controllerAction) {
                $numParams = preg_match_all('/\{([^\/]+)\}/', $route, $matches);

                $pattern = str_replace('/', '\/', $route); 
                $pattern = preg_replace('/\{([^\/]+)\}/', '(?<$1>[^\/]+)', $pattern);


                if (preg_match("#^$pattern$#", $url, $routeParams)) {

                    list($controller, $action) = explode('@', $controllerAction);


                    $controllerFile = "App/Controllers/{$controller}.php";

                    if (!file_exists($controllerFile)) {
                        $this->sendJsonResponse(404, [], 'Archivo del controlador no encontrado');
                        return;
                    }
                    require_once $controllerFile;


                    $controllerInstance = new $controller();

                    $routeParams = array_intersect_key($routeParams, array_flip(array_slice($matches[1], 0, $numParams)));
                    $controllerInstance->$action($routeParams);
                    return;
                }
            }
        }

        $this->sendJsonResponse(404, [], 'Ruta no encontrada');
    }




    private function sendJsonResponse($statusCode,
        $data,
        $errorMessage = ''
    ) {
        if (!headers_sent()) {
            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: *');
        }
        http_response_code($statusCode);
        $response = ['error' => $errorMessage];
        if (!empty($data)) {
            $response['data'] = $data;
        }
        echo json_encode($response);
    }
}

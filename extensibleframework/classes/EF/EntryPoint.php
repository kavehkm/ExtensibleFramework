<?php
namespace EF;


class EntryPoint
{
    private $route;
    private $routes;
    private $method;

    public function __construct(string $route, Routes $routes, string $method)
    {
        $this->route = $route;
        $this->routes = $routes;
        $this->method = $method;
        $this->checkUrl();
    }

    private function checkUrl()
    {
        if ($this->route != strtolower($this->route)) {
            http_response_code(301);
            header('location: /?route=' . strtolower($this->route));
        }
    }

    private function loadTemplate($templateName, $variables = [])
    {
        extract($variables);
        ob_start();
        include __DIR__ . '/../../templates/' . $templateName;
        return ob_get_clean();
    }

    public function run()
    {
        // get routes
        $routes = $this->routes->getRoutes();
        // get authentication
        $authentication = $this->routes->getAuthentication();

        // check for authentication
        if (isset($routes[$this->route]['login']) && !$authentication->isLoggedIn()) {
            http_response_code(403);
            header('location: /?route=login/error');
        } else {

            $controller = $routes[$this->route][$this->method]['controller'];
            $action = $routes[$this->route][$this->method]['action'];

            $page = $controller->$action();

            $title = $page['title'];

            if (isset($page['variables'])) {
                $output = $this->loadTemplate($page['template'], $page['variables']);
            } else {
                $output = $this->loadTemplate($page['template']);
            }
            include __DIR__ . '/../../templates/layout.html.php';
        }
    }
}
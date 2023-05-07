<?php
class Routing
{
    /**
     * @var AltoRouter
     */
    private AltoRouter $router;

    /**
     * @param AltoRouter $router
     * @param string $strBasePath
     */
    public function __construct(AltoRouter $router, string $strBasePath = '')
    {
        // initiate router, and build routes
        $this->setRouter($router);
        $this->router->setBasePath($strBasePath);
        $this->buildRoutes();
    }

    /**
     * @return array
     */
    public function getMatch()
    {
        return $this->router->match();
    }

    /**
     * @param AltoRouter $router
     * @param string $strBasePath
     * @return array
     */
    public static function getMatchStatic(AltoRouter $router, string $strBasePath = '')
    {
        $routing = new Routing($router, $strBasePath);
        //var_dump($routing->getMatch());die;
        return $routing->getMatch();
    }

    /**
     *
     */
    private function buildRoutes()
    {
        //$this->router->map('GET|POST','/', 'homes#indsex', 'hosme');
        //$this->router->map('GET','/', 'home#index', 'home');
        //$this->router->map('GET','/', 'home#index', 'home');
        $this->router->map('GET','/', ['c' => 'home', 'a' => 'displayAction'], 'home');
        $this->router->map('POST','/', ['c' => 'home', 'a' => 'displayAction'], 'riddle_up');
        //echo '<pre>'; print_r($this->router); print_r($_POST);die;
        $this->router->map('POST','/users/[i:id]/[delete|update:action]', 'usersController#doAction', 'users_do');
        //$this->router->map('GET','/', ['c' => 'UserController', 'a' => 'ListAction']);
        $this->router->map('GET','/users/', array('c' => 'UserController', 'a' => 'ListAction'));
        //$this->router->map('GET','/home', 'home#indegx', ['c' => 'home', 'a' => 'displayAction']);
        $this->router->map('GET','/test', 'home#index', 'test');
        $this->router->map('GET','/users/[i:id]', 'users#show', 'users_show');
    }

    /**
     * @param AltoRouter $router
     */
    public function setRouter(AltoRouter $router)
    {
        $this->router = $router;
    }

    /**
     * @return mixed
     */
    public function getRouter(): AltoRouter
    {
        return $this->router;
    }
}
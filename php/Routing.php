<?php
class Routing
{
    /**
     * @var AltoRouter
     */
    private $objRouter;

    /**
     * @param AltoRouter $objRouter
     * @param string $strBasePath
     */
    public function __construct(AltoRouter $objRouter, string $strBasePath = '')
    {
        // initiate router, and build routes
        $this->setRouter($objRouter);
        $this->objRouter->setBasePath($strBasePath);
        $this->buildRoutes();
    }

    /**
     * @return array
     */
    public function getMatch()
    {
        return $this->objRouter->match();
    }

    /**
     * @param AltoRouter $objRouter
     * @param string $strBasePath
     * @return array
     */
    public static function getMatchStatic(AltoRouter $objRouter, string $strBasePath = '')
    {
        $objRouting = new Routing($objRouter, $strBasePath);
        //var_dump($objRouting->getMatch());die;
        return $objRouting->getMatch();
    }

    /**
     *
     */
    private function buildRoutes()
    {
        //$this->objRouter->map('GET|POST','/', 'homes#indsex', 'hosme');
        //$this->objRouter->map('GET','/', 'home#index', 'home');
        //$this->objRouter->map('GET','/', 'home#index', 'home');
        $this->objRouter->map('GET','/', ['c' => 'home', 'a' => 'displayAction'], 'home');
        $this->objRouter->map('POST','/', ['c' => 'home', 'a' => 'displayAction'], 'riddle_up');
        //echo '<pre>'; print_r($this->objRouter); print_r($_POST);die;
        $this->objRouter->map('POST','/users/[i:id]/[delete|update:action]', 'usersController#doAction', 'users_do');
        //$this->objRouter->map('GET','/', ['c' => 'UserController', 'a' => 'ListAction']);
        $this->objRouter->map('GET','/users/', array('c' => 'UserController', 'a' => 'ListAction'));
        //$this->objRouter->map('GET','/home', 'home#indegx', ['c' => 'home', 'a' => 'displayAction']);
        $this->objRouter->map('GET','/test', 'home#index', 'test');
        $this->objRouter->map('GET','/users/[i:id]', 'users#show', 'users_show');
    }

    /**
     * @param AltoRouter $objRouter
     */
    public function setRouter(AltoRouter $objRouter)
    {
        $this->objRouter = $objRouter;
    }

    /**
     * @return mixed
     */
    public function getRouter(): AltoRouter
    {
        return $this->objRouter;
    }
}
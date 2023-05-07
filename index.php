<?php
require_once 'php/ContentControllerInterface.php';
require_once 'php/lib/AltoRouter-master/AltoRouter.php';
require_once 'php/ParameterBag.php';
require_once 'php/Routing.php';

$router = new AltoRouter();

// $match = new ParameterBag(Routing::getMatchStatic($router, '/oger'));
$match = new ParameterBag(Routing::getMatchStatic($router));
$name = $match->getString('name', '');
$target = $match->getArray('target', []);
$controller = ParameterBag::getElementString($target, 'c', '');
$method = $match->getString('a', 'display') . 'Action';

// echo '<pre>'; var_dump($match); echo '</pre>';

// instantiate view object
require_once 'php/View.php';
$view = new View();

// load controller
$controller = ucwords($controller) . 'Controller';
$controllerPath = 'website/' . $name . '/' . $controller . '.php';
require_once $controllerPath;
$page = new $controller($view, $router);
$page->$method();

// get template
$templateName = 'jumbotron';
$templateName = 'bootstrap5';
$params = $page->getContent();
$params['page'] = $page;

// finalle get tamplate an output
$strTemplate = $view->render(__DIR__ . '/templates/' . $templateName . '/index.php', $params);
echo $strTemplate;

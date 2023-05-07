<?php
require_once 'php/lib/AltoRouter-master/AltoRouter.php';
require_once 'php/ParameterBag.php';
require_once 'php/Routing.php';

$router = new AltoRouter();

// $match = new ParameterBag(Routing::getMatchStatic($objRouter, '/oger'));
$match = new ParameterBag(Routing::getMatchStatic($router));
$name = $match->getString('name', '');
$target = $match->getArray('target', []);
$controller = ParameterBag::getElementString($target, 'c', '');
$method = $match->getString('a', 'display') . 'Action';

// echo '<pre>'; var_dump($match); echo '</pre>';

// instantiate view object
require_once 'php/View.php';
$objView = new View();

// load controller
$controller = ucwords($controller) . 'Controller';
$controllerPath = 'website/' . $name . '/' . $controller . '.php';
require_once $controllerPath;
$objPage = new $controller($objView, $router);
$objPage->$method();

// get template
$templateName = 'jumbotron';
$templateName = 'bootstrap5';
$params = $objPage->getContent();

// finalle get tamplate an output
$strTemplate = $objView->render(__DIR__ . '/templates/' . $templateName . '/index.php', $params);
echo $strTemplate;

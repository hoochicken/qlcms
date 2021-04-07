<?php
require_once 'php/lib/AltoRouter-master/AltoRouter.php';
require_once 'php/ParameterBag.php';
require_once 'php/Routing.php';

$objRouter = new AltoRouter();

// $objMatch = new ParameterBag(Routing::getMatchStatic($objRouter, '/oger'));
$objMatch = new ParameterBag(Routing::getMatchStatic($objRouter));
$strName = $objMatch->getString('name', '');
$arrTarget = $objMatch->getArray('target', []);
$strController = ParameterBag::getElementString($arrTarget, 'c', '');
$strMethod = $objMatch->getString('a', 'display') . 'Action';

// echo '<pre>'; var_dump($objMatch); echo '</pre>';

// instantiate view object
require_once 'php/View.php';
$objView = new View();

// load controller
$strController = ucwords($strController) . 'Controller';
$strControllerPath = 'website/' . $strName . '/' . $strController . '.php';
require_once $strControllerPath;
$objPage = new $strController($objView, $objRouter);
$objPage->$strMethod();

// get template
$strTemplateName = 'jumbotron';
$arrParams = $objPage->getContent();

// finalle get tamplate an output
$strTemplate = $objView->render(__DIR__ . '/templates/' . $strTemplateName . '/index.php', $arrParams);
echo $strTemplate;

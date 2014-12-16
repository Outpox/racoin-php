<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim(array(
    'mode' => 'development'
));

$loader = new Twig_Loader_Filesystem('template');
$twig = new Twig_Environment($loader);

$app->get('/', function () use ($twig) {
    $template = $twig->loadTemplate("main.html.twig");
    echo $template->render(array());
});

$app->run();

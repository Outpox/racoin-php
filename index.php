<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim(array(
    'mode' => 'development'
));

$loader = new Twig_Loader_Filesystem('template');
$twig = new Twig_Environment($loader);

$menu = array(
    array('href' => "./index.php",
        'text' => 'Acceuil'),
    array('href' => './#',
        'text' => 'Ville')
);

$app->get('/', function () use ($twig, $menu) {
    $template = $twig->loadTemplate("index.html.twig");
    echo $template->render(array("breadcrumb" => $menu));
});

$app->get('/item/', function () use ($twig, $menu) {
    $template = $twig->loadTemplate("item.html.twig");
    echo $template->render(array("breadcrumb" => $menu));
});

$app->run();

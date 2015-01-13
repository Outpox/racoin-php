<?php
require 'vendor/autoload.php';

use db\connection;

connection::createConn();

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

$chemin = dirname($_SERVER['SCRIPT_NAME']);

$app->get('/', function () use ($twig, $menu, $chemin) {
    $template = $twig->loadTemplate("index.html.twig");
    echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin));
});

$app->get('/item/:n', function () use ($twig, $menu, $chemin) {

});

$app->get('/add/', function () use ($twig, $menu, $chemin) {
    $template = $twig->loadTemplate("add.html.twig");
    echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin));
});

$app->get('/search/', function () use ($twig, $menu, $chemin) {
    $s = new controller\search();
    $s->show($twig, $menu, $chemin);
});

$app->post('/search/', function () use ($twig, $menu, $chemin) {

});

$app->run();

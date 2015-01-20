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

$app->post('/search/', function () use ($app) {
    /*$motclef = $app->request->post("motclef");
    $categorie = $app->request->post("categorie");
    $codepostal = $app->request->post("codepostal");
    $prixmin = $app->request->post("prix-min");
    $prixmax = $app->request->post("prix-max");

    $array = array( 0 => $motclef,
                    1 => $categorie,
                    2 => $codepostal,
                    3 => $prixmin,
                    4 => $prixmax);*/

    $array = $app->request->post();

    $s = new controller\search();
    $s->research($array);

});

$app->run();

<?php
require 'vendor/autoload.php';
use db\connection;
connection::createConn();


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
    $index = new \controller\index();
    $index->displayAllAnnonce($twig, $menu, $chemin);
});


$app->get('/item/:n', function ($n) use ($twig, $menu, $chemin) {
    $item= new \controller\item();
    $item->afficherItem($twig,$menu,$chemin,$n);
});

$app->get('/add/', function () use ($twig, $app, $menu, $chemin) {

    $ajout = new controller\addItem();
    $ajout->addItemView($twig, $menu, $chemin);

});

$app->post('/add/', function () use ($twig, $app, $menu, $chemin) {

    $allPostVars = $app->request->post();

    $ajout = new controller\addItem();
    $ajout->addNewItem($twig, $menu, $chemin, $allPostVars);

});

$app->get('/search/', function () use ($twig, $menu, $chemin) {
    $template = $twig->loadTemplate("search.html.twig");
    echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin));
});

$app->get('/annonceur/:n', function ($n) use ($twig, $menu, $chemin) {
    $annonceur = new controller\viewAnnonceur();
    $annonceur->afficherAnnonceur($twig, $menu, $chemin, $n);
});

$app->get('/del/:n', function ($n) use ($twig, $menu, $chemin) {
    $item = new controller\item();
    $item->supprimerItemGet($twig, $menu, $chemin, $n);
});

$app->post('/del/:n', function ($n) use ($twig, $menu, $chemin) {
    $item = new controller\item();
    $item->supprimerItemPost($twig, $menu, $chemin, $n);
});





$app->run();

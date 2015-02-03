<?php
require 'vendor/autoload.php';
use db\connection;

use Slim\Extras\Middleware\CsrfGuard;

use Illuminate\Database\Query\Expression as raw;
use model\Annonce;
use model\Categorie;
use model\Annonceur;
use model\Departement;


connection::createConn();


$app = new \Slim\Slim(array(
    'mode' => 'development'
));

session_start();
$app->add(new CsrfGuard());

$loader = new Twig_Loader_Filesystem('template');
$twig = new Twig_Environment($loader);

$menu = array(
    array('href' => "./index.php",
        'text' => 'Acceuil')
);

$chemin = dirname($_SERVER['SCRIPT_NAME']);

$cat = new \controller\getCategorie();
$dpt = new \controller\getDepartment();

$app->get('/', function () use ($twig, $menu, $chemin, $cat) {
    $index = new \controller\index();
    $index->displayAllAnnonce($twig, $menu, $chemin, $cat->getCategories());
});


$app->get('/item/:n', function ($n) use ($twig, $menu, $chemin, $cat) {
    $item= new \controller\item();
    $item->afficherItem($twig,$menu,$chemin,$n, $cat->getCategories());
});

$app->get('/add/', function () use ($twig, $app, $menu, $chemin, $cat, $dpt) {

    $ajout = new controller\addItem();
    $ajout->addItemView($twig, $menu, $chemin, $cat->getCategories(), $dpt->getAllDepartments());

});

$app->post('/add/', function () use ($twig, $app, $menu, $chemin, $cat) {

    $allPostVars = $app->request->post();

    $ajout = new controller\addItem();
    $ajout->addNewItem($twig, $menu, $chemin, $allPostVars, $cat->getCategories());

});

$app->get('/search/', function () use ($twig, $menu, $chemin, $cat) {
    $s = new controller\Search();
    $s->show($twig, $menu, $chemin, $cat->getCategories());
});


$app->post('/search/', function () use ($app, $twig, $menu, $chemin, $cat) {
    $array = $app->request->post();

    $s = new controller\Search();
    $s->research($array, $twig, $menu, $chemin, $cat->getCategories());

});

$app->get('/annonceur/:n', function ($n) use ($twig, $menu, $chemin, $cat) {
    $annonceur = new controller\viewAnnonceur();
    $annonceur->afficherAnnonceur($twig, $menu, $chemin, $n, $cat->getCategories());
});

$app->get('/del/:n', function ($n) use ($twig, $menu, $chemin) {
    $item = new controller\item();
    $item->supprimerItemGet($twig, $menu, $chemin, $n);
});

$app->post('/del/:n', function ($n) use ($twig, $menu, $chemin, $cat) {
    $item = new controller\item();
    $item->supprimerItemPost($twig, $menu, $chemin, $n, $cat->getCategories());
});

$app->get('/cat/:n', function ($n) use ($twig, $menu, $chemin, $cat) {
    $categorie = new controller\getCategorie();
    $categorie->displayCategorie($twig, $menu, $chemin, $cat->getCategories(), $n);
});

$app->group('/api', function () use ($app, $twig, $menu, $chemin, $cat)  {

    $app->group('/annonce', function () use ($app) {


        //GET
        $app->get('/', function() use ($app) {
            $annonceList = ['id_annonce','prix','titre','ville',new raw('CONCAT("/api/annonce/",id_annonce) as uri')];
            $app->response->headers->set('Content-Type', 'application/json');
            echo Annonce::all($annonceList)
                ->toJson();
        });
        $app->get('/:id', function($id) use ($app) {
            $annonceList = ['id_annonce','id_sous_categorie as categorie','id_annonceur as annonceur','id_departement as departement','prix','date','titre','description','ville'];
            $app->response->headers->set('Content-Type', 'application/json');
            $return =  Annonce::select($annonceList)->find($id);
            $return->categorie = Categorie::find($return->categorie);
            $return->annonceur = Annonceur::select('email','nom_annonceur','telephone')
                ->find($return->annonceur);
            $return->departement = Departement::select('id_departement','nom_departement')->find($return->departement);
            echo $return->toJson();
        });





    });

    $app->get('/key', function() use ($app, $twig, $menu, $chemin, $cat) {
        $kg = new controller\KeyGenerator();
        $kg->show($twig, $menu, $chemin, $cat->getCategories());
    });

    $app->post('/key', function() use ($app, $twig, $menu, $chemin, $cat) {
        $nom = $_POST['nom'];

        $kg = new controller\KeyGenerator();
        $kg->generateKey($twig, $menu, $chemin, $cat->getCategories(), $nom);
    });
});


$app->run();

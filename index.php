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

if (!isset($_SESSION)) {
    session_start();
    $_SESSION['formStarted'] = true;
}

if (!isset($_SESSION['token'])) {
    $token = md5(uniqid(rand(), TRUE));
    $_SESSION['token'] = $token;
    $_SESSION['token_time'] = time();
} else {
    $token = $_SESSION['token'];
}

//$app->add(new CsrfGuard());

$loader = new Twig_Loader_Filesystem('template');
$twig = new Twig_Environment($loader);

$menu = array(
    array('href' => "./index.php",
        'text' => 'Accueil')
);

$chemin = dirname($_SERVER['SCRIPT_NAME']);

$cat = new \controller\getCategorie();
$dpt = new \controller\getDepartment();

$app->get('/', function () use ($twig, $menu, $chemin, $cat) {
    $index = new \controller\index();
    $index->displayAllAnnonce($twig, $menu, $chemin, $cat->getCategories());
});


$app->get('/item/:n', function ($n) use ($twig, $menu, $chemin, $cat) {
    $item = new \controller\item();
    $item->afficherItem($twig, $menu, $chemin, $n, $cat->getCategories());
});

$app->get('/add/', function () use ($twig, $app, $menu, $chemin, $cat, $dpt) {

    $ajout = new controller\addItem();
    $ajout->addItemView($twig, $menu, $chemin, $cat->getCategories(), $dpt->getAllDepartments());

});

$app->post('/add/', function () use ($twig, $app, $menu, $chemin) {

    $allPostVars = $app->request->post();
    $ajout = new controller\addItem();
    $ajout->addNewItem($twig, $menu, $chemin, $allPostVars);
});

$app->get('/item/:id/edit', function ($id) use ($twig, $menu, $chemin) {
    $item = new \controller\item();
    $item->modifyGet($twig,$menu,$chemin, $id);
});

$app->post('/item/:id/edit', function ($id) use ($twig, $app, $menu, $chemin, $cat, $dpt) {
    $allPostVars = $app->request->post();
    $item= new \controller\item();
    $item->modifyPost($twig,$menu,$chemin, $id, $allPostVars, $cat->getCategories(), $dpt->getAllDepartments());
});

$app->map('/item/:id/confirm', function ($id) use ($twig, $app, $menu, $chemin) {
    $allPostVars = $app->request->post();
    $item = new \controller\item();
    $item->edit($twig,$menu,$chemin, $id, $allPostVars);
})->name('confirm')->via('GET', 'POST');

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

$app->get('/api(/)', function () use ($twig, $menu, $chemin, $cat) {
    $template = $twig->loadTemplate("api.html.twig");
    $menu = array(
        array('href' => $chemin,
            'text' => 'Acceuil'),
        array('href' => $chemin . '/api',
            'text' => 'Api')
    );
    echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin));
});

$app->group('/api', function () use ($app, $twig, $menu, $chemin, $cat) {

    $app->group('/annonce', function () use ($app) {

        $app->get('/:id', function ($id) use ($app) {
            $annonceList = ['id_annonce', 'id_categorie as categorie', 'id_annonceur as annonceur', 'id_departement as departement', 'prix', 'date', 'titre', 'description', 'ville'];
            $return = Annonce::select($annonceList)->find($id);

            if (isset($return)) {
                $app->response->headers->set('Content-Type', 'application/json');
                $return->categorie = Categorie::find($return->categorie);
                $return->annonceur = Annonceur::select('email', 'nom_annonceur', 'telephone')
                    ->find($return->annonceur);
                $return->departement = Departement::select('id_departement', 'nom_departement')->find($return->departement);
                $links = [];
                $links["self"]["href"] = "/api/annonce/" . $return->id_annonce;
                $return->links = $links;
                echo $return->toJson();
            } else {
                $app->notFound();
            }
        });
    });

    $app->group('/annonces(/)', function () use ($app) {

        $app->get('/', function () use ($app) {
            $annonceList = ['id_annonce', 'prix', 'titre', 'ville'];
            $app->response->headers->set('Content-Type', 'application/json');
            $a = Annonce::all($annonceList);
            $links = [];
            foreach ($a as $ann) {
                $links["self"]["href"] = "/api/annonce/" . $ann->id_annonce;
                $ann->links = $links;
            }
            $links["self"]["href"] = "/api/annonces/";
            $a->links = $links;
            echo $a->toJson();
        });
    });


    $app->group('/categorie', function () use ($app) {

        $app->get('/:id', function ($id) use ($app) {
            $app->response->headers->set('Content-Type', 'application/json');
            $a = Annonce::select('id_annonce', 'prix', 'titre', 'ville')
                ->where("id_categorie", "=", $id)
                ->get();
            $links = [];

            foreach ($a as $ann) {
                $links["self"]["href"] = "/api/annonce/" . $ann->id_annonce;
                $ann->links = $links;
            }

            $c = Categorie::find($id);
            $links["self"]["href"] = "/api/categorie/" . $id;
            $c->links = $links;
            $c->annonces = $a;
            echo $c->toJson();
        });
    });

    $app->group('/categories(/)', function () use ($app) {
        $app->get('/', function () use ($app) {
            $app->response->headers->set('Content-Type', 'application/json');
//            $c = Categorie::all(["id_categorie", "nom_categorie"]);
            $c = Categorie::get();
            $links = [];
            foreach ($c as $cat) {
                $links["self"]["href"] = "/api/categorie/" . $cat->id_categorie;
                $cat->links = $links;
            }
            $links["self"]["href"] = "/api/categories/";
            $c->links = $links;
            echo $c->toJson();
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

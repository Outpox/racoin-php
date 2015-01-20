<?php

namespace controller;

use db\connection;
use model\annonce;
use model\categorie;
use model\souscategorie;

class search {

    function show($twig, $menu, $chemin) {
        $template = $twig->loadTemplate("search.html.twig");
        echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin));
    }

    function research($array) {
        print_r($array);
        connection::createConn();

        $annonce = new annonce();
        $categorie = new categorie();
        $sscategorie = new souscategorie();


    }
}

?>
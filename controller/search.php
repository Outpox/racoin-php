<?php

namespace controller;

use db\connection;
use model\annonce;
use model\categorie;
use model\departement;
use model\souscategorie;

class search {

    function show($twig, $menu, $chemin) {
        $template = $twig->loadTemplate("search.html.twig");
        echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin));
    }

    function research($array) {
        print_r($array);
        connection::createConn();

        // motclef = annonce -> titre
        // motclef = annonce -> description
        // categorie = categorie sous-categ -> categ
        // codepostal = departement -> nom_departement
        // prix = annonce

        $annonce = new annonce();
        $categorie = new categorie();
        $sscategorie = new souscategorie();
        $departement = new departement();


        // Trier les annonces avec le prix

        // Trier avec la catégorie


    }
}

?>
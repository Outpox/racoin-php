<?php

namespace controller;

use db\connection;
use model\Annonce;

class Search {

    function show($twig, $menu, $chemin) {
        $template = $twig->loadTemplate("search.html.twig");
        echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin));
    }

    function research($array) {
        print_r($array);
        connection::createConn();

        $annonce = Annonce::find(1);
        echo $annonce;


        // motclef = annonce -> titre
        // motclef = annonce -> description
        // categorie = categorie sous-categ -> categ
        // codepostal = departement -> nom_departement
        // prix = annonce
        // Trier les annonces avec le prix
        // Trier avec la catégorie


    }
}

?>
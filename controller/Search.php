<?php

namespace controller;

use model\Annonce;

class Search {

    function show($twig, $menu, $chemin) {
        $template = $twig->loadTemplate("search.html.twig");
        echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin));
    }

    function research($array) {
        //print_r($array);

        // motclef = annonce -> titre
        // motclef = annonce -> description
        // categorie = categorie sous-categ -> categ
        // codepostal = departement -> nom_departement
        // prix = annonce

        // Trier les annonces avec le prix
        foreach(Annonce::all() as $annonce) {
            if( ($annonce->prix >= $array['prix-min']) && ($annonce->prix <= $array['prix-max']))
                echo $annonce->prix."<br/>";
        }
        // Trier avec la catégorie


    }
}

?>
<?php

namespace controller;

use model\Annonce;
use model\SousCategorie;

class Search {

    function show($twig, $menu, $chemin, $cat) {
        $template = $twig->loadTemplate("search.html.twig");
        $menu = array(
            array('href' => $chemin,
                'text' => 'Acceuil'),
            array('href' => $chemin."/search",
                'text' => "Recherche")
        );
        echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin, "categories" => $cat));
    }

    function research($array, $twig, $menu, $chemin, $cat) {
        $template = $twig->loadTemplate("index.html.twig");
        $menu = array(
            array('href' => $chemin,
                'text' => 'Acceuil'),
            array('href' => $chemin."/search",
                'text' => "Résultats de la recherche")
        );

        $nospace_mc = str_replace(' ', '', $array['motclef']);
        $nospace_cp = str_replace(' ', '', $array['codepostal']);

        $ltannonce = array();
        // Si tout est vide on affiche tout
        if( (($nospace_mc === "") && ($nospace_cp === "")) &&
            (($array['categorie'] === "Toutes catégories" || $array['categorie'] === "-----")) &&
            ($array['prix-min'] === "Min") &&
            ($array['prix-max'] === "Max")) {

            foreach(Annonce::all() as $annonce) {
                array_push($ltannonce, $annonce);
            }
            //affiche tout
        } else {
            foreach(Annonce::all() as $annonce) {
                // Test si annonce est dans la bonne tranche de prix
                if( (($annonce->prix >= $array['prix-min']) && ($annonce->prix <= $array['prix-max'])) ||
                    (($annonce->prix >= $array['prix-min']) && ($array['prix-max'] === "Max")) ||
                    (($array['prix-min'] === "Min") && ($annonce->prix <= $array['prix-max'])) ||
                    (($array['prix-min'] === "Min") && ($array['prix-max'] === "Max")) ) {

                    // Test si annonce est dans la bonne ville
                    if( ($annonce->ville === $array['codepostal']) || ($nospace_cp === "") ) {

                        // Test si annonce comprend motclef dans le titre ou la description
                        $title = stripos($annonce->titre, $array['motclef']);
                        $desc = stripos($annonce->description, $array['motclef']);

                        if( (($title !== false) || ($desc !== false)) || ($nospace_mc === "") ) {

                            // Test si l'annonce est dans la bonne categorie
                            $sscateg = SousCategorie::find($annonce->id_sous_categorie);
                            if ( ($sscateg->id_categorie === $array['categorie']) || (($array['categorie'] === "Toutes catégories" || $array['categorie'] === "-----")) ) {
                                array_push($ltannonce, $annonce);
                            }
                        }

                    }
                }
            }
        }

        echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin, "annonces" => $ltannonce, "categories" => $cat));
    }
}

?>
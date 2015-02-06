<?php

namespace controller;

use model\Annonce;
use model\Categorie;

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


        $query = Annonce::select();

        if( ($nospace_mc === "") &&
            ($nospace_cp === "") &&
            (($array['categorie'] === "Toutes catégories" || $array['categorie'] === "-----")) &&
            ($array['prix-min'] === "Min") &&
            ( ($array['prix-max'] === "Max") || ($array['prix-max'] === "nolimit") ) ) {
            $annonce = Annonce::all();

        } else {
            // A REFAIRE SEPARER LES TRUCS
            if( ($nospace_mc !== "") ) {
                $query->where('description', 'like', '%'.$array['motclef'].'%');
            }

            if( ($nospace_cp !== "") ) {
                $query->where('ville', '=', $array['codepostal']);
            }

            if ( ($array['categorie'] !== "Toutes catégories" && $array['categorie'] !== "-----") ) {
                $categ = Categorie::select('id_categorie')->where('id_categorie', '=', $array['categorie'])->first()->id_categorie;
                $query->where('id_categorie', '=', $categ);
            }

            if ( $array['prix-min'] !== "Min" && $array['prix-max'] !== "Max") {
                if($array['prix-max'] !== "nolimit") {
                    $query->whereBetween('prix', array($array['prix-min'], $array['prix-max']));
                } else {
                    $query->where('prix', '>=', $array['prix-min']);
                }
            } elseif ( $array['prix-max'] !== "Max" && $array['prix-max'] !== "nolimit") {
                $query->where('prix', '<=', $array['prix-max']);
            } elseif ( $array['prix-min'] !== "Min" ) {
                $query->where('prix', '>=', $array['prix-min']);
            }

            $annonce = $query->get();
        }

        echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin, "annonces" => $annonce, "categories" => $cat));

    }

}

?>
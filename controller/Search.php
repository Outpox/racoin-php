<?php

namespace controller;

use model\Annonce;
use model\SousCategorie;

class Search {

    function show($twig, $menu, $chemin) {
        $template = $twig->loadTemplate("search.html.twig");
        echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin));
    }

    function research($array, $twig, $menu, $chemin) {
        //print_r($array);
        $template = $twig->loadTemplate("searchresult.html.twig");

        $nospace_mc = str_replace(' ', '', $array['motclef']);
        $nospace_cp = str_replace(' ', '', $array['codepostal']);

        /*echo "mc : ".($nospace_mc === "")."</br>";
        echo "cp : ".($nospace_cp === "")."</br>";
        echo "categ : ".($array['categorie'] === "Toutes catégories" || $array['categorie'] === "-----")."</br>";
        echo "p min : ".($array['prix-min'] === "Min")."</br>";
        echo "p max : ".($array['prix-max'] === "Max")."</br>";*/

        $ltannonce = array();
        // Si tout est vide on affiche tout
        if( (($nospace_mc === "") && ($nospace_cp === "")) &&
            (($array['categorie'] === "Toutes catégories" || $array['categorie'] === "-----")) &&
            ($array['prix-min'] === "Min") &&
            ($array['prix-max'] === "Max")) {

            foreach(Annonce::all() as $annonce) {
                array_push($ltannonce, $annonce);
                //$ltannonce .= $annonce;
            }
            //affiche tout
        } else {
            // Affiche résultat de la recherche
            $recherche = array();
            $nb = 0;
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
                            $sscateg = SousCategorie::find($annonce->id_sous_categorie); // $array['categorie']
                            if ( ($sscateg->id_categorie === $array['categorie']) || (($array['categorie'] === "Toutes catégories" || $array['categorie'] === "-----")) ) {
                                //$ltannonce .= $annonce;
                                //$recherche[$nb] = $annonce;
                                //$nb++;
                            }
                        }

                    }
                }
                //echo $recherche[$nb]."<br/><br/>";
            }

            foreach($recherche as $value) {
                // afficher la recherche
            }
        }

        //echo $ltannonce[0];
        //echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin));
        //$template->display( array('liste_annonce' => $ltannonce));
    }
}

?>
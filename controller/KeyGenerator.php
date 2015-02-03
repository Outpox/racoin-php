<?php

namespace controller;

use model\ApiKey;

class KeyGenerator {

    function show($twig, $menu, $chemin, $cat) {
        $template = $twig->loadTemplate("key-generator.html.twig");
        $menu = array(
            array('href' => $chemin,
                'text' => 'Acceuil'),
            array('href' => $chemin."/search",
                'text' => "Recherche")
        );
        echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin, "categories" => $cat));
    }

    function generateKey($twig, $menu, $chemin, $cat, $nom) {
        $nospace_nom = str_replace(' ', '', $nom);

        if($nospace_nom === '') {
            $template = $twig->loadTemplate("key-generator-error.html.twig");
            $menu = array(
                array('href' => $chemin,
                    'text' => 'Acceuil'),
                array('href' => $chemin."/search",
                    'text' => "Recherche")
            );

            echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin, "categories" => $cat));
        } else {
            $template = $twig->loadTemplate("key-generator-result.html.twig");
            $menu = array(
                array('href' => $chemin,
                    'text' => 'Acceuil'),
                array('href' => $chemin."/search",
                    'text' => "Recherche")
            );

            // Génere clé unique de 13 caractères
            $key = uniqid();
            // Ajouter clé dans la base
            $apikey = new ApiKey();

            $apikey->id_apikey = $key;
            $apikey->name_key = htmlentities($nom);
            $apikey->save();

            echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin, "categories" => $cat, "key" => $key));
        }

    }

}

?>
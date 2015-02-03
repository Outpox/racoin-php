<?php

namespace controller;

class KeyGenerator {

    function show($twig, $chemin) {
        $template = $twig->loadTemplate("key-generator.html.twig");
        $menu = array(
            array('href' => $chemin,
                'text' => 'Acceuil'),
            array('href' => $chemin."/search",
                'text' => "Recherche")
        );
        echo $template->render(array("chemin" => $chemin, "categories" => $cat));
    }
}

?>
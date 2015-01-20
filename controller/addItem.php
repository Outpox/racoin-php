<?php

namespace controller;

use model\annonce;

class addItem{

    function addItemView($twig, $menu, $chemin){

        $template = $twig->loadTemplate("add.html.twig");
        echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin));

    }

    function addNewItem($twig, $menu, $chemin, $allPostVars){

        $annonce = new Annonce();

        $template = $twig->loadTemplate("add.html.twig");
        echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin));

    }
}
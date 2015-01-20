<?php

namespace controller;

class addItem{

    function addItem($twig, $menu, $chemin){


        $template = $twig->loadTemplate("add.html.twig");
        echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin));
    }
}
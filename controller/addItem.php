<?php

namespace controller;

class addItem{

    function addItem($twig){
        $template = $twig->loadTemplate("add.html.twig");
        echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin));
    }
}
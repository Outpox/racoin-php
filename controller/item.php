<?php
/**
 * Created by PhpStorm.
 * User: ponicorn
 * Date: 13/01/15
 * Time: 16:56
 */

namespace controller;
class item {
    public function __construct(){
    }
    function afficherItem($twig, $menu, $chemin,$n) {
        $template = $twig->loadTemplate("item.html.twig");
        echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin));
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: ponicorn
 * Date: 22/01/15
 * Time: 20:17
 */

namespace controller;
use model\Annonceur;


class view_annonceur {
    public function __construct(){
    }
    function afficherAnnonceur($twig, $menu, $chemin,$n){
        $this->annonceur = annonceur::find($n);
        $template = $twig->loadTemplate("annonceur.html.twig");
        echo $template->render(array("breadcrumb" => $menu,
            "chemin" => $chemin,
            "annonceur" => $this->annonceur));
    }
}
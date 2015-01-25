<?php
/**
 * Created by PhpStorm.
 * User: ponicorn
 * Date: 26/01/15
 * Time: 00:25
 */

namespace controller;
use model\annonce;
use model\annonceur;

class viewAnnonceur {
    public function __construct(){
    }
    function afficherAnnonceur($twig, $menu, $chemin,$n) {
        $this->annonceur = annonceur::find($n);
        $template = $twig->loadTemplate("annonceur.html.twig");
        echo $template->render(array('test' => 'lel',
            "chemin" => $chemin));
    }
}
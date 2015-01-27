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
//        $this->annonces = annonce::where('id_annonceur','=',$n)->get();
        $this->annonces = annonce::join('photo','photo.id_annonce','=','annonce.id_annonce')
                ->where('annonce.id_annonceur','=',$n)
                ->get();
        $template = $twig->loadTemplate("annonceur.html.twig");
        echo $template->render(array('nom' => $this->annonceur,
            "chemin" => $chemin,
            "annonces" => $this->annonces));
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: ponicorn
 * Date: 13/01/15
 * Time: 16:56
 */

namespace controller;
use model\annonce;
use model\annonceur;
use model\departement;
use model\photo;
class item {
    public function __construct(){
    }
    function afficherItem($twig, $menu, $chemin,$n) {
        $this->annonce = annonce::find($n);
        $this->annonceur = annonceur::find($this->annonce->id_annonceur);
        $this->departement = departement::find($this->annonce->id_departement );
        $this->photo = photo::where('id_annonce', '=', $n)->get();
        $template = $twig->loadTemplate("item.html.twig");
        echo $template->render(array("breadcrumb" => $menu,
            "chemin" => $chemin,
            "annonce" => $this->annonce,
            "annonceur" => $this->annonceur,
            "dep" => $this->departement->nom_departement,
            "photo" => $this->photo));
//        echo $this->photo->first();
    }


}

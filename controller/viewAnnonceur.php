<?php
/**
 * Created by PhpStorm.
 * User: ponicorn
 * Date: 26/01/15
 * Time: 00:25
 */

namespace controller;
use model\Annonce;
use model\Annonceur;
use model\Photo;

class viewAnnonceur {
    public function __construct(){
    }
    function afficherAnnonceur($twig, $menu, $chemin, $n, $cat) {
        $this->annonceur = annonceur::find($n);
        if(!isset($this->annonceur)){
            echo "404";
            return;
        }
        $tmp = annonce::where('id_annonceur','=',$n)->get();

        $annonces = [];
        foreach ($tmp as $a) {
            $a->nb_photo = Photo::where('id_annonce', '=', $a->id_annonce)->count();
            if($a->nb_photo>0){
                $a->url_photo = Photo::select('url_photo')
                    ->where('id_annonce', '=', $a->id_annonce)
                    ->first()->url_photo;
            }else{
                $a->url_photo = $chemin.'/img/noimg.png';
            }

            $annonces[] = $a;
        }
        $template = $twig->loadTemplate("annonceur.html.twig");
        echo $template->render(array('nom' => $this->annonceur,
            "chemin" => $chemin,
            "annonces" => $annonces,
            "categories" => $cat));
    }
}
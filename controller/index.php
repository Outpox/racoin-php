<?php

namespace controller;

use model\Annonce;
use model\Photo;
use model\Annonceur;

class index {
    protected $annonce = array();

    public function getAll($chemin) {
//        foreach (Annonce::with("Annonceur")->orderBy('id_annonce', 'desc')->take(12)->get(array('id_annonce', 'id_annonceur', 'id_sous_categorie', 'id_departement', 'prix', 'date', 'titre', 'ville')) as $a) {
//            array_push($this->annonce, $a->toArray());
//        }
        $tmp = Annonce::with("Annonceur")->orderBy('id_annonce','desc')->take(12)->get();
        $annonce = [];
        foreach($tmp as $t) {
            $t->nb_photo = Photo::where("id_annonce", "=", $t->id_annonce)->count();
            if($t->nb_photo > 0){
                $t->url_photo = Photo::select("url_photo")
                    ->where("id_annonce", "=", $t->id_annonce)
                    ->first()->url_photo;
            }else{
                $t->url_photo = $chemin.'/img/noimg.png';
            }
            $t->nom_annonceur = Annonceur::select("nom_annonceur")
                ->where("id_annonceur", "=", $t->id_annonceur)
                ->first()->nom_annonceur;
            array_push($annonce, $t);
        }
        $this->annonce = $annonce;
    }

    public function displayAllAnnonce($twig, $menu, $chemin, $cat) {
        $template = $twig->loadTemplate("index.html.twig");
        $menu = array(
            array('href' => $chemin,
                'text' => 'Acceuil'),
        );

        $this->getAll($chemin);
        echo $template->render(array(
            "breadcrumb" => $menu,
            "chemin" => $chemin,
            "categories" => $cat,
            "annonces" => $this->annonce));
    }
}
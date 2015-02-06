<?php

namespace controller;

use model\Categorie;
use model\Annonce;
use model\Photo;
use model\Annonceur;

class getCategorie {

    protected $categories = array();

    public function getCategories() {
        return Categorie::orderBy('nom_categorie')->get()->toArray();
    }

    public function getCategorieContent($chemin, $n) {
        $tmp = Annonce::with("Annonceur")->orderBy('id_annonce','desc')->where('id_categorie', "=", $n)->get();
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

    public function displayCategorie($twig, $menu, $chemin, $cat, $n) {
        $template = $twig->loadTemplate("index.html.twig");
        $menu = array(
            array('href' => $chemin,
                'text' => 'Acceuil'),
            array('href' => $chemin."/cat/".$n,
                'text' => Categorie::find($n)->nom_categorie)
        );

        $this->getCategorieContent($chemin, $n);
        echo $template->render(array(
            "breadcrumb" => $menu,
            "chemin" => $chemin,
            "categories" => $cat,
            "annonces" => $this->annonce));
    }
}
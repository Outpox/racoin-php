<?php

namespace controller;

use model\Annonce;
use model\Annonceur;

require './kint/Kint.class.php';

class index {
    protected $annonce = array();

    public function getAll() {
        foreach (Annonce::with("Annonceur")->get(array('id_annonce', 'id_annonceur', 'id_sous_categorie', 'id_departement', 'prix', 'date', 'titre', 'ville')) as $a) {
            array_push($this->annonce, $a->toArray());
        }
    }

    public function displayAllAnnonce($twig, $menu, $chemin) {
        $template = $twig->loadTemplate("index.html.twig");
        $menu = array(
            array('href' => "./index.php",
                'text' => 'Acceuil'),
        );
        $this->getAll();
        echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin, "annonces" => $this->annonce));
    }
}
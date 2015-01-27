<?php

namespace controller;

use model\Categorie;

class getCategorie {

    protected $categories = array();

    public function getCategories() {
        return Categorie::orderBy('nom_categorie')->get()->toArray();
    }

    public function getCategorieContent($cat) {
        
    }

    public function displayCategorie($twig, $menu, $chemin, $cat) {

    }
}
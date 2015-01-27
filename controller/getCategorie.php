<?php

namespace controller;

use model\Categorie;

class getCategorie {

    public function getAll() {
        return Categorie::orderBy('nom_categorie')->get()->toArray();
    }

}
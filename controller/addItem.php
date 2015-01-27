<?php

namespace controller;

use model\Annonce;
use model\Annonceur;

class addItem{

    function addItemView($twig, $menu, $chemin){

        $template = $twig->loadTemplate("add.html.twig");
        echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin));

    }

    function addNewItem($twig, $menu, $chemin, $allPostVars){
        date_default_timezone_set('Europe/Paris');

        $annonce = new Annonce();
        $annonceur = new Annonceur();

        $annonceur->email = $allPostVars['email'];
        $annonceur->nom_annonceur = $allPostVars['nom'];
        $annonceur->telephone = $allPostVars['phone'];

        $annonce->prix = $allPostVars['price'];
        $annonce->mdp = password_hash ($allPostVars['psw'], PASSWORD_DEFAULT);
        $annonce->titre = $allPostVars['title'];
        $annonce->description = $allPostVars['description'];
        $annonce->id_sous_categorie = $allPostVars['categorie'];
        $annonce->date = date('Y-m-d');

        $annonceur->save();
        $annonceur->annonce()->save($annonce);

        $template = $twig->loadTemplate("add.html.twig");
        echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin));

    }
}
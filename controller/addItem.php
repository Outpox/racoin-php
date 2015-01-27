<?php

namespace controller;

use model\Annonce;
use model\Annonceur;

class addItem{

    function addItemView($twig, $menu, $chemin, $cat){

        $template = $twig->loadTemplate("add.html.twig");
        $menu = array(
            array('href' => $chemin,
                'text' => 'Acceuil'),
            array('href' => $chemin."/add",
                'text' => "Ajouter une nouvelle annonce")
        );
        echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin, "categories" => $cat));

    }

    function addNewItem($twig, $menu, $chemin, $allPostVars, $cat){
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
        $annonceur->Annonce()->save($annonce);

        $template = $twig->loadTemplate("add.html.twig");
        $menu = array(
            array('href' => $chemin,
                'text' => 'Acceuil'),
            array('href' => $chemin."/add",
                'text' => "Ajouter une nouvelle annonce")
        );
        echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin, "categorie" => $cat));

    }
}
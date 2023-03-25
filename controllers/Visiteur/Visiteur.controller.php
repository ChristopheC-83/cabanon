<?php

require_once("./controllers/MainController.controller.php");
require_once("./models/Visiteur/Visiteur.model.php");

class VisiteurController extends MainController
{

    private $visiteurManager;

    public function __construct()
    {
        $this->visiteurManager = new VisiteurManager();
    }

    public function accueil()
    {
        $data_page = [
            "page_title" => "Cabanon et Musique",
            "page_description" => "Cabanon, groupe de musique, concert et évènements",
            "view" => "views/Visiteur/accueil.view.php",
            "template" => "views/commons/template.php",
            "css" => "accueil",
            "js"=>['app.js']
        ];

        $this->genererPage($data_page);
    }

    public function membres()
    {
        // ce tableau montre qu'on peut rajouter ce qu'on veut en variable !
        $data_page = [
            "page_title" => "Cabanon et Musique",
            "page_description" => "Les membres de Cabanon",
            "view" => "views/Visiteur/membres.view.php",
            "template" => "views/commons/template.php",
            "css" => "membres",
            "js" => ["app.js"]

        ];

        $this->genererPage($data_page);
    }

    public function galerie()
    {
        $data_page = [
            "page_title" => "Cabanon et Musique",
            "page_description" => "Galerie Photos",
            "view" => "views/Visiteur/galerie.view.php",
            "template" => "views/commons/template.php",
            "css" => "galerie",
            "js" => ["app.js"]

        ];

        $this->genererPage($data_page);
    }

    public function pageErreur($msg)
    {
        // ici, pas besoin d'un affichage spécifique, nous reprenons l'affichage de la classe parent.
        parent::pageErreur($msg);
    }
    public function login()
    {
        $data_page = [
            "page_title" => "Page de connexion",
            "page_description" => "Page de connexion du site",
            "view" => "views/Visiteur/login.view.php",
            "template" => "views/commons/template.php",
            "css" => "containerConnexion",
            "js"=>['app.js']
        ];

        $this->genererPage($data_page);
    }

    public function creerCompte()
    {
        $data_page = [
            "page_title" => "Page de création de compte",
            "page_description" => "Page de création de compte",
            "view" => "views/Visiteur/creerCompte.view.php",
            "template" => "views/commons/template.php",
            "css" => "containerCreation containerConnexion",
            "js"=>['app.js']
        ];

        $this->genererPage($data_page);
    }
}

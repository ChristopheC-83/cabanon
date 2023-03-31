<?php

require_once("./controllers/MainController.controller.php");
require_once("./models/Administrateur/Administrateur.model.php");

class AdministrateurController extends MainController
{

    private $administrateurManager;

    public function __construct()
    {
        $this->administrateurManager = new AdministrateurManager();
    }

    public function pageErreur($msg)
    {
        // ici, pas besoin d'un affichage spécifique, nous reprenons l'affichage de la classe parent.
        parent::pageErreur($msg);
    }

    public function droits()
    {

        $utilisateurs = $this->administrateurManager->getUtilisateurs();

        $data_page = [
            "page_title" => "Page d'administration",
            "page_description" => "Description de la page d'admin",
            "view" => "views/Administrateur/droits.view.php",
            "template" => "views/commons/template.php",
            "utilisateurs" => $utilisateurs,
            "css" => "droits",
            "js" => ['app.js', 'admin.js'],
        ];

        $this->genererPage($data_page);
    }
    public function validation_modificationValidation($login, $validation)
    {
        if ($this->administrateurManager->bdModificationValidationUser($login, $validation)) {
            Toolbox::ajouterMessageAlerte("Modification validation effectuée.", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("Modification validation n'est pas effectuée.", Toolbox::COULEUR_ROUGE);
        }
        header("Location:" . URL . "administration/droits");
    }
    public function validation_modificationRole($login, $role)
    {
        if ($this->administrateurManager->bdModificationRoleUser($login, $role)) {
            Toolbox::ajouterMessageAlerte("Modification role effectuée.", Toolbox::COULEUR_VERTE);
            header("Location:" . URL . "administration/droits");
        } else {
            Toolbox::ajouterMessageAlerte("Modification role n'est pas effectuée.", Toolbox::COULEUR_ROUGE);
        }
        header("Location:" . URL . "administration/droits");
    }

    public function exchange()
    {

        $musiques = $this->administrateurManager->getMusiques();
        $utilisateurs = $this->administrateurManager->getUtilisateurs();

        $data_page = [
            "page_title" => "Page des échanges de fichiers",
            "page_description" => "Page des échanges de fichiers",
            "view" => "views/Administrateur/exchange.view.php",
            "template" => "views/commons/template.php",
            "musiques" => $musiques,
            "utilisateurs" => $utilisateurs,
            "css" => "exchange",
            "js" => ['app.js', 'admin.js', 'exchange.js'],
        ];

        $this->genererPage($data_page);
    }

    public function validation_ajoutfichier()
    {
        $file = $_POST; // infos du formulaire
        $file2 = $_FILES['fichier']; // infos du fichier
        // $repertoire = "public/assets/musiques/" . $_POST['nom_projet'];

        // A garder pour test !
        // echo "<pre>";
        // print_r($file);
        // print_r($file2);
        // print_r("public/assets/musiques/".$_POST['nom_projet']);
        // echo "</pre>";

        try {

            if (
                // enregistrement fichier
                $this->administrateurManager->ajoutMusique($_FILES['fichier'],  "public/assets/musiques/" . $_POST['nom_projet'])

                &&
                // Envoi données phpMyAdmin
                $this->administrateurManager->bdAjoutFichier($_FILES['fichier']['name'], $_POST['nom_projet'], $_POST['instru'], $_POST['date_depot'], $_POST['commentaire'])
            ) {
                Toolbox::ajouterMessageAlerte("Le fichier est enregistré !  😍 ", Toolbox::COULEUR_VERTE);
            } else {
                Toolbox::ajouterMessageAlerte("L'enregistrement n'a pas été effectué 💀", Toolbox::COULEUR_ROUGE);
            }
        } catch (Exception $e) {
            Toolbox::ajouterMessageAlerte($e->getMessage(), Toolbox::COULEUR_ROUGE);
        }
        header('Location:' . URL . 'administration/exchange');
    }

    public function supprimerFichier($id)
    {
        $fichier = $this->administrateurManager->getFichierById($id);
        unlink("public/assets/musiques/" . $fichier['nom_projet'] . "_" . $fichier['nom_fichier']);

        if ($this->administrateurManager->suppressionFichierBd($id)) {
            Toolbox::ajouterMessageAlerte("Suppression base de données OK.", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("Echec de la supression. Contacter votre administrateur", Toolbox::COULEUR_ROUGE);
        }
        header("Location:" . URL . "administration/exchange");
    }
    public function modifierFichier($id)
    {
        $fichier = $this->administrateurManager->getFichierById($id);

        $data_page = [
            "page_title" => "Page de modification de " . $fichier['nom_fichier'] . " / " . $fichier['nom_projet'],
            "page_description" => "Page de modification de " . $fichier['nom_fichier'] . " / " . $fichier['nom_projet'],
            "view" => "views/Administrateur/modifFichier.view.php",
            "template" => "views/commons/template.php",
            "css" => "modifFichier",
            "js" => ['app.js', 'modifFichier.js'],
            "fichier" => $fichier,
        ];

        $this->genererPage($data_page);
    }
    public function validation_modifierFichier($id, $new_projet, $new_instru, $new_commentaires)
    {
        // echo("validation modif "."  ".$id ." , ".$new_projet." , ". $new_instru." , ". $new_commentaires);
        $fichier = $this->administrateurManager->getFichierById($id);

        $ancien_nom = $fichier['nom_projet'] . "_" . $fichier['nom_fichier'];
        $nouveau_nom = $new_projet . "_" . $fichier['nom_fichier'];
        $ancien_nom_path =  "public/assets/musiques/" . $ancien_nom;
        $nouveau_nom_path = "public/assets/musiques/" . $nouveau_nom;

        print_r($fichier);

        if (
            $this->administrateurManager->bdModifierFichier($id, $new_projet, $new_instru, $new_commentaires)
            &&
            (rename($ancien_nom_path, $nouveau_nom_path))

        ) {
            Toolbox::ajouterMessageAlerte("Mise à jour du fichier effectuée.", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("Echec de la mise à jour ".$ancien_nom_path.$nouveau_nom_path, Toolbox::COULEUR_ROUGE);
        }

        header('Location:' . URL . 'administration/exchange');

    }
}

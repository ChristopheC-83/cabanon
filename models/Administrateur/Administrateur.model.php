<?php
require_once("./models/MainManager.model.php");

class AdministrateurManager extends MainManager
{

    public function getUtilisateurs()
    {
        $req = $this->getBdd()->prepare("SELECT * FROM utilisateur");
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $datas;
    }
    public function bdModificationValidationUser($login, $est_valide)
    {
        $req = "UPDATE utilisateur set est_valide= :est_valide WHERE login = :login";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":est_valide", $est_valide, PDO::PARAM_INT);
        $stmt->execute();
        $estModifie = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifie;
    }
    public function bdModificationRoleUser($login, $role)
    {
        $req = "UPDATE utilisateur set role= :role WHERE login = :login";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":role", $role, PDO::PARAM_STR);
        $stmt->execute();
        $estModifie = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifie;
    }

    public function getMusiques()
    {
        $req = $this->getBdd()->prepare("SELECT * FROM ZikExchange");
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $datas;
    }

    public function getFichierById($id)
    {
        $getMusiques = $this->getMusiques();

        // echo "<pre>";
        // print_r($getMusiques);
        // echo "</pre>";
        // unlink();
        foreach ($getMusiques as $fichier) {
            if ($fichier['id'] == $id) {
                // echo( "c'est : ".$fichier['nom_fichier']." dont l'id est : ".$fichier['id']);
                return $fichier;
            }
            // throw new Exception("Le fichier n'existe pas !!!!!");
        }
    }

    public function bdAjoutFichier($nom_fichier, $nom_projet, $instru, $date_depot, $commentaire)
    {
        $req = "INSERT INTO ZikExchange (nom_fichier, nom_projet, instru, date_depot, commentaire)
        VALUES(:nom_fichier, :nom_projet, :instru, :date_depot, :commentaire)
        ";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":nom_fichier", $nom_fichier, PDO::PARAM_STR);
        $stmt->bindValue(":nom_projet", $nom_projet, PDO::PARAM_STR);
        $stmt->bindValue(":instru", $instru, PDO::PARAM_STR);
        $stmt->bindValue(":date_depot", $date_depot, PDO::PARAM_STR);
        $stmt->bindValue(":commentaire", $commentaire, PDO::PARAM_STR);
        $stmt->execute();
        $estModifie = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifie;  //retourne si la requête a fonctionné ou pas

    }

    public function ajoutMusique($file, $dir)
    {
        if (!isset($file['name']) || empty($file['name']))
            throw new Exception("Vous devez indiquer un fichier");


        // $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        // $random = rand(0, 999);
        $target_file = $dir . "_" . $file['name'];

        // if (!getimagesize($file["tmp_name"]))
        //     throw new Exception("Le fichier n'est pas une image");
        // if ($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
        //     throw new Exception("L'extension du fichier n'est pas reconnu");
        // if (file_exists($target_file))
        //     throw new Exception("Le fichier existe déjà");
        if ($file['size'] > 100000000)
            throw new Exception("Le fichier est trop gros (limite 100 Mo");
        if (!move_uploaded_file($file['tmp_name'], $target_file))
            throw new Exception("l'ajout du fichier n'a pas fonctionné");
        else return ($file['name']);
    }

    public function suppressionFichierBd($id)
    {
        $req = "DELETE FROM ZikExchange WHERE id = :id";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $estModifie = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifie;
    }

    public function bdModifierFichier($id, $new_projet, $new_instru, $new_commentaires)
    {
        $req = "UPDATE ZikExchange set  nom_projet = :nom_projet, commentaire=:commentaire, instru=:instru WHERE id= :id" ;
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":nom_projet", $new_projet, PDO::PARAM_STR);
        $stmt->bindValue(":instru", $new_instru, PDO::PARAM_STR);
        $stmt->bindValue(":commentaire", $new_commentaires, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $estModifie = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifie;
    }

}

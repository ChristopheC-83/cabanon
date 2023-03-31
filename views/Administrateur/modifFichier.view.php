<div class="page_title <?= $css ?>">

    <h1>LaboraZik</h1>
   

    <h2>Modification de <?= $fichier['nom_fichier'] . " / " . $fichier['nom_projet'] ?> </h2>

    <form method="POST" action="<?= URL ?>administration/validation_modifierFichier">

        <div class="entry_formulaire">
            <label for="projet">Dossier : </label>
            <input type="text" name="new_projet" id="new_projet" value=<?= $fichier['nom_projet'] ?>>
        </div>
        <div class="entry_formulaire">
            <label for="instru">Instrument(s) :</label>
            <input type="text" name="new_instru" id="new_instru" value = <?= $fichier['instru']?>>
        </div>
        <div class="entry_formulaire">
            <label for="commentaires">Commentaires :</label>
            <textarea type="text" name="new_commentaires" id="new_commentaires" rows="5" cols="80" ><?= $fichier['commentaire']?></textarea>
        </div>
        <input type="hidden" name="id" value=<?= $fichier['id'] ?>>
        <button type="submit" id="btnModifFichier" class="btnModifFichier">Valider les modifications</button>
    </form>





</div>
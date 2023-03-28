<div class="page_title <?= $css  ?>">


    <h1>L'Exchange</h1>

    <h2>Page des échanges des fichiers musicaux</h2>
    <h2>Projets disponibles :
        <form method="POST">
            <select name="projet" onchange=submit()>

                <?php $projets = array_unique(array_column($musiques, 'nom_projet')); ?>
                <option value=""></option>
                <option value="">Tous les projets</option>
                <?php foreach ($projets as $projet) : ?>
                    <option value="<?= $projet ?>"><?= $projet ?></option>
                <?php endforeach ?>


            </select>
            <!-- <input type="submit" value="Sélectionner"> -->
        </form>
    </h2>

    <table>
        <tr>
            <th id="nom">Nom</th>
            <th id="nom_projet">Projet</th>
            <th id="instru">Instrument(s)</th>
            <th id="date">Date de dépôt</th>
            <th id="commentaire">Commentaire</th>
        </tr>
        <h3>
            <?php
            if (!empty($_POST['projet'])) {
                echo ("Projet en cours : " . $_POST['projet']);
            } else {
                echo ("Vue de l'ensemble des fichiers");
            }
            ?>
        </h3>
        <?php foreach ($musiques as $musique) : ?>

            <?php if (!empty($_POST['projet'])) : ?>

                <?php if ($musique['nom_projet'] === $_POST['projet']) : ?>
                    <div class="morceau">
                        <tr id="trDonnees">
                            <td style="font-weight: bold"><?= $musique['nom_fichier'] ?></td>
                            <td><?= $musique['nom_projet'] ?></td>
                            <td><?= $musique['instru'] ?></td>
                            <td><?= $musique['date_depot'] ?></td>
                            <td rowspan="2"><?= $musique['commentaire'] ?></td>
                        </tr>
                        <tr id="trLecteur">
                            <td>
                                <form action="supprimerFichier/<?= $musique['id'] ?>" method="post" onSubmit="return confirm('Voulez-vous vraiment supprimer Le fichier : <?= $musique['nom_fichier'] ?> ?')">
                                    <button type="submit" class="btn btn-sup">Supprimer</button>
                                </form>
                            </td>
                            <td colspan="2"><audio controls>
                                    <source src="<?= URL ?>/public/assets/musiques/<?= $musique['nom_projet'] ?>_<?= $musique['nom_fichier'] ?>">
                                </audio>
                            </td>
                            <td><a href="<?= URL ?>/public/assets/musiques/<?= $musique['nom_projet'] ?>_<?= $musique['nom_fichier'] ?>" download="<?= $musique['nom_fichier'] ?>" target="_blank" rel="noreferrer">Télécharger</a></td>
                        </tr>
                    </div>

                <?php endif ?>
            <?php else : ?>
                <div class="morceau">
                    <tr id="trDonnees">
                        <td style="font-weight: bold"><?= $musique['nom_fichier'] ?></td>
                        <td><?= $musique['nom_projet'] ?></td>
                        <td><?= $musique['instru'] ?></td>
                        <td><?= $musique['date_depot'] ?></td>
                        <td rowspan="2"><?= $musique['commentaire'] ?></td>
                    </tr>
                    <tr id="trLecteur">
                        <td>
                            <form action="supprimerFichier/<?= $musique['id'] ?>" method="post" onSubmit="return confirm('Voulez-vous vraiment supprimer Le fichier : <?= $musique['nom_fichier'] ?> ?')">
                                <button type="submit" class="btn btn-sup">Supprimer</button>
                            </form>

                        </td>
                        <td colspan="2"><audio controls>
                                <source src="<?= URL ?>/public/assets/musiques/<?= $musique['nom_projet'] ?>_<?= $musique['nom_fichier'] ?>">
                            </audio>
                        </td>
                        <td><a href="<?= URL ?>/public/assets/musiques/<?= $musique['nom_projet'] ?>_<?= $musique['nom_fichier'] ?>" download="<?= $musique['nom_fichier'] ?>" target="_blank" rel="noreferrer">Télécharger</a></td>
                    </tr>
                </div>


            <?php endif ?>
        <?php endforeach ?>

    </table>
    <div class="ajout" id="btnAjoutFichier">Ajouter un fichier</div>

    <div id="ajoutFichier" class="ajout_fichier div_cache">
        <!-- div_cache -->
        <form action="<?= URL ?>administration/validation_ajoutFichier" method="POST" enctype="multipart/form-data">

            <div>
                <label for="fichier">Fichier :</label>
                <input type="file" name="fichier" id="fichier">
                <!-- $_FILES['fichier']['name'] -->
            </div>
            <!-- <div>
                <label for="nom_fichier">Nom du Fichier :</label>
                <input type="text" name="nom_fichier" id="nom_fichier">
                 $_POST['nom_fichier'] 
            </div> -->
            <div>
                <label for="nom_projet">Nom du Projet (pas du fichier !) :</label>
                <input type="text" name="nom_projet" id="nom_projet">
                <!-- $_POST['nom_projet']-->
            </div>
            <div>
                <label for="instru">Instrument(s) :</label>
                <input type="text" name="instru" id="instru">
                <!-- $_POST['instru']-->
            </div>
            <div>
                <label for="commentaire">Commentaire :</label>
                <textarea type="text" name="commentaire" id="commentaire" rows="5" cols="80"></textarea>
                <!-- $_POST['commentaire']-->
            </div>
            <input type="hidden" value="<?= date('Y-m-d') ?>" name="date_depot" id="date_depot">
            <!--  $_POST['date_depot']-->



            <button type="submit" class="btn_ajout_fichier ajout "> Ajouter Fichier</button>
        </form>

    </div>
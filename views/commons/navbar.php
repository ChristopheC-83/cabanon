<nav class="navbar narbarHidden">

    <ul class = "">
        <li><a href="<?= URL ?>accueil">CabAccueil</a></li>
        <li><a href="<?= URL ?>membres">Membres</a></li>
        <li><a href="<?= URL ?>galerie">Galerie</a></li>


        <?php if (Securite::estConnecte() && Securite::estAdministrateur()) : ?>

            <li><a href="<?= URL ?>administration/droits">Gérer les droits</a></li>
            <li><a href="<?= URL ?>administration/page2">Admin 2</a></li>

        <?php endif ?>
        <?php if (!Securite::estConnecte()) : ?>
            <li><a href="<?= URL ?>login">Connexion</a></li>
            <li><a href="<?= URL ?>creerCompte">Inscription</a></li>
        <?php else : ?>
            <li><a href="<?= URL ?>compte/profil">Profil</a></li>
            <li><a href="<?= URL ?>compte/deconnexion">Déconnexion</a></li>
        <?php endif ?>
    </ul>
<div class="flecheNavbar">
    
        <i class="fa-solid fa-angles-right fa-sm"></i>
</div>



</nav>
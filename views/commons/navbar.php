<nav class="navbar">

    <a href="<?= URL ?>accueil" class="navbar1">LaboraZic</a>
    <i class="fa-solid fa-music"></i>
    <a href="<?= URL ?>membres" class="navbar2">Membres</a>
    <i class="fa-solid fa-music"></i>
    <a href="<?= URL ?>galerie" class="navbar3">Galerie</a>
    <i class="fa-solid fa-music"></i>


    <?php if (Securite::estConnecte() && Securite::estAdministrateur()) : ?>

        <a href="<?= URL ?>administration/droits" class="navbar4">Gérer les droits</a>
        <i class="fa-solid fa-music"></i>
        <a href="<?= URL ?>administration/exchange" class="navbar5">Exchange</a>
        <i class="fa-solid fa-music"></i>

    <?php endif ?>
    <?php if (!Securite::estConnecte()) : ?>
        <a href="<?= URL ?>login" class="navbar6">Connexion</a>
        <i class="fa-solid fa-music"></i>
        <a href="<?= URL ?>creerCompte" class="navbar7">Inscription</a>
        <i class="fa-solid fa-music"></i>
    <?php else : ?>
        <a href="<?= URL ?>compte/profil" class="navbar8">Profil</a>
        <i class="fa-solid fa-music"></i>
        <a href="<?= URL ?>compte/deconnexion" class="navbar9">Déconnexion</a>
        <i class="fa-solid fa-music"></i>
    <?php endif ?>
    <!-- <div class="flecheNavbar">
    
        <i class="fa-solid fa-angles-right fa-sm"></i>
</div> -->



</nav>
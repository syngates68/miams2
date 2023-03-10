<?php if ($plats != null) : ?>
<div class="food-list">
    <?php foreach ($plats as $plat) : ?>
    <div class="food-card">
        <a href="#" class="open-informations-food" data-bs-toggle="modal" data-bs-target="#foodinformations" data-id="<?= $plat->id(); ?>">
            <div class="food-card-top">
                <img src="<?= BASEURL.$plat->photo_plat(); ?>">
            </div>
        </a>
        <div class="food-card-body">
            <a href="#" class="open-informations-food" data-bs-toggle="modal" data-bs-target="#foodinformations" data-id="<?= $plat->id(); ?>">
                <div class="food-name"><?= $plat->nom_plat(); ?></div>
                <div class="food-price"><span class="price"><?= $plat->prix(); ?></span> €/part (<?= $plat->parts(); ?> restante<?php if ($plat->parts() > 1) : ?>s<?php endif; ?>)</div>
            </a>
            <div class="food-seller">
                <div class="food-seller-img">
                    <img src="<?= BASEURL.Utilisateurs::getById($plat->id_vendeur())->photo_profil(); ?>">
                </div>
                <?= afficherNoteVendeur(Avis::getNoteByVendeur($plat->id_vendeur()), Avis::countByVendeur($plat->id_vendeur()), $plat->id_vendeur(), true); ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php else : ?>
<div class="no-items">
    <div class="no-items-img">
        <img src="<?= BASEURL; ?>assets/img/results.svg">
    </div>
    <div class="no-items-title">Il n'y a aucun plat à afficher pour le moment...</div>
    <?php if (isset($_SESSION['user'])) : ?>
        <a href="#" class="btn btn-primary">Proposer un plat</a>
    <?php endif; ?>
</div>
<?php endif; ?>
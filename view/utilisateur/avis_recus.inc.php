<div class="modal-header">
    <h5 class="modal-title">Avis donnés à <?= $vendeur->prenom(); ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="user-note">
        <?= $note; ?>
    </div>
    <?= afficherNoteVendeur($note, $nbr_avis); ?>
    <div class="stars-percentage">
        <div class="percentage">
            <div class="number-stars">5 étoiles</div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: <?= $nbr_5; ?>%" aria-valuenow="<?= $nbr_5; ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="percentage-number"><?= $nbr_5; ?>%</div>
        </div>
        <div class="percentage">
            <div class="number-stars">4 étoiles</div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: <?= $nbr_4; ?>%" aria-valuenow="<?= $nbr_4; ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="percentage-number"><?= $nbr_4; ?>%</div>
        </div>
        <div class="percentage">
            <div class="number-stars">3 étoiles</div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: <?= $nbr_3; ?>%" aria-valuenow="<?= $nbr_3; ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="percentage-number"><?= $nbr_3; ?>%</div>
        </div>
        <div class="percentage">
            <div class="number-stars">2 étoiles</div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: <?= $nbr_2; ?>%" aria-valuenow="<?= $nbr_2; ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="percentage-number"><?= $nbr_2; ?>%</div>
        </div>
        <div class="percentage">
            <div class="number-stars">1 étoile</div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: <?= $nbr_1; ?>%" aria-valuenow="<?= $nbr_1; ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="percentage-number"><?= $nbr_1; ?>%</div>
        </div>
    </div>
    <?php if ($avis != null) : ?>
        <?php foreach ($avis as $a) : ?>
            <?php $user = Utilisateurs::getById($a->id_utilisateur()); ?>
            <div class="rate">
                <div class="rate-top">
                    <div class="rate-top-left">
                        <div class="rate-user-img">
                            <img src="<?= BASEURL.$user->photo_profil(); ?>">
                        </div>
                        <div class="rate-user-informations">
                            <div class="rate-user-name"><?php if ($user->prenom() != null && $user->nom() != null) : echo $user->prenom().' '.$user->nom(); else : ?>Compte supprimé<?php endif; ?></div>
                            <div class="rate-user-order">Commande passée le 17/08/2022</div>
                        </div>
                    </div>
                    <?= afficherNoteDonnee($a->note()); ?>
                </div>
                <?php if ($a->texte_avis() != null) : ?>
                    <div class="rate-body">
                        <?= $a->texte_avis(); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
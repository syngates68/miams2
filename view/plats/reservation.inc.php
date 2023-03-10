<div class="modal-header">
    <h5 class="modal-title">Réserver ce plat</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <?php 
    if ($user_connected) : 
    ?>
        <div class="reservation-form">
            <form action="<?= BASEURL.'plats/reservation/'; ?>" method="POST">
                <div class="error-message" style="display: none;"></div>
                <div class="input-group mb-4 input-line">
                    <input type="hidden" name="id_plat" value="<?= $plat->id(); ?>">
                    <label for="nbr_parts">Nombre de parts souhaitées (max <?= $plat->parts(); ?>)</label>
                    <input class="form-control" type="number" name="nbr_parts" id="nbr_parts" data-prix="<?= $plat->prix(); ?>" value="1" min="1" max="<?= $plat->parts(); ?>">
                </div>
                <h3>Récapitulatif de réservation</h3>
                <ul>
                    <li>Plat : <?= $plat->nom_plat(); ?></li>
                    <li>Adresse : <?= $plat->adresse().' '.$plat->code_postal().' '.$plat->ville(); ?></li>
                    <li>Heure limite de récupération : <?= date('H:i', strtotime($plat->heure_limite())); ?></li>
                    <li>Montant total : <span class="total-reservation"><?= $plat->prix(); ?></span>.00 €</li>
                </ul>
                <button class="btn btn-primary btn-validation" type="submit">Réserver</button>
                <button class="btn btn-primary btn-loading" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Envoi en cours...
                </button>
            </form>
            <div class="reservation-message">
                En cas de soucis ou de changement d'avis, veillez à bien annuler votre réservation pour que
                d'autres personnes puissent profiter de ce plat.
            </div>
        </div>
    <?php 
    else :
        include 'view/connexion/form_connexion.inc.php';
    endif; 
    ?>
</div>
<div class="modal-body">
    <div class="succes-reservation-container">
        <div class="succes-reservation-img">
            <img src="<?= BASEURL; ?>assets/img/success.svg">
        </div>
        <h3>Merci pour votre réservation</h3>
        <p>Votre commande d'un montant de <?= $commande->montant_total(); ?>.00 € porte le numéro <?= $commande->numero_commande().'-'.$commande->cle_commande(); ?>.</p>
        <p>Un mail récapitulatif va vous être envoyé à l'adresse <?= Utilisateurs::getById($commande->id_utilisateur())->mail(); ?>.</p>
    </div>
</div>
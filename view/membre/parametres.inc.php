<div class="user-container">
    <h1>Paramètres du compte</h1>
    <div class="edit-block">
        <h2>Emails</h2>
        <div class="explication-message">Attention : Désactiver les mails peut vous faire louper des commandes, restez vigilants si vous ne souhaitez pas recevoir ces mails.</div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="mail_commande" checked>
            <label class="form-check-label" for="mail_commande">Recevoir un mail lorsqu'une commande est passée</label>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="mail_annulation" checked>
            <label class="form-check-label" for="mail_annulation">Recevoir un mail lors de l'annulation d'une commande</label>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="mail_reservation" checked>
            <label class="form-check-label" for="mail_reservation">Recevoir un mail récapitulatif de réservation</label>
        </div>
    </div>
    <button class="btn btn-primary">Modifier</button>
    <div class="edit-block">
        <h2 class="delete-account">Supprimer mon compte</h2>
        <a href="<?= BASEURL; ?>membre/suppression/">Je souhaite supprimer mon compte</a>
    </div>
</div>
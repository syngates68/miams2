<div class="user-container">
    <h1>Mes commandes</h1>
    <?php if ($commandes != null) : ?>
        <?php foreach ($commandes as $commande) : ?>
            <?php $plat = Plats::getById($commande->id_plat()); ?>
            <?php $utilisateur = Utilisateurs::getById($commande->id_utilisateur()); ?>
            <div class="order-container">
                <div class="order-number">Commande <?= $commande->numero_commande().'-'.$commande->cle_commande(); ?></div>
                <div class="order-info">Plat concerné : <?= $plat->nom_plat(); ?></div>
                <div class="order-info">Nombre de parts : <?= $commande->nombre_parts(); ?></div>
                <div class="order-info">Montant total : <?= $commande->montant_total(); ?>.00 €</div>
                <div class="order-info">Réservé par : <?= ($utilisateur->prenom() != null && $utilisateur->nom() != null) ? $utilisateur->prenom().' '.$utilisateur->nom() : 'Compte supprimé'; ?></div>
                <div class="order-actions">
                    <button class="btn btn-primary">Commande récupérée</button>
                    <button class="btn btn-danger btn-icon" id="deleteorder" data-bs-toggle="tooltip" data-bs-placement="top" title="Annuler la commande"><span class="material-icons-outlined">delete</span></button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="error-message">Vous n'avez aucune commande en cours.</div>
    <?php endif; ?>
</div>

<script>
    var delete = document.getElementById('deleteorder')
    var tooltip = new bootstrap.Tooltip(delete, options)
</script>
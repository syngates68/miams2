<div class="modal-body">
    <div class="food-informations">
        <div class="food-img">
            <img src="<?= BASEURL.$plat->photo_plat(); ?>">
        </div>
        <div class="food-informations-body">
            <div class="food-price"><B>Prix :</B><br/><?= $plat->prix(); ?> €/part</div>
            <div class="food-left"><B>Parts restantes :</B><br/><?= $plat->parts(); ?></div>
            <div class="food-hours"><B>Heure limite de récupération :</B><br/>Disponible jusqu'à <?= date('H:i', strtotime($plat->heure_limite())); ?></div>
            <div class="food-address"><B>Adresse :</B><br/><?= $plat->adresse(); ?><br/><?= $plat->code_postal().' '.$plat->ville(); ?></div>
            <div class="food-note"><B>Note du vendeur :</B><br/><?= $plat->note_vendeur(); ?></div>
        </div>
    </div>
    <div class="seller-informations">
        <h3>Le vendeur</h3>
        <div class="seller">
            <div class="seller-img">
                <img src="<?= BASEURL.$vendeur->photo_profil(); ?>">
            </div>
            <div class="seller-name"><?= $vendeur->prenom().' '.$vendeur->nom(); ?></div>
            <div class="seller-sign">Membre depuis le <?= date('d/m/Y', strtotime($vendeur->date_inscription())); ?></div>
            <div class="seller-orders">368 commandes réalisées</div>
            <?= afficherNoteVendeur($note, $nbr_avis); ?>
            <div class="seller-bio">Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
            Nihil adipisci odit tempore explicabo perferendis quas voluptate obcaecati voluptates eum est 
            totam dignissimos veritatis, neque, velit sit. Non, totam! Doloribus, saepe.<br/><br/>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum quaerat quisquam repudiandae! 
            Illum, neque accusamus voluptate iure corrupti officiis nulla rerum in? Dolorum iusto nisi quidem 
            facilis eos error cum.</div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary">Contacter le vendeur</button>
    <button class="btn btn-primary btn-reserver" data-id="<?= $plat->id(); ?>">Réserver</button>
</div>

<div class="user-container">
    <h1>Modifier mes informations</h1>
    <div class="non-empty">Les champs suivis d'un <span class="non-empty-sign">*</span> sont obligatoires</div>
    <form method="POST" enctype="multipart/form-data" action="<?= BASEURL; ?>/membre/editer/">
        <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
        <div class="edit-block">
            <h2>Photo de profil</h2>
            <div class="change-avatar-container">
                <div class="avatar-container">
                    <img src="<?= BASEURL.$user->photo_profil(); ?>">
                </div>
                <button class="btn btn-secondary modify-avatar" type="button">Modifier</button>
                <input type="file" name="avatar" id="avatar" style="display: none;">
            </div>
        </div>
        <div class="edit-block">
            <h2>Informations personnelles</h2>
            <?php
                if (isset($_SESSION['error_personnal'])) :
            ?>
                <div class="error-message">
                    <?= $_SESSION['error_personnal']; ?>
                </div>
            <?php
                unset($_SESSION['error_personnal']);
                endif;
            ?>
            <div class="row">
                <div class="col-lg-6">
                    <label for="nom" class="form-label">Nom <span class="non-empty-sign">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="nom" id="nom" value="<?= $user->nom(); ?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <label for="prenom" class="form-label">Prénom <span class="non-empty-sign">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="prenom" id="prenom" value="<?= $user->prenom(); ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <label for="mail" class="form-label">Adresse mail <span class="non-empty-sign">*</span></label>
                    <div class="input-group">
                        <input type="email" class="form-control" name="mail" id="mail" value="<?= $user->mail(); ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="edit-block">
            <h2>Localisation</h2>
            <div class="explication-message">Ces informations servent à pré-renseigner les champs concernés lorsque vous proposez un plat sur la plateforme.</div>
            <div class="row">
                <div class="col-lg-12">
                    <label for="adresse" class="form-label">Adresse</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="adresse" id="adresse" value="<?= $user->adresse(); ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <label for="complement_adresse" class="form-label">Complément d'adresse</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="complement_adresse" id="complement_adresse" value="<?= $user->complement_adresse(); ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <label for="batiment" class="form-label">Bâtiment</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="batiment" id="batiment" value="<?= $user->batiment(); ?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <label for="etage" class="form-label">Etage</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="etage" id="etage" value="<?= $user->etage(); ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <label for="code_postal" class="form-label">Code Postal</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="code_postal" id="code_postal" value="<?= $user->code_postal(); ?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <label for="ville" class="form-label">Ville</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="ville" id="ville" value="<?= $user->ville(); ?>">
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary">Valider les modifications</button>
    </form>
</div>
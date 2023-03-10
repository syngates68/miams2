<div class="user-container">
    <h1>Modifier mon mot de passe</h1>
    <form method="POST" action="<?= BASEURL; ?>/membre/password/token=<?= $_SESSION['token']; ?>">
        <div class="edit-block">
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
            <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
            <div class="row">
                <div class="col-lg-12">
                    <label for="pass" class="form-label">Mot de passe actuel</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="pass" id="pass" value="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <label for="new_pass" class="form-label">Nouveau mot de passe</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="new_pass" id="new_pass" value="">
                    </div>
                </div>
            </div>
            <div class="password-security">
                <div class="password-security-title">Pour votre sécurité, votre mot de passe doit contenir au moins :</div>
                <div class="password-security-element not-good" id="password_length">6 caractères</div>
                <div class="password-security-element not-good" id="password_number">1 chiffre</div>
                <div class="password-security-element not-good" id="password_upper">1 lettre majuscule</div>
                <div class="password-security-element not-good" id="password_lower">1 lettre minuscule</div>
                <div class="password-security-element not-good" id="password_special">1 caractère spécial</div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <label for="new_pass_confirm" class="form-label">Confirmation du nouveau mot de passe</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="new_pass_confirm" id="new_pass_confirm" value="">
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary">Changer de mot de passe</button>
    </form>
</div>
<script src="<?= BASEURL; ?>assets/js/edit.js"></script>
<div class="login-form">
    <h1>Se connecter à votre espace client</h1>
    <p class="reservation-login">Veuillez vous connecter à votre espace client pour accéder à la réservation.</p>
    <button class="btn btn-facebook"><img src="<?= BASEURL; ?>assets/img/facebook.svg">Connexion avec Facebook</button>
    <div class="second-choice">
        <div class="second-choice-text">Ou</div>
    </div>
    <form action="<?= BASEURL; ?>connexion/" method="post">
        <label for="mail" class="form-label">Adresse mail</label>
        <div class="input-group mb-4">
            <input type="email" class="form-control" name="mail" id="mail" <?php if (isset($_SESSION['mail_login'])) : ?>value="<?= $_SESSION['mail_login']; ?>"<?php unset($_SESSION['mail_login']); endif; ?>>
        </div>
        <label for="pass" class="form-label">Mot de passe</label>
        <div class="input-group">
            <input type="password" class="form-control" name="pass" id="pass">
        </div>
        <div class="forgotten-password"><a href="#">Mot de passe oublié</a></div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="rememberme" id="rememberme" checked>
            <label class="form-check-label" for="rememberme">
                Se souvenir de moi
            </label>
        </div>
        <button class="btn btn-primary">Connexion</button>
        <?php
            if (isset($_SESSION['error_login'])) :
        ?>
            <div class="error-message">
                <?= $_SESSION['error_login']; ?>
            </div>
        <?php
            unset($_SESSION['error_login']);
            endif;
        ?>
    </form>
    <div class="login-link">Vous n'avez pas encore de compte client ? Vous pouvez vous en créer un rapidement <a href="<?= BASEURL; ?>inscription/">ici</a></div>
</div>
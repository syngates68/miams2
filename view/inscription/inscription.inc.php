<div class="main main-login">
    <div class="login-container">
        <div class="login-container-left">
            <div class="login-form">
                <h1>Se créer un compte client</h1>
                <button class="btn btn-facebook"><img src="<?= BASEURL; ?>assets/img/facebook.svg">Continuer avec Facebook</button>
                <div class="second-choice">
                    <div class="second-choice-text">Ou</div>
                </div>
                <form action="<?= BASEURL; ?>inscription/" method="post">
                    <label for="nom" class="form-label">Nom</label>
                    <div class="input-group mb-4">
                        <input type="text" class="form-control" name="nom" id="nom" <?php if (isset($_SESSION['name_sign'])) : ?>value="<?= $_SESSION['name_sign']; ?>"<?php unset($_SESSION['name_sign']); endif; ?>>
                    </div>
                    <label for="prenom" class="form-label">Prénom</label>
                    <div class="input-group mb-4">
                        <input type="text" class="form-control" name="prenom" id="prenom" <?php if (isset($_SESSION['firstname_sign'])) : ?>value="<?= $_SESSION['firstname_sign']; ?>"<?php unset($_SESSION['firstname_sign']); endif; ?>>
                    </div>
                    <label for="mail" class="form-label">Adresse mail</label>
                    <div class="input-group mb-4">
                        <input type="email" class="form-control" name="mail" id="mail" <?php if (isset($_SESSION['mail_sign'])) : ?>value="<?= $_SESSION['mail_sign']; ?>"<?php unset($_SESSION['mail_sign']); endif; ?>>
                    </div>
                    <label for="mail_confirm" class="form-label">Confirmation de l'adresse mail</label>
                    <div class="input-group mb-4">
                        <input type="email" class="form-control" name="mail_confirm" id="mail_confirm">
                    </div>
                    <div class="label-flex">
                        <label for="pass" class="form-label">Mot de passe</label>
                        <div class="show-password"><a href="#" data-pass="pass" data-status="hidden">Afficher</a></div>
                    </div>
                    <div class="input-group">
                        <input type="password" class="form-control" name="pass" id="pass">
                    </div>
                    <div class="password-security">
                        <div class="password-security-title">Pour votre sécurité, votre mot de passe doit contenir au moins :</div>
                        <div class="password-security-element not-good" id="password_length">6 caractères</div>
                        <div class="password-security-element not-good" id="password_number">1 chiffre</div>
                        <div class="password-security-element not-good" id="password_upper">1 lettre majuscule</div>
                        <div class="password-security-element not-good" id="password_lower">1 lettre minuscule</div>
                        <div class="password-security-element not-good" id="password_special">1 caractère spécial</div>
                    </div>
                    <div class="label-flex">
                        <label for="pass_confirm" class="form-label">Confirmation du mot de passe</label>
                        <div class="show-password"><a href="#" data-pass="pass_confirm" data-status="hidden">Afficher</a></div>
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" class="form-control" name="pass_confirm" id="pass_confirm">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="cgu" name="cgu">
                        <label class="form-check-label" for="cgu">
                            J'ai lu et j'accepte les <a href="<?= BASEURL; ?>conditions-generales-utilisation/" target="_blank">Conditions Générales d'Utilisation</a>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="cgv" name="cgv">
                        <label class="form-check-label" for="cgv">
                            J'ai lu et j'accepte les <a href="#">Conditions Générales de Vente</a>
                        </label>
                    </div>
                    <button class="btn btn-primary">Inscription</button>
                    <?php
                        if (isset($_SESSION['error_sign'])) :
                    ?>
                        <div class="error-message">
                            <?= $_SESSION['error_sign']; ?>
                        </div>
                    <?php
                        unset($_SESSION['error_sign']);
                        endif;
                    ?>
                </form>
                <div class="login-link">Vous avez déjà un compte client ? Connectez-vous à ce dernier <a href="<?= BASEURL; ?>connexion/">ici</a></div>
            </div>
        </div>
        <div class="login-container-right">
            <img src="<?= BASEURL; ?>assets/img/join.svg">
        </div>
    </div>
</div>
<script src="<?= BASEURL; ?>assets/js/inscription.js"></script>
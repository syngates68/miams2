<div class="user-container delete-container">
    <h1>Toutes les bonnes choses ont une fin...</h1>
    <img src="<?= BASEURL; ?>assets/img/delete.svg">
    <div class="delete-message">
        La suppression de votre compte est une action irréversible, une fois cela fait, toutes les informations associées à votre
        compte seront automatiquement supprimées.<br/>
        Si vous êtes sûr(e) de ne plus vouloir utiliser Miams, veuillez rentrer votre mot de passe dans le champs ci-dessous.
    </div>
    <form method="POST" action="<?= BASEURL; ?>membre/suppression/">
        <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
        <label for="pass" class="form-label">Votre mot de passe</label>
        <div class="input-group mb-4">
            <input type="password" class="form-control" name="pass" id="pass">
        </div>
        <button class="btn btn-danger">Supprimer mon compte</button>
    </form>
</div>
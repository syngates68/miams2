<?php
session_start();

date_default_timezone_set('Europe/Paris');

require_once('config/config.inc.php');
require_once('config/functions.inc.php');
require_once('config/sqlconnect.inc.php');
require_once('model/Model.php');
require_once('model/Utilisateurs.php');
require_once('model/Avis.php');
require_once('model/Plats.php');
require_once('model/Commandes.php');

//On initialise le lien avec la BDD pour les modèles
Model::set_db($bdd);

//Définit si on affiche le footer ou non
$no_footer = false;

//On récupère les informations de l'url
$ctrl = (isset($_GET['ctrl']) && $_GET['ctrl'] != null) ? $_GET['ctrl'] : 'home';
$action = (isset($_GET['action'])) ? $_GET['action'] : null;

//S'il y a un tiret dans le controller, on remplace le tiret par une majuscule à la lettre suivant le tiret
if (stripos($ctrl, '-') != '-1')
{
    $arr_ctrl = explode('-', $ctrl);
    $ctrl = '';
    for ($i = 0; $i < sizeof($arr_ctrl); $i++)
    {
        $ctrl .= $arr_ctrl[$i];
    }
}

//On va vérifier que le controller existe bien
$ctrl_file = 'controller/'.ucfirst($ctrl).'Controller.inc.php';
if (file_exists($ctrl_file))
{
    require_once($ctrl_file);

    $ctrl_class = ucfirst($ctrl).'Controller';
    if (class_exists($ctrl_class))
    {
        if ($ctrl == 'connexion' || $ctrl == 'inscription')
            $no_footer = true;
        $c = new $ctrl_class();
        $action = ($action == null) ? 'index' : $action;

        $method = $_SERVER['REQUEST_METHOD'].'_'.$action;
        if (method_exists($c, $method))
        {
            if (strtolower($_SERVER['REQUEST_METHOD']) == 'get')
            {
                ob_start();
                $c->$method();
                $content = ob_get_clean();
            }
            else
                $c->$method();
        }
        else
        {
            header('Location: '.BASEURL.$ctrl.'/');
            exit();
        }
    }
    else
    {
        header('Location: '.BASEURL);
        exit();
    }
}
else
{
    header('Location: '.BASEURL);
    exit();
}

//Vérification du cookie de connexion
if (isset($_COOKIE['auth']))
{
    $auth = $_COOKIE['auth'];
    $auth = explode('----', $auth);
    $utilisateur = Utilisateurs::getById($auth[0]);

    $key = sha1($utilisateur->mail().$utilisateur->pass());

    if ($key == $auth[1])
    {
        $_SESSION['user'] = $utilisateur->id();
        setcookie('auth', $utilisateur->id() . '----' . sha1($utilisateur->mail() . $utilisateur->pass()), time() + 3600 * 24 * 3, '/', '', false, true);
    }
    else
        setcookie('auth', '', time() - 3600, '/', '', false, true);
}

if (!isset($_GET['p'])) :
    if (isset($_SESSION['user']))
        $nbr_commandes_en_cours = (Commandes::getAllByVendeur($_SESSION['user']) != null) ? sizeof(Commandes::getAllByVendeur($_SESSION['user'])) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Miams - Repas de particulier à particulier</title>
    <link rel="icon" type="image/png" href="<?= BASEURL; ?>assets/img/ico.png" />
    <link rel="stylesheet" href="<?= BASEURL; ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>assets/css/main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <script src="<?= BASEURL; ?>assets/js/jquery.js"></script>
    <script src="<?= BASEURL; ?>assets/js/popper.min.js"></script>
    <script src="<?= BASEURL; ?>assets/js/bootstrap.js"></script>
    <script src="<?= BASEURL; ?>assets/js/main.js" defer></script>
    <script>
        var baseurl = "<?= BASEURL; ?>"
    </script>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            <div class="left">
                <a href="#">En savoir plus</a>
                <a href="#">Acheter sur Miams</a>
                <a href="#">Vendre sur Miams</a>
            </div>
            <div class="center">
                <div class="mobile-menu">
                    <span class="material-icons-outlined">menu</span>
                </div>
                <a href="<?= BASEURL; ?>"><img src="<?= BASEURL; ?>assets/img/logo.png"></a>
            </div>
            <div class="right">
                <?php
                if (isset($_SESSION['user']))
                {
                    $u = Utilisateurs::getById($_SESSION['user']);
                ?>
                    <div class="dropdown">
                        <a href="#" class="navbar-link dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="avatar-container">
                                <img src="<?= BASEURL.$u->photo_profil(); ?>">
                                <?php if ($nbr_commandes_en_cours > 0) : ?>
                                    <div class="notifications"><?= $nbr_commandes_en_cours; ?></div>
                                <?php endif; ?>
                            </div>
                            <?= $u->prenom().' '.$u->nom(); ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <div class="dropdown-block">
                                <li><a class="dropdown-item" href="<?= BASEURL; ?>deconnexion/token=<?= $_SESSION['token']; ?>">Mes plats</a></li>
                                <li><a class="dropdown-item" href="<?= BASEURL; ?>membre/commandes/">Mes commandes<?php if ($nbr_commandes_en_cours > 0) : ?> (<?= $nbr_commandes_en_cours; ?>)<?php endif; ?></a></li>
                                <li><a class="dropdown-item" href="<?= BASEURL; ?>deconnexion/token=<?= $_SESSION['token']; ?>">Mes réservations</a></li>
                            </div>
                            <div class="dropdown-block">
                                <li><a class="dropdown-item" href="<?= BASEURL; ?>membre/editer/">Modifier mes informations</a></li>
                                <li><a class="dropdown-item" href="<?= BASEURL; ?>membre/password/">Modifier mon mot de passe</a></li>
                                <li><a class="dropdown-item" href="<?= BASEURL; ?>membre/parametres/">Paramètres du compte</a></li>
                            </div>
                            <div class="dropdown-block">
                                <li><a class="dropdown-item" href="<?= BASEURL; ?>deconnexion/token=<?= $_SESSION['token']; ?>">Déconnexion</a></li>
                            </div>
                        </ul>
                    </div>
                <?php
                }
                else
                {
                ?>
                    <a href="<?= BASEURL; ?>connexion/" class="navbar-link">Se connecter <span class="yellow-text">ou</span> s'inscrire</a>
                <?php
                }
                ?>
                
            </div>
        </div>
    </nav>
    <?= $content; ?>
    <footer <?php if ($no_footer) : ?>class="no-footer"<?php endif; ?>>
        <div class="footer-content">
            <div class="footer-left">
                <img src="<?= BASEURL; ?>assets/img/logo.png">
            </div>
            <div class="footer-center">
                <div class="footer-title">En savoir plus</div>
                <a href="<?= BASEURL; ?>conditions-generales-utilisation/">Conditions générales d'utilisation</a>
                <a href="#">Conditions générales de vente</a>
                <a href="<?= BASEURL; ?>politique-confidentialite/">Politique de confidentialité</a>
            </div>
            <div class="footer-right">
                <div class="footer-title">Contact</div>
                <a href="#">Suggérer une modification ou remonter un bug</a>
                <a href="#"><span class="material-icons-outlined">mail</span>miams-contact@gmail.com</a>
                <a href="#"><span class="material-icons-outlined">language</span>https://www.miams.com</a>
                <div class="copyright">&copy; Copyright Miams <?= date('Y'); ?></div>
            </div>
        </div>
    </footer>
</body>
</html>

<?php

elseif (strtolower($_SERVER['REQUEST_METHOD']) == 'get') :
    echo $content;
endif;
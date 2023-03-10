<?php

require_once('model/Utilisateurs.php');
require_once('model/Commandes.php');

class MembreController
{
    public function get_index()
    {
        MembreController::get_editer();
    }

    public function get_editer()
    {
        if (isset($_SESSION['user']))
        {
            $user = Utilisateurs::getById($_SESSION['user']);
            include 'view/membre/editer.inc.php';
        }
        else
        {
            header('Location:'.BASEURL.'connexion/');
            exit();
        }
    }

    public function post_editer()
    {
        if ($_POST['token'] == $_SESSION['token'])
        {
            $nom = (isset($_POST['nom'])) ? $_POST['nom'] : null;
            $prenom = (isset($_POST['prenom'])) ? $_POST['prenom'] : null;
            $mail = (isset($_POST['mail'])) ? $_POST['mail'] : null;

            if ($nom != null && $prenom != null && $mail != null)
            {
                $adresse = (isset($_POST['adresse'])) ? $_POST['adresse'] : null;
                $complement_adresse = (isset($_POST['complement_adresse'])) ? $_POST['complement_adresse'] : null;
                $batiment = (isset($_POST['batiment'])) ? $_POST['batiment'] : null;
                $etage = (isset($_POST['etage'])) ? $_POST['etage'] : null;
                $code_postal = (isset($_POST['code_postal'])) ? $_POST['code_postal'] : null;
                $ville = (isset($_POST['ville'])) ? $_POST['ville'] : null;

                $user = Utilisateurs::getById($_SESSION['user']);
                $user->modifier($nom, $prenom, $mail, mb_strtoupper($adresse), mb_strtoupper($complement_adresse), mb_strtoupper($batiment), $etage, $code_postal, mb_strtoupper($ville));
                $user->save();

                if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0)
                {
                    $avatar = $_FILES['avatar'];
                    $name = basename($avatar['name']);
                    $upload = './assets/utilisateurs/'.$_SESSION['user'].'-'.$name;
                    move_uploaded_file($avatar['tmp_name'], $upload);

                    $user->set_photo_profil(str_replace('./', '', $upload));
                    $user->save();
                }

                header('Location:'.BASEURL.'membre/editer/');
                exit();
            }
            else
            {
                $_SESSION['error_personnal'] = "Tous les champs ci-dessous sont obligatoires.";
                header('Location:'.BASEURL.'membre/editer/');
                exit();
            }
        }
        else
        {
            header('Location:'.BASEURL);
            exit(); 
        }
    }

    public function get_password()
    {
        if (isset($_SESSION['user']))
        {
            $user = Utilisateurs::getById($_SESSION['user']);
            include 'view/membre/password.inc.php';
        }
        else
        {
            header('Location:'.BASEURL.'connexion/');
            exit();
        }
    }

    public function post_password()
    {
        if ($_POST['token'] == $_SESSION['token'])
        {
            $pass = (isset($_POST['pass'])) ? $_POST['pass'] : null;
            $new_pass = (isset($_POST['new_pass'])) ? $_POST['new_pass'] : null;
            $new_pass_confirm = (isset($_POST['new_pass_confirm'])) ? $_POST['new_pass_confirm'] : null;

            $user = Utilisateurs::getById($_SESSION['user']);

            if ($pass != null && $new_pass != null && $new_pass_confirm != null)
            {
                if (password_verify($pass, $user->pass()))
                {
                    if (strlen($new_pass) >= 6 && preg_match('/\d/', $new_pass) && preg_match('/[a-z]/', $new_pass) && preg_match('/[A-Z]/', $new_pass) && preg_match('/[_#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $new_pass))
                    {
                        if ($new_pass == $new_pass_confirm)
                        {
                            $user->updatePassword(password_hash($new_pass, PASSWORD_BCRYPT));
                            $user->save();

                            header('Location:'.BASEURL.'membre/password/');
                            exit();
                        }
                        else
                        {
                            $_SESSION['error_personnal'] = "Les deux mots de passe doivent être identiques.";
                            header('Location:'.BASEURL.'membre/password/');
                            exit();
                        }
                    }
                    else
                    {
                        $_SESSION['error_personnal'] = "Votre mot de passe ne respecte pas les critères de sécurité demandés.";
                        header('Location:'.BASEURL.'membre/password/');
                        exit();
                    }
                }
                else
                {
                    $_SESSION['error_personnal'] = "Le mot de passe renseigné est incorrect.";
                    header('Location:'.BASEURL.'membre/password/');
                    exit();
                }
            }
            else
            {
                $_SESSION['error_personnal'] = "Tous les champs ci-dessous sont obligatoires.";
                header('Location:'.BASEURL.'membre/password/');
                exit();
            }
        }
        else
        {
            header('Location:'.BASEURL);
            exit(); 
        }
    }

    public function get_parametres()
    {
        if (isset($_SESSION['user']))
        {
            $user = Utilisateurs::getById($_SESSION['user']);
            include 'view/membre/parametres.inc.php';
        }
        else
        {
            header('Location:'.BASEURL.'connexion/');
            exit();
        }
    }

    public function get_suppression()
    {
        if (isset($_SESSION['user']))
        {
            $user = Utilisateurs::getById($_SESSION['user']);
            include 'view/membre/suppression.inc.php';
        }
        else
        {
            header('Location:'.BASEURL.'connexion/');
            exit();
        }
    }

    public function post_suppression()
    {
        if ($_POST['token'] == $_SESSION['token'])
        {
            $pass = (isset($_POST['pass'])) ? $_POST['pass'] : null;
            $user = Utilisateurs::getById($_SESSION['user']);

            if (password_verify($pass, $user->pass()))
            {
                $user->supprimer();
                $user->save();

                session_destroy();
                setcookie('auth', '', time() - 3600, '/', '', false, true);

                header('Location:'.BASEURL);
                exit();
            }
            else
            {
                header('Location:'.BASEURL.'membre/suppression/');
                exit();
            }
        }
        else
        {
            header('Location:'.BASEURL);
            exit();
        }
    }

    public function get_commandes()
    {
        if (isset($_SESSION['user']))
        {
            $user = Utilisateurs::getById($_SESSION['user']);
            $commandes = Commandes::getAllByVendeur($_SESSION['user']);
            include 'view/membre/commandes.inc.php';
        }
        else
        {
            header('Location:'.BASEURL.'connexion/');
            exit();
        }
    }
}
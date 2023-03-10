<?php

require_once('model/Utilisateurs.php');

class ConnexionController
{
    public function get_index()
    {
        if (isset($_SESSION['user']))
        {
            header('Location: '.BASEURL);
            exit();
        }

        include 'view/connexion/connexion.inc.php';
    }

    public function post_index()
    {
        $mail = (isset($_POST['mail'])) ? $_POST['mail'] : null;
        $pass = (isset($_POST['pass'])) ? $_POST['pass'] : null;

        if ($mail != null && $pass != null)
        {
            $user = Utilisateurs::getByMail($mail);

            if ($user != null)
            {
                if ($user->bloque() == 0)
                {
                    if (password_verify($pass, $user->pass()))
                    {
                        $user->updateTentatives(5);
                        $user->save();
                        $_SESSION['user'] = $user->id();

                        //Si la coche "Se souvenir de moi" est cochée
                        if (isset($_POST['rememberme']))
                            setcookie('auth', $user->id() . '----' . sha1($user->mail() . $user->pass()), time() + 3600 * 24 * 3, '/', '', false, true);

                        if ($user->id_droit() == 1)
                            header('Location: '.BASEURL.'utilisateur/administration/');
                        else
                            header('Location: '.BASEURL);
                        exit();
                    }
                    else
                    {
                        $user->updateTentatives($user->tentatives() - 1);
                        $user->save();

                        $_SESSION['error_login'] = "Aucun compte ne correspond aux informations renseignées.<br/>Vous n'avez plus que ".$user->tentatives()." essais avant que votre compte ne soit bloqué.";
                        if ($user->tentatives() == 0)
                        {
                            $_SESSION['error_login'] = "Votre compte a été bloqué après 5 tentatives de connexion.";
                            $user->bloqueUser();
                            $user->save();
                        }
                        
                        $_SESSION['mail_login'] = $mail;
                        header('Location: '.BASEURL.'connexion/');
                        exit();
                    }
                }
                else
                {
                    $_SESSION['error_login'] = "Votre compte a été bloqué, si vous estimez qu'il s'agit d'une erreur, vous pouvez nous contacter <a href=\"#\">ici</a>.";
                    $_SESSION['mail_login'] = $mail;
                    header('Location: '.BASEURL.'connexion/');
                    exit();
                }
            }
            else
            {
                $_SESSION['error_login'] = "Aucun compte ne correspond aux informations renseignées.";
                $_SESSION['mail_login'] = $mail;
                header('Location: '.BASEURL.'connexion/');
                exit();
            }
        }
        else
        {
            $_SESSION['error_login'] = "Veuillez renseigner tous les champs demandés.";
            $_SESSION['mail_login'] = $mail;
            header('Location: '.BASEURL.'connexion/');
            exit();
        }
    }
}
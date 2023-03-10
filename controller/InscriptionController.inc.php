<?php

require_once('model/Utilisateurs.php');

class InscriptionController
{
    public function get_index()
    {
        if (isset($_SESSION['user']))
        {
            header('Location: '.BASEURL);
            exit();
        }
        
        include 'view/inscription/inscription.inc.php';
    }

    public function post_index()
    {
        if (isset($_POST['cgu']) && isset($_POST['cgv']))
        {
            $nom = (isset($_POST['nom'])) ? $_POST['nom'] : null;
            $prenom = (isset($_POST['prenom'])) ? $_POST['prenom'] : null;
            $mail = (isset($_POST['mail'])) ? $_POST['mail'] : null;
            $mail_confirm = (isset($_POST['mail_confirm'])) ? $_POST['mail_confirm'] : null;
            $pass = (isset($_POST['pass'])) ? $_POST['pass'] : null;
            $pass_confirm = (isset($_POST['pass_confirm'])) ? $_POST['pass_confirm'] : null;
    
            if ($nom != null && $prenom != null && $mail != null && $mail_confirm != null && $pass != null && $pass_confirm != null)
            {
                if (filter_var($mail, FILTER_VALIDATE_EMAIL))
                {
                    if ($mail == $mail_confirm)
                    {
                        if (strlen($pass) >= 6 && preg_match('/\d/', $pass) && preg_match('/[a-z]/', $pass) && preg_match('/[A-Z]/', $pass) && preg_match('/[_#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $pass))
                        {
                            if ($pass == $pass_confirm)
                            {
                                $user_exist = Utilisateurs::getByMail($mail);
    
                                if ($user_exist == null)
                                {
                                    $u = Utilisateurs::insertUser(strtoupper($nom), ucwords($prenom), $mail, password_hash($pass, PASSWORD_BCRYPT), date('Y-m-d H:i:s'));
                                    $_SESSION['user'] = $u->id();
                                    
                                    header('Location: '.BASEURL);
                                    exit();
                                }
                                else
                                {
                                    $_SESSION['error_sign'] = "Un compte existe déjà pour cette adresse mail.";
                                    $_SESSION['name_sign'] = $nom;
                                    $_SESSION['firstname_sign'] = $prenom;
                                    $_SESSION['mail_sign'] = $mail;
                                    header('Location: '.BASEURL.'inscription/');
                                    exit();
                                }
                            }
                            else
                            {
                                $_SESSION['error_sign'] = "Vos deux mots de passe doivent être identiques.";
                                $_SESSION['name_sign'] = $nom;
                                $_SESSION['firstname_sign'] = $prenom;
                                $_SESSION['mail_sign'] = $mail;
                                header('Location: '.BASEURL.'inscription/');
                                exit();
                            }
                        }
                        else
                        {
                            $_SESSION['error_sign'] = "Votre mot de passe ne respecte pas les critères de sécurité demandés.";
                            $_SESSION['name_sign'] = $nom;
                            $_SESSION['firstname_sign'] = $prenom;
                            $_SESSION['mail_sign'] = $mail;
                            header('Location: '.BASEURL.'inscription/');
                            exit();
                        }
                    }
                    else
                    {
                        $_SESSION['error_sign'] = "Les deux adresses mail doivent être identiques.";
                        $_SESSION['name_sign'] = $nom;
                        $_SESSION['firstname_sign'] = $prenom;
                        $_SESSION['mail_sign'] = $mail;
                        header('Location: '.BASEURL.'inscription/');
                        exit();
                    }
                }
                else
                {
                    $_SESSION['error_sign'] = "Veuillez renseigner une adresse mail valide.";
                    $_SESSION['name_sign'] = $nom;
                    $_SESSION['firstname_sign'] = $prenom;
                    $_SESSION['mail_sign'] = $mail;
                    header('Location: '.BASEURL.'inscription/');
                    exit();               
                }
            }
            else
            {
                $_SESSION['error_sign'] = "Veuillez renseigner tous les champs demandés.";
                $_SESSION['name_sign'] = $nom;
                $_SESSION['firstname_sign'] = $prenom;
                $_SESSION['mail_sign'] = $mail;
                header('Location: '.BASEURL.'inscription/');
                exit();
            }
        }
        else
        {
            $_SESSION['error_sign'] = "L'acceptation des Conditions Générales d'Utilisation et de Vente est obligatoire pour se créer un compte.";
            $_SESSION['name_sign'] = (isset($_POST['nom'])) ? $_POST['nom'] : null;
            $_SESSION['firstname_sign'] = (isset($_POST['prenom'])) ? $_POST['prenom'] : null;
            $_SESSION['mail_sign'] = (isset($_POST['mail'])) ? $_POST['mail'] : null;
            header('Location: '.BASEURL.'inscription/');
            exit();
        }
    }
}
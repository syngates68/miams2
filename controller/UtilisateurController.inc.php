<?php

require_once('model/Utilisateurs.php');
require_once('model/Avis.php');

class UtilisateurController
{
    public function get_avis_recus()
    {
        $vendeur = Utilisateurs::getById($_GET['id']);
        if ($vendeur != null)
        {
            $avis = Avis::getAllByVendeur($_GET['id']);
            $note = Avis::getNoteByVendeur($_GET['id']);
            $nbr_avis = Avis::countByVendeur($_GET['id']);
            for ($i = 1; $i <= 5; $i++)
            {
                ${"nbr_".$i} = Avis::getPercentageByNote($i, $nbr_avis, $_GET['id']);
            }
            include 'view/utilisateur/avis_recus.inc.php';
        }
    }

    public function get_administration()
    {
        if (isset($_SESSION['user']))
        {
            if (Utilisateurs::getById($_SESSION['user'])->id_droit() == 1)
            {
                $token = $_SESSION['token'];
                include 'view/utilisateur/administration.inc.php';
            }
            else
            {
                header('HTTP/1.1 404 Not Found');
                exit;
            }
        }
        else
        {
            //include 'view/inscription/inscription.inc.php';
            header('HTTP/1.1 404 Not Found');
            exit;
        }
    }
}
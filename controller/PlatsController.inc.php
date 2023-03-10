<?php

require_once('model/Plats.php');
require_once('model/Utilisateurs.php');
require_once('model/Avis.php');
require_once('model/Commandes.php');

class PlatsController
{
    public function get_liste_plats()
    {
        $id_utilisateur = null;
        if (isset($_SESSION['user']))
            $id_utilisateur = $_SESSION['user'];
        $plats = Plats::getAll($id_utilisateur);
        include 'view/plats/liste_plats.inc.php';
    }

    public function get_informations_plat()
    {
        $plat = Plats::getById($_GET['id']);
        if ($plat != null)
        {
            $vendeur = Utilisateurs::getById($plat->id_vendeur());
            $note = Avis::getNoteByVendeur($plat->id_vendeur());
            $nbr_avis = Avis::countByVendeur($plat->id_vendeur());
            include 'view/plats/informations_plat.inc.php';
        }
    }

    public function get_reservation()
    {
        $deja_reserve = (isset($_SESSION['user'])) ? Commandes::countByUserAndPlat($_SESSION['user'], $_GET['id']) : null;

        if ($deja_reserve == 0 || $deja_reserve == null)
        {
            $plat = Plats::getById($_GET['id']);
            $user_connected = (isset($_SESSION['user'])) ? true : false;
            include 'view/plats/reservation.inc.php';
        }
    }

    public function post_reservation()
    {
        $plat = Plats::getById($_POST['id_plat']);
        if ($plat != null)
        {
            $nbr_parts = (isset($_POST['parts'])) ? $_POST['parts'] : null;

            if ($nbr_parts != null)
            {
                if ($nbr_parts <= $plat->parts())
                {
                    $numero_commande = genererNumeroCommande();
                    $cle_commande = genererCleCommande();
                    $montant_total = $nbr_parts * $plat->prix();

                    $c = Commandes::insertOrder($numero_commande, $cle_commande, $plat->id(), $nbr_parts, $montant_total, $_SESSION['user'], date('Y-m-d H:i:s'));

                    $plat->updateParts($plat->parts() - $nbr_parts);
                    $plat->save();

                    echo $c->id();
                }
                else
                    echo "0Vous ne pouvez pas réserver plus de ".$plat->parts(). " part(s) pour ce plat.";
            }
            else
                echo "0Veuillez renseigner le nombre de parts souhaitées.";
        }
        else
            echo "0Il semblerait que le plat souhaité n'existe pas sur le site.";
    }

    public function get_succes_reservation()
    {
        $commande = Commandes::getById($_GET['id']);
        include 'view/plats/succes_reservation.inc.php';
    }
}
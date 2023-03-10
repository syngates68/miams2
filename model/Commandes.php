<?php

require_once('model.php');

class Commandes extends Model
{
    public static $_table = "commandes";

    private $_id;
    private $_numero_commande;
    private $_cle_commande;
    private $_id_plat;
    private $_nombre_parts;
    private $_montant_total;
    private $_id_utilisateur;
    private $_date_commande;
    private $_actif;
    private $_recupere;

    public function __construct($id, $numero_commande, $cle_commande, $id_plat, $nombre_parts, $montant_total, $id_utilisateur, $date_commande, $actif, $recupere)
    {
        $this->set_id($id);
        $this->set_numero_commande($numero_commande);
        $this->set_cle_commande($cle_commande);
        $this->set_id_plat($id_plat);
        $this->set_nombre_parts($nombre_parts);
        $this->set_montant_total($montant_total);
        $this->set_id_utilisateur($id_utilisateur);
        $this->set_date_commande($date_commande);
        $this->set_actif($actif);
        $this->set_recupere($recupere);
    }

    public function id() { return $this->_id; }
    public function numero_commande() { return $this->_numero_commande; }
    public function cle_commande() { return $this->_cle_commande; }
    public function id_plat() { return $this->_id_plat; }
    public function nombre_parts() { return $this->_nombre_parts; }
    public function montant_total() { return $this->_montant_total; }
    public function id_utilisateur() { return $this->_id_utilisateur; }
    public function date_commande() { return $this->_date_commande; }
    public function actif() { return $this->_actif; }
    public function recupere() { return $this->_recupere; }

    public function set_id($id) { $this->_id = (int) $id; }
    public function set_numero_commande($numero_commande) { $this->_numero_commande = $numero_commande; }
    public function set_cle_commande($cle_commande) { $this->_cle_commande = $cle_commande; }
    public function set_id_plat($id_plat) { $this->_id_plat = $id_plat; }
    public function set_nombre_parts($nombre_parts) { $this->_nombre_parts = $nombre_parts; }
    public function set_montant_total($montant_total) { $this->_montant_total = $montant_total; }
    public function set_id_utilisateur($id_utilisateur) { $this->_id_utilisateur = $id_utilisateur; }
    public function set_date_commande($date_commande) { $this->_date_commande = $date_commande; }
    public function set_actif($actif) { $this->_actif = $actif; }
    public function set_recupere($recupere) { $this->_recupere = $recupere; }

    public static function getAllByVendeur($id_vendeur)
    {
        $table = self::$_table;

        $s = self::$_db->prepare("SELECT * FROM commandes WHERE id_plat IN (SELECT id FROM plats WHERE id_vendeur = :id_vendeur) AND recupere = 0 AND actif = 1");
        $s->bindValue(':id_vendeur', $id_vendeur, PDO::PARAM_INT);
        $s->execute();
        $res = [];

        while ($row = $s->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
        {
            array_push($res, new Commandes($row['id'], $row['numero_commande'], $row['cle_commande'], $row['id_plat'], $row['nombre_parts'], $row['montant_total'], $row['id_utilisateur'], $row['date_commande'], $row['actif'], $row['recupere']));
        }

        if (!empty($res))
            return $res;
        else
            return null;
    }

    public static function countByUserAndPlat($id_utilisateur, $id_plat)
    {
        $table = self::$_table;

        $s = self::$_db->prepare("SELECT COUNT(*) as total FROM $table WHERE id_utilisateur = :id_utilisateur AND id_plat = :id_plat AND actif = 1");
        $s->bindValue(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $s->bindValue(':id_plat', $id_plat, PDO::PARAM_INT);
        $s->execute();
        $count = $s->fetch(PDO::FETCH_ASSOC);

        if ($count)
            return $count['total'];
        else
            return null;
    }

    public static function getById($id)
    {
        $table = self::$_table;

        $s = self::$_db->prepare("SELECT * FROM $table WHERE id = :id");
        $s->bindValue(':id', $id, PDO::PARAM_INT);
        $s->execute();
        $data = $s->fetch(PDO::FETCH_ASSOC);

        if ($data)
            return new Commandes($data['id'], $data['numero_commande'], $data['cle_commande'], $data['id_plat'], $data['nombre_parts'], $data['montant_total'], $data['id_utilisateur'], $data['date_commande'], $data['actif'], $data['recupere']);
        else
            return null;
    }

    public static function insertOrder($numero_commande, $cle_commande, $id_plat, $nombre_parts, $montant_total, $id_utilisateur, $date_commande)
    {
        $table = self::$_table;
        
        $s = self::$_db->prepare("INSERT INTO $table (numero_commande, cle_commande, id_plat, nombre_parts, montant_total, id_utilisateur, date_commande) VALUES (:numero_commande, :cle_commande, :id_plat, :nombre_parts, :montant_total, :id_utilisateur, :date_commande)");
        $s->bindValue(':numero_commande', $numero_commande);
        $s->bindValue(':cle_commande', $cle_commande);
        $s->bindValue(':id_plat', $id_plat);
        $s->bindValue(':nombre_parts', $nombre_parts);
        $s->bindValue(':montant_total', $montant_total);
        $s->bindValue(':id_utilisateur', $id_utilisateur);
        $s->bindValue(':date_commande', $date_commande);
        $s->execute();

        return Commandes::getById(parent::db()->lastInsertId());
    }
}
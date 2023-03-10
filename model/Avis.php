<?php

require_once('model.php');

class Avis extends Model
{
    public static $_table = "avis";

    private $_id;
    private $_id_vendeur;
    private $_id_utilisateur;
    private $_note;
    private $_texte_avis;

    public function __construct($id, $id_vendeur, $id_utilisateur, $note, $texte_avis)
    {
        $this->set_id($id);
        $this->set_id_vendeur($id_vendeur);
        $this->set_id_utilisateur($id_utilisateur);
        $this->set_note($note);
        $this->set_texte_avis($texte_avis);
    }

    public function id() { return $this->_id; }
    public function id_vendeur() { return $this->_id_vendeur; }
    public function id_utilisateur() { return $this->_id_utilisateur; }
    public function note() { return $this->_note; }
    public function texte_avis() { return $this->_texte_avis; }

    public function set_id($id) { $this->_id = (int) $id; }
    public function set_id_vendeur($id_vendeur) { $this->_id_vendeur = $id_vendeur; }
    public function set_id_utilisateur($id_utilisateur) { $this->_id_utilisateur = $id_utilisateur; }
    public function set_note($note) { $this->_note = $note; }
    public function set_texte_avis($texte_avis) { $this->_texte_avis = $texte_avis; }

    public static function countByVendeur($id_vendeur)
    {
        $table = self::$_table;

        $s = self::$_db->prepare("SELECT COUNT(*) as total FROM $table WHERE id_vendeur = :id_vendeur");
        $s->bindValue(':id_vendeur', $id_vendeur, PDO::PARAM_INT);
        $s->execute();
        $count = $s->fetch(PDO::FETCH_ASSOC);

        if ($count && $count['total'] > 0)
            return $count['total'];
        else
            return 'Aucune note';
    }

    public static function getNoteByVendeur($id_vendeur)
    {
        $table = self::$_table;

        $s = self::$_db->prepare("SELECT ROUND(SUM(note) / COUNT(*), 1) as moyenne FROM $table WHERE id_vendeur = :id_vendeur");
        $s->bindValue(':id_vendeur', $id_vendeur, PDO::PARAM_INT);
        $s->execute();
        $data = $s->fetch(PDO::FETCH_ASSOC);

        if ($data)
            return $data['moyenne'];
        else
            return 0;
    }

    public static function getAllByVendeur($id_vendeur)
    {
        $table = self::$_table;

        $s = self::$_db->prepare("SELECT * FROM avis WHERE id_vendeur = :id_vendeur");
        $s->bindValue(':id_vendeur', $id_vendeur, PDO::PARAM_INT);
        $s->execute();
        $res = [];

        while ($row = $s->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
        {
            array_push($res, new Avis($row['id'], $row['id_vendeur'], $row['id_utilisateur'], $row['note'], $row['texte_avis']));
        }

        if (!empty($res))
            return $res;
        else
            return null;
    }

    public static function getPercentageByNote($note, $nbr_notes, $id_vendeur)
    {
        $table = self::$_table;

        $s = self::$_db->prepare("SELECT COUNT(*) as total FROM avis WHERE id_vendeur = :id_vendeur AND note = :note");
        $s->bindValue(':id_vendeur', $id_vendeur, PDO::PARAM_INT);
        $s->bindValue(':note', $note, PDO::PARAM_INT);
        $s->execute();
        $count = $s->fetch(PDO::FETCH_ASSOC);

        $percentage = 0;

        if ($count['total'] && $count['total'] > 0 && is_numeric($nbr_notes))
            $percentage = ($count['total'] / $nbr_notes) * 100;

        return $percentage;
    }
}
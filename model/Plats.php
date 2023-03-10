<?php

require_once('model.php');

class Plats extends Model
{
    public static $_table = "plats";

    private $_id;
    private $_nom_plat;
    private $_prix;
    private $_parts;
    private $_heure_limite;
    private $_adresse;
    private $_complement_adresse;
    private $_batiment;
    private $_etage;
    private $_code_postal;
    private $_ville;
    private $_photo_plat;
    private $_note_vendeur;
    private $_id_vendeur;
    private $_date_ajout;

    public function __construct($id, $nom_plat, $prix, $parts, $heure_limite, $adresse, $complement_adresse, $batiment, $etage, $code_postal, $ville, $photo_plat, $note_vendeur, $id_vendeur, $date_ajout)
    {
        $this->set_id($id);
        $this->set_nom_plat($nom_plat);
        $this->set_prix($prix);
        $this->set_parts($parts);
        $this->set_heure_limite($heure_limite);
        $this->set_adresse($adresse);
        $this->set_complement_adresse($complement_adresse);
        $this->set_batiment($batiment);
        $this->set_etage($etage);
        $this->set_code_postal($code_postal);
        $this->set_ville($ville);
        $this->set_photo_plat($photo_plat);
        $this->set_note_vendeur($note_vendeur);
        $this->set_id_vendeur($id_vendeur);
        $this->set_date_ajout($date_ajout);
    }

    public function id() { return $this->_id; }
    public function nom_plat() { return $this->_nom_plat; }
    public function prix() { return $this->_prix; }
    public function parts() { return $this->_parts; }
    public function heure_limite() { return $this->_heure_limite; }
    public function adresse() { return $this->_adresse; }
    public function complement_adresse() { return $this->_complement_adresse; }
    public function batiment() { return $this->_batiment; }
    public function etage() { return $this->_etage; }
    public function code_postal() { return $this->_code_postal; }
    public function ville() { return $this->_ville; }
    public function photo_plat() { return $this->_photo_plat; }
    public function note_vendeur() { return $this->_note_vendeur; }
    public function id_vendeur() { return $this->_id_vendeur; }
    public function date_ajout() { return $this->_date_ajout; }

    public function set_id($id) { $this->_id = (int) $id; }
    public function set_nom_plat($nom_plat) { $this->_nom_plat = $nom_plat; }
    public function set_prix($prix) { $this->_prix = $prix; }
    public function set_parts($parts) { $this->_parts = $parts; }
    public function set_heure_limite($heure_limite) { $this->_heure_limite = $heure_limite; }
    public function set_adresse($adresse) { $this->_adresse = $adresse; }
    public function set_complement_adresse($complement_adresse) { $this->_complement_adresse = $complement_adresse; }
    public function set_batiment($batiment) { $this->_batiment = $batiment; }
    public function set_etage($etage) { $this->_etage = $etage; }
    public function set_code_postal($code_postal) { $this->_code_postal = $code_postal; }
    public function set_ville($ville) { $this->_ville = $ville; }
    public function set_photo_plat($photo_plat) { $this->_photo_plat = $photo_plat; }
    public function set_note_vendeur($note_vendeur) { $this->_note_vendeur = $note_vendeur; }
    public function set_id_vendeur($id_vendeur) { $this->_id_vendeur = $id_vendeur; }
    public function set_date_ajout($date_ajout) { $this->_date_ajout = $date_ajout; }

    public static function getAll($id_utilisateur)
    {
        $table = self::$_table;

        $sql = "SELECT * FROM $table WHERE heure_limite > SYSDATE() AND parts > 0";
        if ($id_utilisateur != null)
            $sql .= " AND id_vendeur != :id_utilisateur";

        $s = self::$_db->prepare($sql);
        if ($id_utilisateur != null)
            $s->bindValue(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $s->execute();
        $res = [];

        while ($row = $s->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
        {
            array_push($res, new Plats($row['id'], $row['nom_plat'], $row['prix'], $row['parts'], $row['heure_limite'], $row['adresse'], $row['complement_adresse'], $row['batiment'], $row['etage'], $row['code_postal'], $row['ville'], $row['photo_plat'], $row['note_vendeur'], $row['id_vendeur'], $row['date_ajout']));
        }

        if (!empty($res))
            return $res;
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
            return new Plats($data['id'], $data['nom_plat'], $data['prix'], $data['parts'], $data['heure_limite'], $data['adresse'], $data['complement_adresse'], $data['batiment'], $data['etage'], $data['code_postal'], $data['ville'], $data['photo_plat'], $data['note_vendeur'], $data['id_vendeur'], $data['date_ajout']);
        else
            return null;
    }

    public function updateParts($parts)
    {
        $this->set_parts($parts);
    }

    public function save()
    {
        if ($this->id() != NULL)
        {
            $table = self::$_table;

            $sql = "UPDATE $table SET parts = :parts WHERE id = :id";

            $s = self::$_db->prepare($sql);
            $s->bindValue(':parts', $this->parts(), PDO::PARAM_INT);
            $s->bindValue(':id', $this->id(), PDO::PARAM_INT);
            $s->execute();
        }
    }
}
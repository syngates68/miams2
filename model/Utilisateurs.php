<?php

require_once('model.php');

class Utilisateurs extends Model
{
    public static $_table = "utilisateurs";

    private $_id;
    private $_nom;
    private $_prenom;
    private $_mail;
    private $_pass;
    private $_photo_profil;
    private $_adresse;
    private $_complement_adresse;
    private $_batiment;
    private $_etage;
    private $_code_postal;
    private $_ville;
    private $_tentatives;
    private $_bloque;
    private $_id_droit;
    private $_date_inscription;
    private $_date_suppression;

    public function __construct($id, $nom, $prenom, $mail, $pass, $photo_profil, $adresse, $complement_adresse, $batiment, $etage, $code_postal, $ville, $tentatives, $bloque, $id_droit, $date_inscription, $date_suppression)
    {
        $this->set_id($id);
        $this->set_nom($nom);
        $this->set_prenom($prenom);
        $this->set_mail($mail);
        $this->set_pass($pass);
        $this->set_photo_profil($photo_profil);
        $this->set_adresse($adresse);
        $this->set_complement_adresse($complement_adresse);
        $this->set_batiment($batiment);
        $this->set_etage($etage);
        $this->set_code_postal($code_postal);
        $this->set_ville($ville);
        $this->set_tentatives($tentatives);
        $this->set_bloque($bloque);
        $this->set_id_droit($id_droit);
        $this->set_date_inscription($date_inscription);
        $this->set_date_suppression($date_suppression);
    }

    public function id() { return $this->_id; }
    public function nom() { return $this->_nom; }
    public function prenom() { return $this->_prenom; }
    public function mail() { return $this->_mail; }
    public function pass() { return $this->_pass; }
    public function photo_profil() { return $this->_photo_profil; }
    public function adresse() { return $this->_adresse; }
    public function complement_adresse() { return $this->_complement_adresse; }
    public function batiment() { return $this->_batiment; }
    public function etage() { return $this->_etage; }
    public function code_postal() { return $this->_code_postal; }
    public function ville() { return $this->_ville; }
    public function tentatives() { return $this->_tentatives; }
    public function bloque() { return $this->_bloque; }
    public function id_droit() { return $this->_id_droit; }
    public function date_inscription() { return $this->_date_inscription; }
    public function date_suppression() { return $this->_date_suppression; }

    public function set_id($id) { $this->_id = (int) $id; }
    public function set_nom($nom) { $this->_nom = $nom; }
    public function set_prenom($prenom) { $this->_prenom = $prenom; }
    public function set_mail($mail) { $this->_mail = $mail; }
    public function set_pass($pass) { $this->_pass = $pass; }
    public function set_photo_profil($photo_profil) { $this->_photo_profil = $photo_profil; }
    public function set_adresse($adresse) { $this->_adresse = $adresse; }
    public function set_complement_adresse($complement_adresse) { $this->_complement_adresse = $complement_adresse; }
    public function set_batiment($batiment) { $this->_batiment = $batiment; }
    public function set_etage($etage) { $this->_etage = $etage; }
    public function set_code_postal($code_postal) { $this->_code_postal = $code_postal; }
    public function set_ville($ville) { $this->_ville = $ville; }
    public function set_tentatives($tentatives) { $this->_tentatives = $tentatives; }
    public function set_bloque($bloque) { $this->_bloque = $bloque; }
    public function set_id_droit($id_droit) { $this->_id_droit = $id_droit; }
    public function set_date_inscription($date_inscription) { $this->_date_inscription = $date_inscription; }
    public function set_date_suppression($date_suppression) { $this->_date_suppression = $date_suppression; }

    public static function getByMail($mail)
    {
        $table = self::$_table;

        $s = self::$_db->prepare("SELECT * FROM $table WHERE mail = :mail");
        $s->bindValue(':mail', $mail, PDO::PARAM_STR);
        $s->execute();
        $data = $s->fetch(PDO::FETCH_ASSOC);

        if ($data)
            return new Utilisateurs($data['id'], $data['nom'], $data['prenom'], $data['mail'], $data['pass'], $data['photo_profil'], $data['adresse'], $data['complement_adresse'], $data['batiment'], $data['etage'], $data['code_postal'], $data['ville'], $data['tentatives'], $data['bloque'], $data['id_droit'], $data['date_inscription'], $data['date_suppression']);
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
            return new Utilisateurs($data['id'], $data['nom'], $data['prenom'], $data['mail'], $data['pass'], $data['photo_profil'], $data['adresse'], $data['complement_adresse'], $data['batiment'], $data['etage'], $data['code_postal'], $data['ville'], $data['tentatives'], $data['bloque'], $data['id_droit'], $data['date_inscription'], $data['date_suppression']);
        else
            return null;
    }

    public function modifier($nom, $prenom, $mail, $adresse, $complement_adresse, $batiment, $etage, $code_postal, $ville)
    {
        $this->set_nom($nom);
        $this->set_prenom($prenom);
        $this->set_mail($mail);
        $this->set_adresse($adresse);
        $this->set_complement_adresse($complement_adresse);
        $this->set_batiment($batiment);
        $this->set_etage($etage);
        $this->set_code_postal($code_postal);
        $this->set_ville($ville);
    }

    public function updateTentatives($tentatives)
    {
        $this->set_tentatives($tentatives);
    }

    public function bloqueUser()
    {
        $this->set_bloque(1);
    }

    public function updatePassword($pass)
    {
        $this->set_pass($pass);
    }

    public function save()
    {
        if ($this->id() != NULL)
        {
            $table = self::$_table;

            $sql = "UPDATE $table SET nom = :nom, prenom = :prenom, mail = :mail, pass = :pass, photo_profil = :photo_profil, adresse = :adresse, complement_adresse = :complement_adresse, batiment = :batiment, etage = :etage, code_postal = :code_postal, ville = :ville, tentatives = :tentatives, bloque = :bloque, date_suppression = :date_suppression WHERE id = :id";

            $s = self::$_db->prepare($sql);
            $s->bindValue(':nom', $this->nom(), PDO::PARAM_STR);
            $s->bindValue(':prenom', $this->prenom(), PDO::PARAM_STR);
            $s->bindValue(':mail', $this->mail(), PDO::PARAM_STR);
            $s->bindValue(':pass', $this->pass(), PDO::PARAM_STR);
            $s->bindValue(':photo_profil', $this->photo_profil(), PDO::PARAM_STR);
            $s->bindValue(':adresse', $this->adresse(), PDO::PARAM_STR);
            $s->bindValue(':complement_adresse', $this->complement_adresse(), PDO::PARAM_STR);
            $s->bindValue(':batiment', $this->batiment(), PDO::PARAM_STR);
            $s->bindValue(':etage', $this->etage(), PDO::PARAM_INT);
            $s->bindValue(':code_postal', $this->code_postal(), PDO::PARAM_STR);
            $s->bindValue(':ville', $this->ville(), PDO::PARAM_STR);
            $s->bindValue(':tentatives', $this->tentatives(), PDO::PARAM_INT);
            $s->bindValue(':bloque', $this->bloque(), PDO::PARAM_INT);
            $s->bindValue(':date_suppression', $this->date_suppression(), PDO::PARAM_STR);
            $s->bindValue(':id', $this->id(), PDO::PARAM_INT);
            $s->execute();
        }
    }

    public static function insertUser($nom, $prenom, $mail, $pass, $date_inscription)
    {
        $table = self::$_table;
        
        $s = self::$_db->prepare("INSERT INTO $table (nom, prenom, mail, pass, date_inscription) VALUES (:nom, :prenom, :mail, :pass, :date_inscription)");
        $s->bindValue(':nom', $nom);
        $s->bindValue(':prenom', $prenom);
        $s->bindValue(':mail', $mail);
        $s->bindValue(':pass', $pass);
        $s->bindValue(':date_inscription', $date_inscription);
        $s->execute();

        return Utilisateurs::getById(parent::db()->lastInsertId());
    }

    public function supprimer()
    {
        $this->set_nom(null);
        $this->set_prenom(null);
        $this->set_mail(null);
        $this->set_pass(null);
        $this->set_photo_profil('assets/utilisateurs/default.png');
        $this->set_adresse(null);
        $this->set_complement_adresse(null);
        $this->set_batiment(null);
        $this->set_etage(null);
        $this->set_code_postal(null);
        $this->set_ville(null);
        $this->set_date_suppression(date('Y-m-d H:i:s'));
    }
}
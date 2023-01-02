<?php

class categories
{
    public $id_categorie;
    public $nom_categorie;
    public $chapo;

    function create()
    {
        $sql = 'INSERT INTO categorie (nom_categorie) VALUES (:nom);';
        $pdo = connexion();
        $query = $pdo->prepare($sql);
        $query->bindValue(':nom', $this->nom_categorie, PDO::PARAM_STR);
        $query->execute();
        $this->id_categorie = $pdo->lastInsertId();
    }


    static function readAll()
    {
        $sql = 'SELECT * FROM `categorie`';
        $pdo = connexion();
        $query = $pdo->prepare($sql);
        $query->execute();
        $tableau = $query->fetchAll(PDO::FETCH_CLASS, 'categories');
        return $tableau;
    }



    static function readOne($id)
    {
      $sql = 'select * from categorie where id_categorie = :valeur';
      $pdo = connexion();
      $query = $pdo->prepare($sql);
      $query->bindValue(':valeur', $id, PDO::PARAM_INT);
      $query->execute();
      $objet = $query->fetchObject('categories');
      return $objet;
    }

    function chargePOST()
    {
        $this->id_categorie = $_POST['id_categorie'];
        $this->nom_categorie = $_POST['nom_categorie'];
        $this->chapo = $_POST['chapo'];

    }

    function update()
    {
        $sql = 'UPDATE categorie SET nom_categorie = :nom, chapo =:chapo WHERE id_categorie = :id;';
        $pdo = connexion();
        $query = $pdo->prepare($sql);
        $query->bindValue(':nom', $this->nom_categorie, PDO::PARAM_STR);
        $query->bindValue(':chapo', $this->chapo, PDO::PARAM_STR);
        $query->bindValue(':id', $this->id_categorie, PDO::PARAM_INT);
        $query->execute();
    }

    function delete()
    {
        $sql = 'DELETE FROM categorie WHERE id_categorie = :id;';
        $pdo = connexion();
        $query = $pdo->prepare($sql);
        $query->bindValue(':id', $this->id_categorie, PDO::PARAM_INT);
        $query->execute();
    }
}

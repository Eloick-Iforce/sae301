<?php

class categories
{
    public $id_categorie;
    public $nom_categorie;

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
        $sql = 'SELECT * from article where id_categorie = :valeur';
        $pdo = connexion();
        $query = $pdo->prepare($sql);
        $query->bindValue(':valeur', $id, PDO::PARAM_INT);
        $query->execute();
        $tableau = $query->fetchAll(PDO::FETCH_CLASS, 'article');
        return $tableau;
    }

    function chargePOST()
    {
        $this->id_categorie = $_POST['id_categorie'];
        $this->nom_categorie = $_POST['nom_categorie'];
    }

    function update()
    {
        $sql = 'UPDATE categorie SET nom_categorie = :nom WHERE id_categorie = :id;';
        $pdo = connexion();
        $query = $pdo->prepare($sql);
        $query->bindValue(':nom', $this->nom_categorie, PDO::PARAM_STR);
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

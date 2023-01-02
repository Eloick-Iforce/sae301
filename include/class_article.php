<?php
class article
{

  public $id_article;
  public $titre;
  public $chapo;
  public $auteur;
  public $phrase;




  function create()
  {
    $sql = 'INSERT INTO article (titre, phrase, chapo, auteur, id_categorie, id_sous_categorie) VALUES (:titre, :phrase, :chapo, :auteur, :id_categorie, :id_sous_categorie)';
    $pdo = connexion();
    $query = $pdo->prepare($sql);
    $query->bindValue(':titre', $this->titre, PDO::PARAM_STR);
    $query->bindValue(':chapo', $this->chapo, PDO::PARAM_STR);
    $query->bindValue(':auteur', $this->auteur, PDO::PARAM_STR);
    $query->bindValue(':id_categorie', $this->id_categorie, PDO::PARAM_INT);
    $query->bindValue(':id_sous_categorie', $this->id_sous_categorie, PDO::PARAM_INT);
    $query->bindValue(':phrase', $this->phrase, PDO::PARAM_STR);
    $query->execute();
    $this->id_article = $pdo->lastInsertId();
  }

  function modifier($a, $b)
  {
    $this->titre = $a;
    $this->chapo = $b;
  }

  static function readAll()
  {
    $sql = 'SELECT * FROM `article`';
    $pdo = connexion();
    $query = $pdo->prepare($sql);
    $query->execute();
    $tableau = $query->fetchAll(PDO::FETCH_CLASS, 'article');
    return $tableau;
  }

  static function readOne($id)
  {
    $sql = 'select * from article where id_article = :valeur';
    $pdo = connexion();
    $query = $pdo->prepare($sql);
    $query->bindValue(':valeur', $id, PDO::PARAM_INT);
    $query->execute();
    $objet = $query->fetchObject('article');
    return $objet;
  }

  static function readByCategorie($id)
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
    $this->id_article = $_POST['id_article'];
    $this->id_categorie = $_POST['id_categorie'];
    if (isset($_POST['id_sous_categorie']) && $_POST['id_sous_categorie'] == 0) {
    $this->id_sous_categorie = $_POST['id_sous_categorie2'];
    } else {
    $this->id_sous_categorie = $_POST['id_sous_categorie'];
    }
    $this->titre = $_POST['titre'];
    $this->chapo = $_POST['chapo'];
    $this->auteur = $_POST['auteur'];
    $this->phrase = $_POST['phrase'];
  }
  function update()
  {
    $sql = 'UPDATE article SET titre = :titre, phrase=:phrase, chapo = :chapo, auteur = :auteur WHERE id_article = :id_article;';
    $pdo = connexion();
    $query = $pdo->prepare($sql);
    $query->bindValue(':id_article', $this->id_article, PDO::PARAM_INT);
    $query->bindValue(':titre', $this->titre, PDO::PARAM_STR);
    $query->bindValue(':phrase', $this->phrase, PDO::PARAM_STR);
    $query->bindValue(':chapo', $this->chapo, PDO::PARAM_STR);
    $query->bindValue(':auteur', $this->auteur, PDO::PARAM_STR);


    $query->execute();
  }

  static function delete($id)
  {
    $sql = 'DELETE FROM article WHERE id_article = :id_article;';

    $pdo = connexion();

    $query = $pdo->prepare($sql);

    $query->bindValue(':id_article', $id, PDO::PARAM_INT);

    $query->execute();
  }
}

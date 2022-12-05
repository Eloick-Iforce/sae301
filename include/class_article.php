<?php
class article
{

  public $id_article;
  public $titre;
  public $chapo;
  public $auteur;




  function create()
  {
    $sql = 'INSERT INTO article (titre, chapo, auteur) VALUES (:titre, :chapo, :auteur);';
    $pdo = connexion();
    $query = $pdo->prepare($sql);
    $query->bindValue(':titre', $this->titre, PDO::PARAM_STR);
    $query->bindValue(':chapo', $this->chapo, PDO::PARAM_STR);
    $query->bindValue(':auteur', $this->auteur, PDO::PARAM_STR);
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
    $sql = 'select * from article';
    $pdo = connexion();
    $query = $pdo->prepare($sql);
    $query->execute();
    $tableau = $query->fetchAll(PDO::FETCH_CLASS, 'article');
    return $tableau;
  }
  function affiche()
  {
    echo '<h2>' . $this->titre . '</h2>';
    echo '<p>' . $this->chapo . '</p>';
    echo '<p>' . $this->auteur . '</p>';
    echo '<a href="controleur.php?page=articles&action=edit&id=' . $this->id_article . '"><i class="bi bi-pen"></i></a>
    <a href="controleur.php?page=articles&action=delete&id=' . $this->id_article . '"><i class="bi bi-trash"></i></a>';
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
  function chargePOST()
  {
    $this->id_article = $_POST['id_article'];
    $this->titre = $_POST['titre'];
    $this->chapo = $_POST['chapo'];
    $this->auteur = $_POST['auteur'];
  }
  function update()
  {
    $sql = 'UPDATE article SET titre = :titre, chapo = :chapo, auteur = :auteur WHERE id_article = :id_article;';
    $pdo = connexion();
    $query = $pdo->prepare($sql);
    $query->bindValue(':id_article', $this->id_article, PDO::PARAM_INT);
    $query->bindValue(':titre', $this->titre, PDO::PARAM_STR);
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

<?php
class elements
{
  public $element_id;
  public $id_article;
  public $balise;
  public $contenu;
  public $style;
  public $src;
  public $alt;



  function create($id)
  {
    $sql = 'INSERT INTO elements (balise_elements, contenu, id_article) VALUES (:balise, :contenu, :id_article);';
    $pdo = connexion();
    $query = $pdo->prepare($sql);
    $query->bindValue(':id_article', $id, PDO::PARAM_STR);
    $query->bindValue(':balise', $this->balise, PDO::PARAM_STR);
    $query->bindValue(':contenu', $this->contenu, PDO::PARAM_STR);
    $query->execute();
    $this->id = $pdo->lastInsertId();
  }

  function modifier($a, $b)
  {
    $this->balise = $a;
    $this->contenu = $b;
  }

  static function readAll()
  {
    $sql = 'select * from elements';
    $pdo = connexion();
    $query = $pdo->prepare($sql);
    $query->execute();
    $tableau = $query->fetchAll(PDO::FETCH_CLASS, 'elements');
    return $tableau;
  }

  static function readOne($id)
  {
    $sql = 'select * from elements where id_article = :valeur';
    $pdo = connexion();
    $query = $pdo->prepare($sql);
    $query->bindValue(':valeur', $id, PDO::PARAM_INT);
    $query->execute();
    $tableau = $query->fetchAll(PDO::FETCH_CLASS, 'elements');
    return $tableau;
  }
  function chargePOST()
  {
    $this->balise = $_POST['balise'];
    $this->contenu = $_POST['contenu'];
    if (isset($_GET['id_articles'])) $this->id_article = intval($_GET['id_articles']);
    else $this->id_article = 0;
    if (isset($_GET['id_elements'])) $this->id_elements = intval($_GET['id_elements']);
else $this->id_elements = 0;
  }
  function update($id)
  {
    $sql = 'UPDATE `elements` SET balise_elements = :balise, contenu = :contenu WHERE `elements`.`id_elements` = :id;';
    $pdo = connexion();
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->bindValue(':balise', $this->balise, PDO::PARAM_STR);
    $query->bindValue(':contenu', $this->contenu, PDO::PARAM_STR);
    $query->execute();
  }

  static function delete($id)
  {
    $sql = 'DELETE FROM elements WHERE id_elements = :id;';

    $pdo = connexion();

    $query = $pdo->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query->execute();
  }
}
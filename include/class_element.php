<?php
class elements
{
  public $id_elements;
  public $id_article;
  public $balise;
  public $contenu;
  public $contenu2;
  public $style;
  public $src;
  public $alt;

function __construct()
{
  if (is_null($this->style)){
    $this->style = '';
  }
  if (is_null($this->contenu2)){
    $this->style = '';
  }
  if (is_null($this->balise)){
    $this->style = 'p';
  }
}

  function create($id)
  {
    $sql = 'INSERT INTO elements (balise, contenu, id_article, contenu2, style) VALUES (:balise, :contenu, :id_article, :contenu2, :style);';
    $pdo = connexion();
    $query = $pdo->prepare($sql);
    $query->bindValue(':id_article', $id, PDO::PARAM_STR);
    $query->bindValue(':balise', $this->balise, PDO::PARAM_STR);
    $query->bindValue(':contenu', $this->contenu, PDO::PARAM_STR);
    $query->bindValue(':contenu2', $this->contenu2, PDO::PARAM_STR);
    $query->bindValue(':style', $this->style, PDO::PARAM_STR);
    $query->execute();
    $this->id = $pdo->lastInsertId();
  }

  function modifier($a, $b)
  {
    $this->balise = $a;
    $this->contenu = $b;
  }

  static function readOne($id)
  {
    $sql = 'select * from elements where id_elements = :valeur';
    $pdo = connexion();
    $query = $pdo->prepare($sql);
    $query->bindValue(':valeur', $id, PDO::PARAM_INT);
    $query->execute();
    $objet = $query->fetchObject('elements');
    return $objet;
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

  static function readByArticle($id)
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
    $this->contenu2 = $_POST['contenu2'];
    $this->style = $_POST['style'];
    if (isset($_GET['id_articles'])) $this->id_article = intval($_GET['id_articles']);
    else $this->id_article = 0;
    if (isset($_GET['id_elements'])) $this->id_elements = intval($_GET['id_elements']);
else $this->id_elements = 0;
  }
  function update($id)
  {
    $sql = 'UPDATE `elements` SET balise = :balise, contenu = :contenu, contenu2 = :contenu2, style = :style WHERE `elements`.`id_elements` = :id;';
    $pdo = connexion();
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->bindValue(':balise', $this->balise, PDO::PARAM_STR);
    $query->bindValue(':contenu', $this->contenu, PDO::PARAM_STR);
    $query->bindValue(':contenu2', $this->contenu2, PDO::PARAM_STR);
    $query->bindValue(':style', $this->style, PDO::PARAM_STR);
    $query->execute();
  }

  static function delete($id)
  {
    $element = elements::readOne($id);
    unlink($element->src);
    $sql = 'DELETE FROM elements WHERE id_elements = :id;';

    $pdo = connexion();

    $query = $pdo->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query->execute();

  }
}
<?php
class element
{
  public $element_id;
  public $id_article;
  public $balise;
  public $contenu;
  public $style;
  public $src;
  public $alt;



  function create()
  {
    $sql = 'INSERT INTO elements (balise, contenu, id_article) VALUES (:balise, :contenu, :id_article);';
    $pdo = connexion();
    $query = $pdo->prepare($sql);
    $query->bindValue(':id_article', $this->id_article, PDO::PARAM_STR);
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
    $tableau = $query->fetchAll(PDO::FETCH_CLASS, 'element');
    return $tableau;
  }

  static function readOne($id)
  {
    $sql = 'select * from elements where id_article = :valeur';
    $pdo = connexion();
    $query = $pdo->prepare($sql);
    $query->bindValue(':valeur', $id, PDO::PARAM_INT);
    $query->execute();
    $tableau = $query->fetchAll(PDO::FETCH_CLASS, 'element');
    return $tableau;
  }
  function chargePOST()
  {
    $this->balise = $_POST['balise'];
    $this->contenu = $_POST['contenu'];
    $this->id_article = $_POST['id_article'];
  }
  function update()
  {
    $sql = 'UPDATE elements SET balise = :balise, contenu = :contenu WHERE element_id = :id;';
    $pdo = connexion();
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $this->id, PDO::PARAM_INT);
    $query->bindValue(':balise', $this->balise, PDO::PARAM_STR);
    $query->bindValue(':contenu', $this->contenu, PDO::PARAM_STR);
    $query->execute();
  }

  static function delete($id)
  {
    $sql = 'DELETE FROM elements WHERE element_id = :id;';

    $pdo = connexion();

    $query = $pdo->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query->execute();
  }

  function afficheForm()
  {
    echo '<h2>Modification d\'un contenu</h2>';
    echo 'Modification d\'un contenu';
    echo '<form method=post action="controleur.php?page=elements&action=update">';
    echo '<input type="hidden" name="id" value="' . $this->id . '">';
    echo '<input type="text" name="style" value="' . $this->style . '">';
    echo '<select name="balise" id="balise">
    <option value="p">paragraphe</option>
    <option value="h1">h1</option>
    <option value="h2">h2</option>
    <option value="h3">h3</option>
    </select>';
    echo '<input type="text" name="contenu" value="' . $this->contenu . '">';
    echo '<input type="submit" value="Modifier">';
    echo '</form>';
  }

}
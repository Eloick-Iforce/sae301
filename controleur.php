<?php


include('include/twig.php');
$twig = init_twig();


include('include/connexion.php');
include('include/class_element.php');
include('include/class_article.php');
include('include/class_categorie.php');

if (isset($_GET['page'])) $page = $_GET['page'];
else $page = '';
if (isset($_GET['action'])) $action = $_GET['action'];
else $action = 'read';
if (isset($_GET['id'])) $id = intval($_GET['id']);
else $id = 0;

switch ($page) {

  case 'elements':
    switch ($action) {
      case 'read':
        $view = 'article.twig';
        $data = elements::readAll();
        break;
      case 'create':
        $article = new elements();
        $article->chargePOST();
        $id = intval($_POST['id_article']);
        $article->create($id);
        header('Location: controleur.php?page=elements&action=edit&id=' . $id);
        break;
      case 'delete':
        $id = intval($_POST['element_id']);
        elements::delete($id);
        $id = intval($_POST['id_article']);
        header('Location: controleur.php?page=elements&action=edit&id=' . $id);
        break;
      case 'update':
        $elements = new elements();
        $idelementdemerde = intval($_POST['id_elements']);
        $elements->chargePOST();
        $elements->update($idelementdemerde);
        $id = intval($_POST['id_article']);
        $view = 'edition.twig';
        $elements = elements::readByArticle($id);
        $data = [
          'id' => $id,
          'elements' => $elements,
        ];
        break;
      case 'upload':
        if (isset($_POST['submit']) && isset($_FILES['my_image'])) {


          echo "<pre>";
          print_r($_FILES['my_image']);
          echo "</pre>";

          $img_name = $_FILES['my_image']['name'];
          $img_size = $_FILES['my_image']['size'];
          $tmp_name = $_FILES['my_image']['tmp_name'];
          $error = $_FILES['my_image']['error'];

          if ($error === 0) {
            if ($img_size > 12500000) {
              $em = "Trop gros";
              header("Location: index.php?error=$em");
            } else {
              $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
              $img_ex_lc = strtolower($img_ex);

              $allowed_exs = array("jpg", "jpeg", "png", "gif", "svg", "webp", "mp4", "mp3",'wav');

              if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("File-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'uploads/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                // Insert into Database
                $id_article = intval($_POST['id_article']);
                $balise_article = $_POST['balise'];
                $contenu = $_POST['contenu'];
                $contenu2 = $_POST['contenu2'];
                $style = $_POST['style'];

                $sql = 'INSERT INTO elements(balise, src, id_article, contenu, contenu2, style) VALUES (:balise, :src, :valeur,:contenu,:contenu2, :style);';
                $pdo = connexion();
                $query = $pdo->prepare($sql);
                $query->bindValue(':valeur', $id_article, PDO::PARAM_STR);
                $query->bindValue(':balise', $balise_article, PDO::PARAM_STR);
                $query->bindValue(':src', $new_img_name, PDO::PARAM_STR);
                $query->bindValue(':contenu', $contenu, PDO::PARAM_STR);
                $query->bindValue(':contenu2', $contenu2, PDO::PARAM_STR);
                $query->bindValue(':style', $style, PDO::PARAM_STR);
                $query->execute();
                header("Location: index.php");
              } else {
                $em = "Pas du bon type, faut essayer le type feu";
                header("Location: index.php?error=$em");
              }
            }
          } else {
            $em = "unknown error occurred!";
            header("Location: index.php?error=$em");
          }
        } else {
          header("Location: index.php");
        }
        break;
      case 'edit':
        $id = intval($id);
        $view = 'edition.twig';
        $elements = elements::readByArticle($id);
        $categorie = categories::readAll();
        $data = [
          'id' => $id,
          'elements' => $elements,
          'categorie' => $categorie
        ];
        break;
    }
    break;

  case 'article':
    switch ($action) {
      case 'read':
        if ($id > 0) {
          $article = article::readOne($id);
          $contenu = elements::readByArticle($id);
          $categories = categories::readAll();
          $view = 'article.twig';
          $data = [
            'elements' => $contenu,
            'article' => $article,
            'categories' => $categories
          ];
        } else {
          $view = 'base.twig';
          $contenu = article::readAll();
          $data = [
            'article' => $contenu
          ];
        }
        break;
      case 'create':
        $article = new article();
        $article->chargePOST();
        $article->create();
        $view = 'base.twig';
        $contenu = article::readAll();
        $data = [
          'article' => $contenu,
        ];
        break;
      case 'delete':
        article::delete($id);
        header('Location: controleur.php?page=article');
        break;
      case 'update':
        $article = new article();
        $article->chargePOST();
        $article->update();
        header('Location: controleur.php?page=article');
        break;
      case 'new':
        $view = 'new.twig';
        $categories = categories::readAll();
        $article = article::readAll();
        $data = [
          'categories' => $categories,
          'articles' =>$article
        ];
        break;
    }
    break;
  default:
    $view = 'accueil.twig';
    $categorie = categories::readAll();
    $contenu = NULL;
    $data = [
      'article' => $contenu,
      'categorie' => $categorie
    ];
    break;
  case 'categorie':
    switch ($action) {
      case 'read':
        if ($id > 0) {
          $view = 'base.twig';
          $categories = categories::readAll();
          $contenu = article::readByCategorie($id);
          $categorie = categories::readOne($id);

          $data = [
            'categories' => $categories,
            'articles' => $contenu,
            'categorie' => $categorie
          ];
          break;
        } else {
          $view = 'base.twig';
          $categorie = categories::readAll();
          $data = [
            'categorie' => $categorie
          ];
          break;

        }
      case 'update':
        $categorie = new categories();
        $categorie->chargePOST();
        $categorie->update();
        header('Location: controleur.php?page=article');
        break;
    }
    break;
}


echo $twig->render($view, $data);

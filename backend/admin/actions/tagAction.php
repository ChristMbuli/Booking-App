<?php
$route = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'connexion.php';
include $route;

if (isset($_POST['add'])) {
    if (!empty($_POST['tag'])) {
        $tag = htmlspecialchars($_POST['tag']);

        $req = $conn->prepare('INSERT INTO tags(tag) VALUES(?)');
        $req->execute(array($tag));

        $msgSuccess = "Tag ajoutez avec success !";
    } else {
        $msgError = "Veillez entrez un tag";
    }
}
/////////////////////
//Afficher tous les tags

$show = $conn->prepare("SELECT * FROM tags ORDER BY id_tag DESC");
$show->execute();
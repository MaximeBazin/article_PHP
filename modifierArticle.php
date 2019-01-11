<?php

require_once 'connexionbdd.php';
if (!empty($_POST)){
    $result = $pdo->prepare('UPDATE articles SET artTitre = :artTitre, artContenu = :artContenu WHERE idarticle = :idarticle');
    $result->execute([
        'idarticle' => $_POST['id'],
        'artTitre' => $_POST['artTitre'],
        'artContenu' => $_POST['artContenu'],
    ]);
    header('Location: modifierArticle.php?id='.$_POST['id']);
}
else {
    $result = $pdo->prepare('SELECT * FROM articles WHERE idarticle = :idarticle');
    $result->execute([
        'idarticle' => $_GET['id']
    ]);
    $article = $result->fetch(PDO::FETCH_ASSOC);
}
?>
<link rel="stylesheet" href="style.css">

<form action="modifierArticle.php" method="post">

    <input type="text" name="artTitre" value="<?= $article['artTitre']?>"><br>
    <textarea name="artContenu" rows="8" cols="80"><?= $article['artContenu']?></textarea><br>
    <input type="hidden" name="id" value="<?= $article['idarticle']?>">
    <input type="submit" value="modifier">
    <a href="afficheArticle.php?id=<?= $article['idarticle']?>">Retour</a>

</form>

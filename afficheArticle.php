<?php
require_once 'connexionbdd.php';
if (!empty($_POST)){

    $result = $pdo->query('SELECT * FROM articles');
    $req = $pdo->prepare('INSERT INTO articles(artTitre, artContenu, artDate) VALUES (:titre, :contenu)');
    $req->execute([
        'titre' => $_POST['artTitre'],
        'contenu' => $_POST['artContenu']
    ]);
    header('Location: afficheArticle.php');
}

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>aticles</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php
    $result = $pdo->prepare('SELECT * FROM articles WHERE idarticle = :idarticle');
    $result->execute([
        'idarticle'=> $_GET['id']
    ]);
    $article = $result->fetch(PDO::FETCH_ASSOC);

    ?>
    <tbody>
        <tr>
            <td><?= $article['artTitre']?></td>
            <br><br>
            <td><?= $article['artContenu']?>

                <?php
                session_start();
                if (isset($_SESSION['idutilisateur'])) {
                    require_once 'verification.php';
                    ?>
                    <br><br>
                    <td><a href="modifierArticle.php?id=<?= $article['idarticle'] ?>">modifier</a></td></br>

                    <td><a href="supprimerArticle.php?id=<?= $article['idarticle'] ?>">Supprimer</a></td>
                    <p><a href="deconnexion.php">Se déconnecter</a></p>
                    <br><br>
                <?php } else {?>
                    <p><a href="connexion.php">Se connecter</a></p>
                <?php }?>
            </tr>

        </tbody>

        <a href="index.php">Retour</a>
        <?php
        $result = $pdo->query('SELECT * FROM commentaires');
        $articles= $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($articles as $article){ ?>

            <form class="commentaire" action="afficheArticle.php" method="post">
                <input type="text" name="artPseudo" placeholder="Pseudo" required><br>
                <textarea name="artCommentaire" rows="8" cols="80"><?= $article['artCommentaire']?></textarea>
            </form>
        <?php } ?>
        <?php ?>

        <br>




    </body>
    </html>

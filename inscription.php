<?php
require_once 'connexionbdd.php';
session_start();
if (isset($_SESSION['idutilsateur']) && isset($_SESSION['utiLogin'])) {
    header('Location: index.php');
}
if (!empty($_POST)){
    $req = $pdo->prepare('INSERT INTO utilisateurs (utiNom, utiPrenom, utiLogin, utiMdp)
    VALUES (:utiNom, :utiPrenom, :utiLogin, :utiMdp)');
    $req->execute([
        'utiNom' => $_POST['utiNom'],
        'utiPrenom' => $_POST['utiPrenom'],
        'utiLogin' => $_POST['utiLogin'],
        'utiMdp' => password_hash($_POST['utiMdp'], PASSWORD_DEFAULT),
    ]);
    header('Location: connexion.php');
}
?>
<form action="inscription.php" method="POST">
    <label for="utiNom">Nom : </label> <input type="text" name="utiNom" id="nom"><br>
    <label for="utiPrenom">Prénom : </label> <input type="text" name="utiPrenom" id="prenom"><br>
    <label for="utiLogin">Login : </label> <input type="text" name="utiLogin" id="login"><br>
    <label for="utiMdp">Mot de passe : </label> <input type="password" name="utiMdp" id="motdepasse"><br>
    <input type="submit" value="S'inscrire">
</form>
<p><a href="connexion.php">J'ai déjà un compte</a></p>

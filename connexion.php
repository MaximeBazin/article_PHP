<?php
require_once 'connexionbdd.php';
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['utiLogin'])) {
    header('Location: index.php');
}
if (!empty($_POST)){
    $req = $pdo->prepare('SELECT * FROM utilisateurs WHERE utiLogin = :utiLogin');
    $req->execute([
        'utiLogin' => $_POST['utiLogin']
    ]);
    $res = $req->fetch(PDO::FETCH_ASSOC);
    $mdpCorrect = password_verify($_POST['utiMdp'], $res['utiMdp']);
    if (!$res || !$mdpCorrect) {
        echo 'Mauvais login ou mot de passe !';
    } else {
        $_SESSION['idutilisateur'] = $res['idutilisateur'];
        $_SESSION['utiLogin'] = $res['utiLogin'];
        header('Location: index.php');
    }
}
?>

<form action="connexion.php" method="POST">
    <label for="utiLogin">Login : </label><input type="text" name="utiLogin" id="login"><br>
    <label for="utiMdp">Mot de passe : </label><input type="password" name="utiMdp" id="motdepasse"><br>
    <input type="submit" value="Se connecter">
</form>
<p><a href="inscription.php">Je n'ai pas encore de compte</a></p>
<p> <a href="index.php">Acceder aux articles</a> </p>

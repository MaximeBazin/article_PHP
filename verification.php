<?php

if (!isset($_SESSION['idutilisateur']) && !isset($_SESSION['utiLogin'])) {
    header('Location: connexion.php');
}
?>

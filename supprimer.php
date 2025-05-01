<?php
session_start();

if (!isset($_SESSION['user']) || !in_array($_SESSION['user'], ['chaima', 'samia'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $bdd = new PDO("mysql:host=localhost;dbname=test;charset=utf8", "root", "");
    $stmt = $bdd->prepare("DELETE FROM utilisateurs WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: lister.php");
exit();
?>

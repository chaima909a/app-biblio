<?php
session_start();
if (!isset($_SESSION['user']) || !in_array($_SESSION['user'], ['chaima', 'samia'])) {
    header("Location: login.php");
    exit();
}

$bdd = new PDO("mysql:host=localhost;dbname=test;charset=utf8", "root", "");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM livres ORDER BY id DESC";
$stmt = $bdd->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des livres</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fff0f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(255, 105, 180, 0.3);
        }

        h2 {
            text-align: center;
            color: #e91e63;
        }

        .livres-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 30px;
        }

        .livre-card {
            background-color: #ffe4ec;
            border-left: 6px solid #f06292;
            padding: 15px;
            border-radius: 10px;
        }

        .livre-card h4 {
            margin: 0 0 5px;
            color: #c2185b;
        }

        .livre-card p {
            margin: 3px 0;
            color: #6d1b7b;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 30px;
            color: #d81b60;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>📚 Liste des livres</h2>

        <div class="livres-list">
            <?php while ($livre = $stmt->fetch()) : ?>
                <div class="livre-card">
                    <h4><?php echo htmlspecialchars($livre['titre']); ?></h4>
                    <p>✍️ Auteur : <?php echo htmlspecialchars($livre['auteur']); ?></p>
                    <p>📅 Année : <?php echo htmlspecialchars($livre['annee_publication']); ?></p>
                </div>
            <?php endwhile; ?>
        </div>

        <a class="back-link" href="lister.php">⬅ Retour à l'accueil</a>
    </div>

</body>
</html>

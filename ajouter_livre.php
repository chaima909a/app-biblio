<?php
session_start();

// Sécurité : accès réservé
if (!isset($_SESSION['user']) || !in_array($_SESSION['user'], ['chaima', 'samia'])) {
    header("Location: login.php");
    exit();
}

// Connexion à la base
$bdd = new PDO("mysql:host=localhost;dbname=test;charset=utf8", "root", "");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'] ?? '';
    $auteur = $_POST['auteur'] ?? '';
    $annee = $_POST['annee'] ?? '';

    if (!empty($titre) && !empty($auteur) && !empty($annee)) {
        $insert = $bdd->prepare("INSERT INTO livres (titre, auteur, annee) VALUES (?, ?, ?)");
        $insert->execute([$titre, $auteur, $annee]);
        header("Location: ajouter_livre.php"); // Recharge proprement
        exit();
    }
}

// Récupération des livres
$sql = "SELECT * FROM livres ORDER BY id DESC";
$stmt = $bdd->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un livre</title>
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

        h2, h3 {
            text-align: center;
            color: #e91e63;
        }

        form {
            margin-bottom: 40px;
        }

        label {
            display: block;
            margin-top: 15px;
            color: #6a1b9a;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-top: 5px;
        }

        button {
            margin-top: 20px;
            background-color: #f06292;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
        }

        .livres-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
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
        <h2>📘 Ajouter un nouveau livre</h2>

        <form method="POST">
            <label>Titre :
                <input type="text" name="titre" required>
            </label>

            <label>Auteur :
                <input type="text" name="auteur" required>
            </label>

            <label>Année :
                <input type="number" name="annee" required>
            </label>

            <button type="submit">➕ Ajouter</button>
        </form>

        <h3>📚 Liste des livres enregistrés</h3>
        <div class="livres-list">
            <?php while ($livre = $stmt->fetch()) : ?>
                <div class="livre-card">
                    <h4><?php echo htmlspecialchars($livre['titre']); ?></h4>
                    <p>✍️ Auteur : <?php echo htmlspecialchars($livre['auteur']); ?></p>
                    <p>📅 Année : <?php echo htmlspecialchars($livre['annee']); ?></p>
                </div>
            <?php endwhile; ?>
        </div>

        <a class="back-link" href="lister.php">⬅ Retour à l'accueil</a>
    </div>


</body>
</html>

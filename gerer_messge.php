<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'chaima') {
    header("Location: login.php");
    exit();
}

$bdd = new PDO("mysql:host=localhost;dbname=test;charset=utf8", "root", "");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM messages ORDER BY id DESC";
$messages = $bdd->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les messages</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fff0f5;
            margin: 0;
            padding: 30px;
        }

        h2 {
            color: #d81b60;
            text-align: center;
            margin-bottom: 30px;
        }

        .message-container {
            max-width: 700px;
            margin: 0 auto;
        }

        .message-card {
            background: #fff;
            border-left: 6px solid #ec407a;
            box-shadow: 0 4px 8px rgba(236, 64, 122, 0.2);
            padding: 20px 25px;
            margin-bottom: 20px;
            border-radius: 12px;
        }

        .message-card p {
            margin: 8px 0;
            color: #444;
        }

        .message-card strong {
            color: #c2185b;
        }

        .back-link {
            text-align: center;
            margin-top: 40px;
        }

        .back-link a {
            text-decoration: none;
            color: #ad1457;
            font-weight: bold;
            font-size: 16px;
            border: 2px solid #f06292;
            padding: 8px 16px;
            border-radius: 30px;
            background-color: #fce4ec;
            transition: 0.3s;
        }

        .back-link a:hover {
            background-color: #f8bbd0;
        }
    </style>
</head>
<body>
    <h2>📥 Messages reçus</h2>

    <div class="message-container">
        <?php while ($msg = $messages->fetch()) : ?>
            <div class="message-card">
                <p><strong>💌 Nom :</strong> <?= htmlspecialchars($msg['nom']) ?></p>
                <p><strong>📧 Email :</strong> <?= htmlspecialchars($msg['email']) ?></p>
                <p><strong>📝 Message :</strong><br><?= nl2br(htmlspecialchars($msg['contenu'])) ?></p>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="back-link">
        <a href="admin.php">⬅ Retour à l'administration</a>
    </div>
</body>
</html>

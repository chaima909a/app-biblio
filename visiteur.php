<?php
$bdd = new PDO("mysql:host=localhost;dbname=test;charset=utf8", "root", "");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupérer les livres
$livres = $bdd->query("SELECT * FROM livres ORDER BY id DESC");

// Gérer l'envoi du message
$confirmation = '';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $contenu = htmlspecialchars($_POST['contenu']);

    if ($nom && $email && $contenu) {
        $stmt = $bdd->prepare("INSERT INTO messages (nom, email, contenu) VALUES (?, ?, ?)");
        $stmt->execute([$nom, $email, $contenu]);
        $confirmation = "✨ Votre message a été envoyé avec succès 💌";
    } else {
        $confirmation = "⚠️ Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bienvenue Visiteur</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fff0f5;
            padding: 30px;
            margin: 0;
        }

        h2, h3 {
            text-align: center;
            color: #e91e63;
            font-weight: bold;
        }

        .livres-container {
            max-width: 800px;
            margin: auto;
            margin-bottom: 40px;
        }

        .livre {
            background-color: #ffe4ec;
            border-left: 6px solid #f06292;
            padding: 15px 20px;
            margin-bottom: 15px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(240, 98, 146, 0.1);
        }

        .livre h4 {
            margin: 0;
            color: #ad1457;
        }

        .livre p {
            margin: 8px 0 0;
            color: #6d1b7b;
        }

        .formulaire {
            background-color: #f8bbd0;
            padding: 25px 30px;
            border-radius: 20px;
            max-width: 600px;
            margin: 30px auto;
            box-shadow: 0 6px 12px rgba(240, 98, 146, 0.2);
        }

        .formulaire label {
            font-weight: bold;
            color: #6d1b7b;
        }

        .formulaire input,
        .formulaire textarea {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 10px;
            background-color: #fff0f5;
            font-size: 15px;
        }

        .formulaire button {
            background-color: #e91e63;
            color: white;
            border: none;
            padding: 14px 24px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .formulaire button:hover {
            background-color: #d81b60;
        }

        .confirmation {
            text-align: center;
            color: #4caf50;
            font-weight: bold;
            margin-bottom: 20px;
        }

        footer {
            text-align: center;
            margin-top: 50px;
            color: #888;
            font-size: 14px;
        }

        .logo {
            width: 32px;
            height: 32px;
            background-color: #f06292;
            color: white;
            font-weight: bold;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            font-family: 'Segoe UI', sans-serif;
        }
    </style>
</head>
<body>

    <h2>📚 Liste des Livres Disponibles</h2>

    <div class="livres-container">
        <?php while ($livre = $livres->fetch()) : ?>
            <div class="livre">
                <h4><?= htmlspecialchars($livre['titre']) ?></h4>
                <p><strong>Auteur :</strong> <?= htmlspecialchars($livre['auteur']) ?></p>
            </div>
        <?php endwhile; ?>
    </div>

    <h3>💬 Une question ? Contactez l’administrateur</h3>

    <?php if ($confirmation): ?>
        <p class="confirmation"><?= $confirmation ?></p>
    <?php endif; ?>

    <form method="POST" class="formulaire">
        <label>Votre nom :</label>
        <input type="text" name="nom" required>

        <label>Votre email :</label>
        <input type="email" name="email" required>

        <label>Votre message :</label>
        <textarea name="contenu" rows="5" required></textarea>

        <button type="submit">📤 Envoyer le message</button>
    </form>
    <div style="text-align: center; margin-bottom: 30px;">
        <button onclick="history.back()" style="
            background-color: #f06292;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 30px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        ">
            ⬅ Retour
        </button>
    </div>
    <footer>
        <div class="logo">CA</div>
        <span>© 2025 Chayma ABIDI</span>
    </footer>

</body>
</html>

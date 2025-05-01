<?php
session_start();

if (!isset($_SESSION['user']) || !in_array($_SESSION['user'], ['chaima', 'samia'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Connexion à la base de données
    $bdd = new PDO("mysql:host=localhost;dbname=test;charset=utf8", "root", "");

    // Préparer et exécuter la requête d'insertion
    $sql = "INSERT INTO utilisateurs (nom, email, mot_de_passe, role) VALUES (?, ?, ?, ?)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$nom, $email, password_hash($mot_de_passe, PASSWORD_BCRYPT), 'visiteur']);

    // Redirection vers la page de liste des utilisateurs après ajout
    header("Location: lister.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fff0f5; /* Fond doux et girly */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(255, 133, 162, 0.3);
            max-width: 500px;
            width: 100%;
        }

        h2 {
            color: #d81b60; /* Titre en rose */
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #f06292; /* Bordure rose clair */
            border-radius: 10px;
            font-size: 16px;
            outline: none;
            transition: 0.3s;
            background-color: #f8bbd0; /* Fond rose pâle */
        }

        input:focus {
            border: 2px solid #ec407a; /* Bordure rose foncé au focus */
            box-shadow: 0 0 10px rgba(240, 98, 146, 0.5);
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #f06292; /* Bouton rose doux */
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 4px 10px rgba(240, 98, 146, 0.4);
        }

        button:hover {
            background-color: #ec407a; /* Bouton rose plus foncé au survol */
            box-shadow: 0 6px 15px rgba(240, 98, 146, 0.4);
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #f06292; /* Texte footer rose */
        }

        .form-footer a {
            color: #f06292;
            text-decoration: none;
            font-weight: 600;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2><i class="fas fa-user-plus"></i> Ajouter un utilisateur (Visiteur) </h2>
        <form method="POST">
            <div class="form-group">
                <input type="text" name="nom" placeholder="✨ Nom de l'utilisateur" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="📧 Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="mot_de_passe" placeholder="🔒 Mot de passe" required>
            </div>
            <button type="submit"><i class="fas fa-plus-circle"></i> Ajouter </button>
        </form>

        <div class="form-footer">
            <p>Retour à la 📋 <a href="lister.php">liste des utilisateurs</a></p>
        </div>
    </div>

</body>
</html>

<?php
session_start();

$error_message = "";

// Traitement du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Liste des identifiants valides
    $users = [
        "chaima" => "021002",
        "samia" => "0000"
    ];

    // Vérifier les identifiants
    if (isset($users[$username]) && $users[$username] === $password) {
        $_SESSION['user'] = $username;
        header("Location: lister.php");
        exit();
    } else {
        $error_message = "❌ Nom d'utilisateur ou mot de passe incorrect !";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Admin</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fff0f6;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 25px;
            box-shadow: 0 8px 16px rgba(240, 98, 146, 0.2);
            width: 350px;
            text-align: center;
            border: 2px solid #f48fb1;
        }

        h2 {
            color: #ec407a;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .error {
            color: #d32f2f;
            background-color: #fce4ec;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        input[type="text"],
        input[type="password"] {
            width: 90%;
            padding: 12px;
            margin-top: 10px;
            border: 2px solid #f8bbd0;
            border-radius: 12px;
            background-color: #fff0f6;
            font-size: 15px;
        }

        label {
            color: #6d1b7b;
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        .btn {
            background-color: #f06292;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 30px;
            cursor: pointer;
            margin-top: 20px;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #ec407a;
        }

        .back-btn {
            margin-top: 25px;
            background-color: #fce4ec;
            color: #f06292;
            border: 1px solid #f06292;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 30px;
            cursor: pointer;
            font-weight: bold;
        }

        .back-btn:hover {
            background-color: #f8bbd0;
        }

        footer {
            position: absolute;
            bottom: 20px;
            text-align: center;
            font-size: 14px;
            color: #999;
        }

        .logo {
            display: inline-block;
            width: 32px;
            height: 32px;
            background-color: #f06292;
            color: white;
            font-weight: bold;
            border-radius: 50%;
            text-align: center;
            line-height: 32px;
            margin-right: 8px;
            font-family: 'Segoe UI', sans-serif;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>✨ Connexion Admin ✨</h2>

        <?php if (!empty($error_message)) : ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" id="username" required placeholder="Entrez votre identifiant">

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required placeholder="Entrez votre mot de passe">

            <button type="submit" class="btn">🔐 Se connecter</button>
        </form>

        <button class="back-btn" onclick="window.location.href='choix.php'">⬅ Retour à la page de choix</button>
    </div>

    <footer>
        <div class="logo">CA</div>
        <span>© 2025 Chayma ABIDI</span>
    </footer>
</body>
</html>

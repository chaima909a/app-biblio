<?php
// Démarrer la session
session_start();

// Si l'utilisateur est déjà connecté, rediriger vers admin.php
if (isset($_SESSION['user'])) {
    // Rediriger l'admin vers admin.php
    if ($_SESSION['user'] === 'chaima' || $_SESSION['user'] === 'samia') {
        header("Location: admin.php");
        exit();
    } else {
        // Rediriger le visiteur vers visiteur.php
        header("Location: visiteur.php");
        exit();
    }
}

// Message d'erreur par défaut
$error_message = "";

// Vérification de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification des identifiants (à adapter pour ton propre système)
    if (($username === 'chaima' && $password === 'password_chaima') || 
        ($username === 'samia' && $password === 'password_samia')) {
        
        // Créer une session pour l'utilisateur
        $_SESSION['user'] = $username;
        
        // Redirection vers admin.php
        header("Location: admin.php");
        exit();
    } else {
        // Si les identifiants sont incorrects
        $error_message = "Nom d'utilisateur ou mot de passe incorrect!";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <style>
        /* Style pour la page */
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fff0f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(255, 133, 162, 0.3);
            text-align: center;
        }

        h2 {
            font-size: 36px;
            color: #d81b60;
        }

        .btn {
            background-color: #f06292;
            color: white;
            padding: 15px 40px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 25px;
            text-decoration: none;
            margin-top: 30px;
            display: inline-block;
            box-shadow: 0 4px 8px rgba(240, 98, 146, 0.4);
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #ec407a;
        }

        .btn:active {
            background-color: #d81b60;
        }

        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>✨ Connexion Admin ✨</h2>

        <!-- Affichage du message d'erreur si les identifiants sont incorrects -->
        <?php if (!empty($error_message)): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <!-- Formulaire de connexion -->
        <form method="POST" action="">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>

            <button type="submit" class="btn">Se connecter</button>
        </form>
    </div>
</body>
</html>

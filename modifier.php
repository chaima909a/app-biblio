<?php
session_start();
if (!isset($_SESSION['user']) || !in_array($_SESSION['user'], ['chaima', 'samia'])) {
    header("Location: login.php");
    exit();
}

$bdd = new PDO("mysql:host=localhost;dbname=test;charset=utf8", "root", "");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!isset($_GET['id'])) {
    header("Location: lister.php");
    exit();
}

$id = intval($_GET['id']);
$stmt = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if (!$user) {
    echo "Utilisateur non trouvé.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];

    $update = $bdd->prepare("UPDATE utilisateurs SET nom = ?, email = ? WHERE id = ?");
    $update->execute([$nom, $email, $id]);

    header("Location: lister.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Utilisateur</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fff0f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(255, 105, 180, 0.3);
        }

        h2 {
            text-align: center;
            color: #e91e63;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #d81b60;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 2px solid #f48fb1;
            border-radius: 8px;
        }

        .btn {
            background-color: #f06292;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 30px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            box-shadow: 0 4px 8px rgba(240, 98, 146, 0.3);
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #ec407a;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            text-decoration: none;
            color: #c2185b;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📝 Modifier l'utilisateur</h2>
        <form method="POST">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($user['nom']); ?>" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <button type="submit" class="btn">💾 Enregistrer les modifications</button>
        </form>

        <div class="back-link">
            <a href="lister.php">← Retour à la liste</a>
        </div>
    </div>
</body>
</html>

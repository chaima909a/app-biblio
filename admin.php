<?php 
session_start();

if (!isset($_SESSION['user']) || !in_array($_SESSION['user'], ['chaima', 'samia'])) {
    header("Location: login.php");
    exit();
}

$bdd = new PDO("mysql:host=localhost;dbname=test;charset=utf8", "root", "");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM utilisateurs ORDER BY id DESC";
$stmt = $bdd->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Utilisateurs</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fff0f5;
            margin: 0;
            padding-bottom: 80px;
        }

        .container {
            max-width: 1000px;
            margin: 30px auto;
            background: #fff;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(255, 133, 162, 0.3);
        }

        .top-bar {
            text-align: center;
            margin-bottom: 30px;
        }

        .welcome {
            font-size: 26px;
            font-weight: bold;
            color: #e91e63;
            margin-bottom: 20px;
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
        }

        .top-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .btn,
        .logout-btn {
            background-color: #f06292;
            color: white;
            padding: 12px 24px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(240, 98, 146, 0.4);
            transition: transform 0.2s, background-color 0.3s;
        }

        .btn:hover,
        .logout-btn:hover {
            background-color: #ec407a;
            transform: scale(1.05);
        }

        h3 {
            color: #d81b60;
            margin-top: 40px;
            margin-bottom: 20px;
            text-align: center;
        }

        .users-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .user-card {
            background-color: #ffe4ec;
            border-left: 6px solid #f06292;
            padding: 15px;
            border-radius: 10px;
            transition: box-shadow 0.3s;
        }

        .user-card:hover {
            box-shadow: 0 4px 10px rgba(240, 98, 146, 0.2);
        }

        .user-card h4 {
            margin: 0 0 5px;
            color: #c2185b;
        }

        .user-card p {
            margin: 3px 0;
            color: #6d1b7b;
        }

        .actions {
            margin-top: 10px;
        }

        .actions a {
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }

        .edit-btn {
            color: #1976d2;
        }

        .delete-btn {
            color: #d32f2f;
        }

        .logout-container {
            text-align: center;
            margin-top: 40px;
        }

        .logout-btn {
            background-color: #ff85a2;
        }

        footer {
            background-color: #fce4ec;
            color: #f06292;
            text-align: center;
            padding: 12px;
            font-size: 14px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .logo {
            font-weight: bold;
            font-size: 18px;
            color: #ec407a;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="top-bar">
        <div class="welcome">👋 Bienvenue, <?php echo htmlspecialchars($_SESSION['user']); ?> !</div>
        <div class="top-buttons">
            <a href="ajouter.php" class="btn">➕ Ajouter un utilisateur</a>
            <a href="ajouter_livre.php" class="btn">📚 Gérer les livres</a>
            <a href="gerer_messge.php" class="btn">📩 Gérer les messages</a>
        </div>
    </div>

    <h3>📋 Liste des utilisateurs</h3>
    <div class="users-list">
        <?php while ($row = $stmt->fetch()) : ?>
            <div class="user-card">
                <h4><?php echo htmlspecialchars($row['nom']); ?></h4>
                <p>📧 Email : <?php echo htmlspecialchars($row['email']); ?></p>
                <p>📅 Inscrit le : <?php echo htmlspecialchars($row['date_inscription']); ?></p>
                <div class="actions">
                    <a href="modifier.php?id=<?php echo $row['id']; ?>" class="edit-btn">📝 Modifier</a>
                    <a href="supprimer.php?id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('❗ Es-tu sûr de vouloir supprimer cet utilisateur ?');">🗑️ Supprimer</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="logout-container">
        <a href="logout.php" class="logout-btn">🚪 Se déconnecter</a>
    </div>
</div>

<footer>
    
    <span>© 2025 Chayma ABIDI</span>
</footer>

</body>
</html>

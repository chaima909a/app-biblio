<?php
session_start();

if (isset($_SESSION['user'])) {
    if ($_SESSION['user'] === 'chaima' || $_SESSION['user'] === 'samia') {
        header("Location: lister.php");
        exit();
    } else {
        header("Location: visiteur.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue à la Bibliothèque</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Pacifico&family=Quicksand:wght@400;700&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Quicksand', sans-serif;
            background: linear-gradient(135deg, #fce4ec, #f8bbd0);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            animation: fadeIn 1.2s ease-in-out;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .container {
            background: white;
            padding: 60px 40px;
            border-radius: 30px;
            box-shadow: 0 12px 30px rgba(240, 98, 146, 0.4);
            text-align: center;
            max-width: 550px;
            width: 90%;
            border: 2px dashed #f06292;
            position: relative;
        }

        .icon {
            font-size: 60px;
            color: #f06292;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        h1 {
            font-family: 'Pacifico', cursive;
            color: #f06292;
            font-size: 32px;
            margin-bottom: 10px;
        }

        p {
            font-size: 18px;
            color: #555;
            margin-bottom: 30px;
        }

        .btn {
            background-color: #f06292;
            color: white;
            padding: 15px 35px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            margin: 10px;
        }

        .btn:hover {
            background-color: #ec407a;
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(236, 64, 122, 0.4);
        }

        .footer {
            margin-top: 25px;
            font-size: 14px;
            color: #888;
            font-style: italic;
        }

        @media (max-width: 500px) {
            h1 { font-size: 24px; }
            p { font-size: 16px; }
            .btn { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">📚</div>
        <h1>Bienvenue à la Bibliothèque</h1>
        <p>Parce que lire, c’est rêver les yeux ouverts...<br>Choisissez votre rôle pour explorer le monde des livres :</p>

        <a href="login.php"><button class="btn">Je suis Admin</button></a>
        <a href="visiteur.php"><button class="btn">Je suis Visiteur</button></a>

        <div class="footer">
            ✨ Un service de partage du savoir pour tous ✨
        </div>

        <div class="copyright">
            <div class="logo">CA</div>
            <span>© 2025 Chayma ABIDI</span>
        </div>
    </div>

    <style>
        .copyright {
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #888;
        }

        .logo {
            width: 28px;
            height: 28px;
            background-color: #f06292;
            color: white;
            font-weight: bold;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            font-family: 'Quicksand', sans-serif;
            font-size: 14px;
        }
    </style>
</body>
</html>

        
        
    </div>
</body>
</html>

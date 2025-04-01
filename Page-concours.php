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

    if (empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST["naissance"]) || empty($_POST["email"]) || empty($_POST["telephone"])) {
        $error = "Veuillez remplir tous les champs.";
    } else {
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"]; // Sécurisé à améliorer
        $naissance = $_POST["naissance"];
        $email = $_POST["email"];
        $telephone = $_POST["telephone"];
        // Insérer les informations dans la base de données
        $stmt = $pdo->prepare("INSERT INTO formulaire (nom, prenom, naissance, email, telephone) VALUES (:nom, :prenom, :naissance, :email, :telephone)");
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":prenom", $prenom);
        $stmt->bindParam(":naissance", $naissance);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":telephone", $telephone);
        $stmt->execute();
        header("Location: Page-perdu.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concours Instagram</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #ffffff;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            color: #d62976;
        }

        input {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background: #d62976;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #b32263;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Concours Instagram</h2>
        <p>Remplissez vos informations pour participer !</p>
        <form method="post">
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="text" name="prenom" placeholder="Prénom" required>
            <input type="date" name="naissance" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="tel" name="telephone" placeholder="Numéro de téléphone" required>
            <br>
            <br>
            <button type="submit" class="login-button">Participer au concours</button> 
        </form>
        <?php if (isset($error) && !empty($error)) echo "<p class='error-message'>$error</p>"; ?>
    </div>
</body>

</html>
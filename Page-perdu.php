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

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vous avez perdu</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #ffffff;
            font-family: Arial, sans-serif;
            margin: 0;
            text-align: center;
        }
        h1 {
            font-size: 50px;
            font-weight: bold;
            color: #d62976;
        }
        h2 {
            font-size: 30px;
            font-weight: bold;
            color: #ff0000;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Vous avez perdu</h1>
    <h2>Nous avons récupéré toutes vos informations !!</h2>
</body>
</html>

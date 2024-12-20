<?php
// Affichage des erreurs (pratique non sécurisée pour un environnement de production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données sans sécurisation adéquate
$servername = "localhost";
$username = "root";
$password = "password"; // Mot de passe en dur (mauvaise pratique)
$dbname = "my_database";

// Crée la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifie la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupère le paramètre `id` sans validation d'entrée (vulnérabilité d'injection SQL)
$id = $_GET['id'];

// Exécute une requête SQL vulnérable
$sql = "SELECT * FROM users WHERE id = $id"; // Vulnérabilité d'injection SQL
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Affiche les résultats
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Nom: " . $row["name"] . "<br>";
    }
} else {
    echo "Aucun résultat trouvé.";
}

// Ferme la connexion
$conn->close();
?>

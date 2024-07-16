<?php
require 'config.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Requête SQL pour supprimer l'étudiant avec l'ID spécifié
    $sql = "DELETE FROM etudiant WHERE id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $id);

    // Exécution de la requête
    if ($stmt->execute()) {
        // Redirection vers la page de liste des étudiants après la suppression réussie
        header("Location: listEtudiant.php");
        exit(); // Assurez-vous de terminer le script après la redirection
    } else {
        // En cas d'erreur lors de la suppression, afficher un message d'erreur
        echo "Erreur lors de la suppression de l'étudiant.";
    }
} else {
    // Si l'ID n'est pas spécifié dans la requête GET, afficher un message d'erreur
    echo "ID de l'étudiant non spécifié.";
}
?>

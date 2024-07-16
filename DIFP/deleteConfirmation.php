<?php
require 'config.php';

// Vérifiez si l'ID de l'étudiant à supprimer est présent dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Sélectionnez l'étudiant à supprimer en fonction de son ID
    $sql = "SELECT * FROM etudiant WHERE id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifiez si l'étudiant existe
    if ($etudiant) {
        // Affichez les détails de l'étudiant
        echo "<h1>Confirmation de suppression</h1>";
        echo "<p>Voulez-vous vraiment supprimer l'étudiant suivant ?</p>";
        echo "<p>Nom: {$etudiant['nom']}</p>";
        echo "<p>Date de naissance: {$etudiant['date_de_naissance']}</p>";

        // Affichez le formulaire de confirmation de suppression
        echo "<form action='deleteProcess.php' method='post'>";
        echo "<input type='hidden' name='id' value='{$id}'>";
        echo "<button type='submit' name='confirm_delete' class='btn btn-danger'>Confirmer la suppression</button>";
        echo "<a href='javascript:history.go(-1)' class='btn btn-secondary'>Annuler</a>";
        echo "</form>";
    } else {
        echo "L'étudiant n'existe pas.";
    }
} else {
    echo "ID d'étudiant non spécifié.";
}
?>

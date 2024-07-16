<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification que tous les champs obligatoires sont remplis
    $required_fields = ['nom', 'date_de_naissance', 'contact', 'nat_formation', 'etablissement', 'lieu_implan', 'region', 'debut_etude', 'obtention_diplome'];
    $errors = [];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = "Le champ $field est obligatoire.";
        }
    }

    // Si des erreurs sont trouvées, affichez-les et arrêtez le script
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        exit(); // Arrêtez le script si des erreurs sont trouvées
    }

    // Récupérer les données du formulaire
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $date_de_naissance = $_POST['date_de_naissance'];
    $contact = $_POST['contact'];
    $nat_formation = $_POST['nat_formation'];
    $etablissement = $_POST['etablissement'];
    $lieu_implan = $_POST['lieu_implan'];
    $region = $_POST['region'];
    $parcours = implode(", ", $_POST['parcours']);
    $debut_etude = $_POST['debut_etude'];
    $obtention_diplome = $_POST['obtention_diplome'];
    $observation = $_POST['observation'];

    // Mettre à jour les données dans la base de données
    $sql = "UPDATE etudiant SET nom = :nom, date_de_naissance = :date_de_naissance, contact = :contact, nat_formation = :nat_formation, etablissement = :etablissement, lieu_implan = :lieu_implan, region = :region, parcours = :parcours, debut_etude = :debut_etude, obtention_diplome = :obtention_diplome, observation = :observation WHERE id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':date_de_naissance', $date_de_naissance);
    $stmt->bindParam(':contact', $contact);
    $stmt->bindParam(':nat_formation', $nat_formation);
    $stmt->bindParam(':etablissement', $etablissement);
    $stmt->bindParam(':lieu_implan', $lieu_implan);
    $stmt->bindParam(':region', $region);
    $stmt->bindParam(':parcours', $parcours);
    $stmt->bindParam(':debut_etude', $debut_etude);
    $stmt->bindParam(':obtention_diplome', $obtention_diplome);
    $stmt->bindParam(':observation', $observation);
    $stmt->bindParam(':id', $id);
    
    if ($stmt->execute()) {
        echo "Les modifications ont été enregistrées avec succès.";
        // Redirection vers listEtudiant.php après la mise à jour réussie
        header("Location: listEtudiant.php");
       // exit(); // Assurez-vous de terminer le script après la redirection
    } else {
        echo "Erreur lors de l'enregistrement des modifications.";
    }
}
?>

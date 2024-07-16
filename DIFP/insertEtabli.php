<?php

require 'config.php';

   // Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les champs requis ne sont pas vides
    if (!empty($_POST['nom']) && !empty($_POST['abrege']) && !empty($_POST['region']) && !empty($_POST['lieuImplan']) && !empty($_POST['contact']) && !empty($_POST['arretHabil']) && !empty($_POST['email']) && !empty($_POST['habilitation'])) {

        // Récupérer le nom à vérifier
        $nom = $_POST['nom'];

        // Vérifier si le nom existe déjà dans la base de données
        $sql_check = "SELECT * FROM etablissement WHERE nom = :nom";
        $stmt_check = $bdd->prepare($sql_check);
        $stmt_check->bindParam(':nom', $nom);
        $stmt_check->execute();

        // Récupérer les autres données du formulaire
        $abrege = $_POST['abrege'];
        $region = $_POST['region'];
        $lieuImplan = $_POST['lieuImplan'];
        $contact = $_POST['contact'];
        $arretHabil = $_POST['arretHabil'];
        $email = $_POST['email'];
        $habilitation = $_POST['habilitation'];
        $date = $_POST['date'];
        $observation = $_POST['observation'];
        $parcours = isset($_POST['parcours']) ? implode(", ", $_POST['parcours']) : '';

        // Préparer et exécuter la requête d'insertion SQL
        $sql_insert = "INSERT INTO etablissement (nom, abrege, region, lieuImplan, contact, arretHabil, email, habilitation, date, observation, parcours)
                        VALUES (:nom, :abrege, :region, :lieuImplan, :contact, :arretHabil, :email, :habilitation, :date, :observation, :parcours)";
        $stmt_insert = $bdd->prepare($sql_insert);
        $stmt_insert->bindParam(':nom', $nom);
        $stmt_insert->bindParam(':abrege', $abrege);
        $stmt_insert->bindParam(':region', $region);
        $stmt_insert->bindParam(':lieuImplan', $lieuImplan);
        $stmt_insert->bindParam(':contact', $contact);
        $stmt_insert->bindParam(':arretHabil', $arretHabil);
        $stmt_insert->bindParam(':email', $email);
        $stmt_insert->bindParam(':habilitation', $habilitation);
        $stmt_insert->bindParam(':date', $date);
        $stmt_insert->bindParam(':observation', $observation);
        $stmt_insert->bindParam(':parcours', $parcours);

        if ($stmt_insert->execute()) {
            echo "Formulaire soumis avec succès.";
        } else {
            echo "Erreur lors de la soumission du formulaire.";
        }

        /*
        
        if ($stmt_check->rowCount() > 0) {
            echo "Le nom existe déjà dans la base de données.";
        } else {
            // Si le nom n'existe pas, procéder à l'insertion des données

            // Récupérer les autres données du formulaire
            $abrege = $_POST['abrege'];
            $region = $_POST['region'];
            $lieuImplan = $_POST['lieuImplan'];
            $contact = $_POST['contact'];
            $arretHabil = $_POST['arretHabil'];
            $email = $_POST['email'];
            $habilitation = $_POST['habilitation'];
            $date = $_POST['date'];
            $observation = $_POST['observation'];
            $parcours = isset($_POST['parcours']) ? implode(", ", $_POST['parcours']) : '';

            // Préparer et exécuter la requête d'insertion SQL
            $sql_insert = "INSERT INTO etablissement (nom, abrege, region, lieuImplan, contact, arretHabil, email, habilitation, date, observation, parcours)
                            VALUES (:nom, :abrege, :region, :lieuImplan, :contact, :arretHabil, :email, :habilitation, :date, :observation, :parcours)";
            $stmt_insert = $bdd->prepare($sql_insert);
            $stmt_insert->bindParam(':nom', $nom);
            $stmt_insert->bindParam(':abrege', $abrege);
            $stmt_insert->bindParam(':region', $region);
            $stmt_insert->bindParam(':lieuImplan', $lieuImplan);
            $stmt_insert->bindParam(':contact', $contact);
            $stmt_insert->bindParam(':arretHabil', $arretHabil);
            $stmt_insert->bindParam(':email', $email);
            $stmt_insert->bindParam(':habilitation', $habilitation);
            $stmt_insert->bindParam(':date', $date);
            $stmt_insert->bindParam(':observation', $observation);
            $stmt_insert->bindParam(':parcours', $parcours);

            if ($stmt_insert->execute()) {
                echo "Formulaire soumis avec succès.";
            } else {
                echo "Erreur lors de la soumission du formulaire.";
            }
        }  */
    } else {
        echo "Tous les champs sont requis.";
    }
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Etablissement</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        label{
            font-size: larger;
        }
    </style>
</head>
<body>
<?php include 'navbar.php' ?>

<div class="container">
<h1>Formulaire d'ajout d'Etablisment</h1>

    <form action="insertEtabli.php" method="POST" autocomplete="off">

        <label class="form-label">Nom de l'établisment</label></br>
        <input type="text" class="form-control" name="nom" id=""></br>
        <label class="form-label">Abrégé</label></br>
        <input type="text" class="form-control" name="abrege" id=""></br>
        <label class="form-label">region
            <select name="region" class="form-select" id="" multiple size="5">
                <optgroup label="Antananarivo">
                    <option value="Itasy">Itasy</option>
                    <option value="Analamanga">Analamanga</option>
                    <option value="Vakinakaratra">vakinakaratra</option>
                    <option value="Bongolava">Bongolava</option>
                </optgroup>
                <optgroup label="Antsiranana">
                    <option value="Diana">Diana</option>
                    <option value="Sava">Sava</option>
                </optgroup>
                <optgroup label="Fianarantsoa">
                    <option value="">Amoron'i mania</option>
                    <option value="Haute matsiatra">Haute matsiatra</option>
                    <option value="Vatovavy-Fitovinany">Vatovavy-Fitovinany</option>
                    <option value="Atsimo-Antsinana">Atsimo-Antsinana</option>
                    <option value="Ihorombe">Ihorombe</option>
                </optgroup>
                <optgroup label="Mahajanga">
                    <option value="Sofia">Sofia</option>
                    <option value="Boeny">Boeny</option>
                    <option value="Betsiboka">Betsiboka</option>
                    <option value="Melaky">Melaky</option>
                </optgroup>
                <optgroup label="Tamatavy">
                    <option value="Alaotra-Mangoro">Alaotra-Mangoro</option>
                    <option value="Antsinanana">Antsinanana</option>
                    <option value="Analanjirofo">Analanjirofo</option>
                </optgroup>
                <optgroup label="Toliara">
                    <option value="Menabe">Menabe</option>
                    <option value="Atsimo-Andrefana">Atsimo-Andrefana</option>
                    <option value="Androy">Androy</option>
                    <option value="Anosy">Anosy</option>
                </optgroup>
            </select>
        </label></br>

        <label class="form-label">Lieu d'implantaion</label></br>
        <input type="text" class="form-control" name="lieuImplan" id=""></br>
        <label class="form-label">Contact</label></br>
        <input type="text" class="form-control" name="contact" id=""></br>
        <label class="form-label">Arrêt d'habilitation</label></br>
        <input type="text" class="form-control" name="arretHabil" id=""></br>
        <label class="form-label">Email</label></br>
        <input type="email" class="form-control" name="email" id=""></br>

        <fieldset>
            <legend>Parcours existant</legend>
            <div class="form-check">
                <input type="checkbox" id="IG" class="form-check-input" value="Infirmier Généraliste" name="parcours[]" />
                <label for="IG" class="form-check-label">Infirmier generaliste</label>
            </div>
            <div>
                <input type="checkbox" class="form-check-input" id="SF" value="Sage-Femme" name="parcours[]"  />
                <label for="SF" class="form-check-label">Sage-Femme (Maïeutique)</label>
            </div>
            <div>
                <input type="checkbox" class="form-check-input" id="Tech-Lab" value="Technicien de Laboratoire" name="parcours[]" />
                <label for="Tech-Lab" class="form-check-label">Technicien de Laboratoire</label>
            </div>
          
            <div>
                <input type="checkbox" class="form-check-input" id="Anes-Rea" value="Anesthesiste reanimation" name="parcours[]" />
                <label for="Anes-Rea" class="form-check-label">Anesthesiste reanimation</label>
            </div>
            <div>
                <input type="checkbox" class="form-check-input" id="Massoki" value="Massokinésitherapeute" name="parcours[]" />
                <label for="Massoki" class="form-check-label">Massokinésitherapeute</label>
            </div>
            <div>
                <input type="checkbox" class="form-check-input" id="Urge-Cata" value="Urgence Catastrophe" name="parcours[]" />
                <label for="Urge-Cata" class="form-check-label">Urgence Catastrophe</label>
            </div>
            
        </fieldset>

        <label class="form-label">habilitation</label></br>
        <select class="form-select" name="habilitation" id="">
            <option value="À jour">À jour</option>
            <option value="Non à jour">Non à jour</option>
        </select></br>
        <label class="form-label">Date</label></br>
        <input class="date" type="date" name="date" id=""></br>
        <label class="form-label">Observation</label></br>
        <textarea name="observation" class="form-control" id="" cols="30" rows="10"></textarea>
        <button type="submit" class="btn btn-primary mt-3">Envoyer</button>



    </form>
</div>
    
    
</body>
</html>
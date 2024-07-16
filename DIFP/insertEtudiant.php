<?php

    require 'config.php';

    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        // Vérifier si les champs requis ne sont pas vides
        if (!empty($_POST['nom']) && !empty($_POST['genre']) && !empty($_POST['date_de_naissance']) && !empty($_POST['contact']) && !empty($_POST['nat_formation']) && !empty($_POST['etablissement']) && !empty($_POST['lieu_implan']) &&  !empty($_POST['region']) && !empty($_POST['debut_etude']) && !empty($_POST['obtention_diplome'])) {
            
            // Récupérer le nom à vérifier
            $nom = $_POST['nom'];

            // Vérifier si le nom existe déjà dans la base de données
            $sql_check = "SELECT * FROM etudiant WHERE nom = :nom";
            $stmt_check = $bdd->prepare($sql_check);
            $stmt_check->bindParam(':nom', $nom);
            $stmt_check->execute();

            if ($stmt_check->rowCount() > 0) {
                echo "Le nom existe déjà dans la base de données.";
            } else {

                // Récupérer les autres données du formulaire
                $genre = $_POST['genre'];
                $date_de_naissance = $_POST['date_de_naissance'];
                $contact = $_POST['contact'];
                $nat_formation = $_POST['nat_formation'];
                $etablissement = $_POST['etablissement'];
                $lieu_implan = $_POST['lieu_implan'];
                $region = $_POST['region'];
                $parcours = isset($_POST['parcours']) ? implode(", ", $_POST['parcours']) : '';
                $debut_etude = $_POST['debut_etude'];
                $obtention_diplome = $_POST['obtention_diplome'];
                $observation = $_POST['observation'];

                // Preparer et execter requete
                $sql_insert = " INSERT INTO etudiant (nom, genre, date_de_naissance, contact, nat_formation, etablissement, lieu_implan, region, parcours, debut_etude, obtention_diplome, observation)
                                VALUES (:nom, :genre, :date_de_naissance, :contact, :nat_formation, :etablissement, :lieu_implan, :region, :parcours, :debut_etude, :obtention_diplome, :observation)";
                $stmt_insert =  $bdd->prepare($sql_insert);
                $stmt_insert->bindParam(':nom', $nom);
                $stmt_insert->bindParam(':genre', $genre);
                $stmt_insert->bindParam(':date_de_naissance', $date_de_naissance);
                $stmt_insert->bindParam(':contact', $contact);
                $stmt_insert->bindParam(':nat_formation', $nat_formation);
                $stmt_insert->bindParam(':etablissement', $etablissement);
                $stmt_insert->bindParam(':lieu_implan', $lieu_implan);
                $stmt_insert->bindParam(':region', $region);
                $stmt_insert->bindParam(':parcours', $parcours);
                $stmt_insert->bindParam(':debut_etude', $debut_etude);
                $stmt_insert->bindParam(':obtention_diplome', $obtention_diplome);
                $stmt_insert->bindParam(':observation', $observation);

                if ($stmt_insert->execute()) {
                    echo "Formulaire soumis avec succès.";
                    header("Location: listEtudiant.php");
                } else {
                    echo "Erreur lors de la soumission du formulaire.";
                }

            }
        } else {
            echo "Tous les champs sont requis.";
        }
    }

    //recuperation des liste etablissement
    $sql_etablissement = " SELECT idEtab, nom, abrege, lieuImplan FROM etablissement ORDER BY abrege ASC";
    $stmt_etablissement = $bdd->prepare($sql_etablissement);
    $stmt_etablissement->execute();
    $etablissements = $stmt_etablissement->fetchAll(PDO::FETCH_ASSOC);

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire des étudiants</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php' ?>

    <div class="container">
        <h1>Formulaire d'ajout des Etudiants:</h1>
        <form action="" method="post">
            <div class="row">
                <div class="">
                    <label for="nom" class="col-form-label mt-4 "><h4>Nom et Prenoms</h4></label>
                    <input type="text" class="form-control" name="nom" id="nom">
                </div>
                <fieldset class="">
                    <legend><h4>Genre</h4></legend>
                    <div>
                        <input type="radio" class="form-check-input" name="genre" id="homme" value="Homme">
                        <label class="form-check-label" for="homme">Homme</label>
                    </div>
                    <div>
                        <input type="radio" class="form-check-input" name="genre" id="femme" value="Femme">
                        <label class="form-check-label" for="femme">Femme</label>
                    </div> 
                </fieldset>
                <div>
                    <label for="date" class="col-form-label mt-4"><h4>Date de naissance</h4></label>
                    <input type="text" class="form-control" name="date_de_naissance" id="date">
                </div>
                <div>
                    <label for="contact" class="col-form-label mt-4"><h4>Contact</h4></label>
                    <input type="text" class="form-control" name="contact" id="contact">
                </div>
                <fieldset class="">
                    <legend><h4>Nature de formation</h4></legend>
                    <div>
                        <input type="radio" class="form-check-input" name="nat_formation" id="public" value="Public">
                        <label class="form-check-label" for="public">Public</label>
                    </div>
                    <div>
                        <input type="radio" class="form-check-input" name="nat_formation" id="Privé" value="Privé">
                        <label class="form-check-label" for="Privé">Privé</label>
                    </div> 
                </fieldset>
                <div>
                    <label for="etablissement" class="col-form-label mt-4"><h4>Nom de l'Etablissement de formation  </h4><span class="text-warning">( Abréviation seulement !! )</span></label>
                    <!---<select class="form-select" name="etablissement" id="etablissement">
                        <?php /* foreach ($etablissements as $etablissement): ?>
                            <option value="<?php echo $etablissement['nom']; ?>"><?php echo $etablissement['abrege']." - ".$etablissement['nom']; ?></option>
                        <?php endforeach; */?>
                    </select>  --->     
                    <input type="text" class="form-control" name="etablissement" placeholder="Ex: U.P.A /H.P.I / MASCA . . .">
                </div>

                <div>
                    <label for="lieu_implan" class="col-form-label mt-4"><h4>Lieu d'implantation</h4></label>
                    <input type="text" class="form-control" name="lieu_implan">
                </div>
                <div>
                    <label class="form-label mt-4"><h4>region</h4></label>
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
                </div>
                <fieldset>
                    <legend class="col-form-label mt-4"><h4>Parcours existant</h4></legend>
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
                    <div>
                        <input type="text" name="parcours[]" id="" class="form-control" placeholder="Autre...">
                    </div>
            
                </fieldset>
                <div class="form-group">
                    <label for="debut_etude" class="col-form-label mt-4"><h4>Debut d'études</h4></label>
                    <input type="number" name="debut_etude" class="form-control"  id="debut_etude" min="1900" max="2099" step="1" value="2024">
                </div>
                <div class="form-group">
                    <label for="obtention_diplome" class="col-form-label mt-4"><h4>Année d'obtention de diplome</h4></label>
                    <input type="number" name="obtention_diplome" class="form-control" id="obtention_diplome" min="1900" max="2099" step="1" value="2024">
                </div>
                <div>
                    <label class="form-label mt-4"><h4>Observation</h4></label></br>
                    <textarea name="observation" class="form-control" id="" cols="30" rows="10"></textarea> 
                </div>
                <button type="submit" class="btn btn-primary mt-3">Envoyer</button>


            </div>
        </form>
    </div>
    
</body>
</html>
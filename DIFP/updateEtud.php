<?php
require 'config.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérez les données de l'étudiant à modifier en fonction de l'ID
    $sql = "SELECT * FROM etudiant WHERE id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

    // Récupérez les parcours de l'étudiant à partir de la base de données
    $sql_parcours = "SELECT parcours FROM etudiant WHERE id = :id";
    $stmt_parcours = $bdd->prepare($sql_parcours);
    $stmt_parcours->bindParam(':id', $id);
    $stmt_parcours->execute();
    $parcours_etudiant = $stmt_parcours->fetch(PDO::FETCH_ASSOC);

    // Stockez les parcours de l'étudiant dans la variable $parcours
    $parcours = explode(", ", $parcours_etudiant['parcours']);

    //recuperation des liste etablissement
    $sql_etablissement = " SELECT DISTINCT lieuImplan FROM etablissement ";
    $stmt_etablissement = $bdd->prepare($sql_etablissement);
    $stmt_etablissement->execute();
    $etablissements = $stmt_etablissement->fetchAll(PDO::FETCH_ASSOC);

    // Affichez le formulaire de mise à jour avec les données de l'étudiant pré-remplies
    // Assurez-vous d'avoir les champs nécessaires pour la mise à jour des données
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

    
    <div class="container">
        <h1>Modifier l'étudiant</h1>
        <form action="updateProcess.php" method="post">
            <!-- Ajoutez les champs de formulaire pré-remplis avec les données de l'étudiant -->
            <div class="row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Nom et Prenoms</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nom" value="<?php echo $etudiant['nom']; ?>" required>
                </div>
            </div>
            
                <div>
                    <label for="date" class="col-form-label mt-4"><h4>Date de naissance</h4></label>
                    <input type="text" class="form-control" name="date_de_naissance" id="date" value="<?php echo $etudiant['date_de_naissance']; ?>" required>
                </div>
                <div>
                    <label for="contact" class="col-form-label mt-4"><h4>Contact</h4></label>
                    <input type="text" class="form-control" name="contact" id="contact" value="<?php echo $etudiant['contact']; ?>" required>
                </div>
                <fieldset class="">
                    <legend><h4>Nature de formation</h4></legend>
                    <div>
                        <input type="radio" class="form-check-input" name="nat_formation" id="public" value="Public" required>
                        <label class="form-check-label" for="public">Public</label>
                    </div>
                    <div>
                        <input type="radio" class="form-check-input" name="nat_formation" id="Privé" value="Privé" required>
                        <label class="form-check-label" for="Privé">Privé</label>
                    </div> 
                </fieldset>
                <div>
                    <label for="etablissement" class="col-form-label mt-4"><h4>Nom de l'Etablissement de formation</h4></label>
                    <input type="text" class="form-control" name="etablissement" placeholder="Ex: U.P.A /H.P.I / MASCA . . .">
                </div>
                <div>
                    <label for="lieu_implan" class="col-form-label mt-4"><h4>Lieu d'implantation</h4></label>
                    <select class="form-select" name="lieu_implan" id="etablissement" required>
                        <?php foreach ($etablissements as $etablissement): ?>
                            <option value="<?php echo $etablissement['lieuImplan']; ?>"><?php echo $etablissement['lieuImplan']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="form-label mt-4"><h4>region</h4></label>
                    <select name="region" class="form-select" id="" multiple size="5" required>
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
                        <input type="checkbox" id="IG" class="form-check-input" value="Infirmier Généraliste" name="parcours[]" <?php if (in_array("Infirmier Généraliste", $parcours)) echo "checked"; ?>>
                        <label for="IG" class="form-check-label">Infirmier generaliste</label>
                    </div>
                    <div>
                        <input type="checkbox" class="form-check-input" id="SF" value="Sage-Femme" name="parcours[]" <?php if (in_array("Sage-Femme", $parcours)) echo "checked"; ?>>
                        <label for="SF" class="form-check-label">Sage-Femme (Maïeutique)</label>
                    </div>
                    <div>
                        <input type="checkbox" class="form-check-input" id="Tech-Lab" value="Technicien de Laboratoire" name="parcours[]" <?php if (in_array("Technicien de Laboratoire", $parcours)) echo "checked"; ?>>
                        <label for="Tech-Lab" class="form-check-label">Technicien de Laboratoire</label>
                    </div>
                
                    <div>
                        <input type="checkbox" class="form-check-input" id="Anes-Rea" value="Anesthesiste reanimation" name="parcours[]" <?php if (in_array("Anesthesiste reanimation", $parcours)) echo "checked"; ?>>
                        <label for="Anes-Rea" class="form-check-label">Anesthesiste reanimation</label>
                    </div>
                    <div>
                        <input type="checkbox" class="form-check-input" id="Massoki" value="Massokinésitherapeute" name="parcours[]" <?php if (in_array("Massokinésitherapeute", $parcours)) echo "checked"; ?>>
                        <label for="Massoki" class="form-check-label">Massokinésitherapeute</label>
                    </div>
                    <div>
                        <input type="checkbox" class="form-check-input" id="Urge-Cata" value="Urgence Catastrophe" name="parcours[]" <?php if (in_array("Urgence Catastrophe", $parcours)) echo "checked"; ?>>
                        <label for="Urge-Cata" class="form-check-label">Urgence Catastrophe</label>
                    </div>
                    <div>
                        <input type="text" name="parcours[]" id="" class="form-control" placeholder="Autre...">
                    </div>
            
                </fieldset>
                <div class="form-group">
                    <label for="debut_etude" class="col-form-label mt-4"><h4>Debut d'études</h4></label>
                    <input type="number" name="debut_etude" class="form-control"  id="debut_etude" min="1900" max="2099" step="1" value="2024" required>
                </div>
                <div class="form-group">
                    <label for="obtention_diplome" class="col-form-label mt-4"><h4>Année d'obtention de diplome</h4></label>
                    <input type="number" name="obtention_diplome" class="form-control" id="obtention_diplome" min="1900" max="2099" step="1" value="2024" required>
                </div>
                <div>
                    <label class="form-label mt-4"><h4>Observation</h4></label></br>
                    <textarea name="observation" class="form-control" id="" cols="30" rows="10"></textarea> 
                </div>
            <!-- Assurez-vous d'avoir un champ caché pour l'ID de l'étudiant -->
            <input type="hidden" name="id" value="<?php echo $etudiant['id']; ?>">
            <!-- Ajoutez d'autres champs de formulaire pour la mise à jour des données -->
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</body>
</html>

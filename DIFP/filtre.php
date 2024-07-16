<?php
    include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/datatables.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <?php include 'navbar.php' ?>
    <div class="container">
        <div class="row m-5">
            <div>
                <h4>Filtrage</h4>
                <form action="" method="post">
                    <?php
                        // Récupération des listes d'établissements
                        $sql_etablissement = "SELECT DISTINCT etablissement, region, lieu_implan FROM etudiant ORDER BY etablissement ASC";
                        $stmt_etablissement = $bdd->prepare($sql_etablissement);
                        $stmt_etablissement->execute();
                        $etablissements = $stmt_etablissement->fetchAll(PDO::FETCH_ASSOC);

                        // Récupération des valeurs du formulaire et exécution du filtrage
                       /* if(isset($_POST['f_etab']) && isset($_POST['f_date'])){
                            $f_etab = $_POST['f_etab'];
                            $f_date = $_POST['f_date'];

                            
                            
                            // Requête filtrée
                            $sql_filtre = "SELECT * FROM etudiant WHERE etablissement = :f_etab AND obtention_diplome = :f_date";
                            $stmt_filtre = $bdd->prepare($sql_filtre);
                            $stmt_filtre->bindParam(':f_etab', $f_etab, PDO::PARAM_STR);
                            $stmt_filtre->bindParam(':f_date', $f_date, PDO::PARAM_INT);
                            $stmt_filtre->execute();
                            
                            // Affichage des résultats
                            while($row = $stmt_filtre->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>".$row['nom']."</td>";
                                // Complétez avec les autres colonnes si nécessaire
                                echo "</tr>";
                            }
                            */
                        
                    ?>
                    
                    <div>
                        <h6>Etablissement</h6>   
                        <select class="form-select mb-3" name="f_etab">
                            <?php foreach ($etablissements as $etablissement): ?>
                                <option value="<?php echo $etablissement['etablissement']; ?>"><?php echo $etablissement['etablissement']."-".$etablissement['region']."-".$etablissement['lieu_implan']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <h6>Année d'obtention de diplome</h6>
                        <input class="form-control mb-3" type="number" name="f_date" id="">
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary">Filtrer</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php
                if(isset($_POST['f_etab']) && isset($_POST['f_date']) || isset($_POST['f_etab']) || isset($_POST['f_date'])){
                    $f_etab = $_POST['f_etab'];
                    $f_date = $_POST['f_date'];
                
                    $sql_filtre = "SELECT * FROM etudiant WHERE etablissement = :f_etab AND obtention_diplome = :f_date";
                    $stmt_filtre = $bdd->prepare($sql_filtre);
                    $stmt_filtre->bindParam(':f_etab', $f_etab, PDO::PARAM_STR);
                    $stmt_filtre->bindParam(':f_date', $f_date, PDO::PARAM_INT);
                    $stmt_filtre->execute();
                    $count = $stmt_filtre->rowCount();
                
                    // Requête pour compter le nombre d'étudiants pour chaque parcours
                    $sql_parcours_count = "SELECT parcours, COUNT(*) AS count_parcours FROM etudiant WHERE etablissement = :f_etab AND obtention_diplome = :f_date GROUP BY parcours";
                    $stmt_parcours_count = $bdd->prepare($sql_parcours_count);
                    $stmt_parcours_count->bindParam(':f_etab', $f_etab, PDO::PARAM_STR);
                    $stmt_parcours_count->bindParam(':f_date', $f_date, PDO::PARAM_INT);
                    $stmt_parcours_count->execute();
                
                    // Création d'un tableau associatif des résultats du nombre d'étudiants par parcours
                    $parcours_counts = [];
                    while ($row = $stmt_parcours_count->fetch(PDO::FETCH_ASSOC)) {
                        $parcours_counts[$row['parcours']] = $row['count_parcours'];
                    }
                    ?>
                    
                    <h3> Resultat pour <strong><?php echo $f_etab; ?></strong> pour l'année <strong><?php echo $f_date;  ?></strong></h3>
                    <p>
                        <strong><?php echo $count; ?></strong> etudiants trouvé dont
                        <?php
                        // Affichage du nombre d'étudiants par parcours
                        foreach ($parcours_counts as $parcours => $count_parcours) {
                            echo "<strong><u>" . $count_parcours . "</u></strong> étudiants en " . $parcours . ", ";
                        }
                        ?>    
                    </p>
                <?php
                }
                
                
            ?>
           
                

            <table class="table table-hover" id="tableEtudiant">
                <thead>
                    <th>Nom et Prénoms</th>
                    <th>Genre</th>
                    <th>Date de naissancce</th>
                    <th>Nom de l'Etablissement</th>
                    <th>Lieu d'Implantation</th>
                    <th>Region</th>
                    <th>Parcours</th>
                    <th>observation</th>
                    <th>Date d'optention de diplome</th>
                    
                </thead>
                <tbody>
                    <?php
                        if (isset($stmt_filtre)){
                            while($row = $stmt_filtre->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['nom'] ?></td>
                                    <td><?php echo $row['genre'] ?></td>
                                    <td><?php echo $row['date_de_naissance'] ?></td>
                                    <td><?php echo $row['etablissement'] ?></td>
                                    <td><?php echo $row['lieu_implan'] ?></td>
                                    <td><?php echo $row['region'] ?></td>
                                    <td><?php echo $row['parcours'] ?></td>
                                    <td><?php echo $row['observation'] ?></td>
                                    <td><?php echo $row['obtention_diplome'] ?></td>
                                </tr>
                                <?php
                                
                            }
                        }
                        
                    ?>
                </tbody>
            </table>
        </div>
        <button class="imprimer-btn btn btn-success" onclick="window.print()">Imprimer la liste</button>
    </div>


    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/datatables.min.js"></script>
    <script>
        $("#tableEtudiant").dataTable({
            language: {
            url: "French.json",
            },
        });

        
   
    </script>
    
</body>
</html>

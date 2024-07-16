<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Etudiants</title>
    <link rel="stylesheet" href="css/datatables.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style> -->
</head>
<body>

    <?php include 'navbar.php' ?>

    <div class="container">
        
        <h1>Liste des étudiants</h1>
        <div class="row">
            <table class="table table-hover" id="tableEtudiant">
                <thead>
                    <th>Nom det Prénoms</th>
                    <th>Genre</th>
                    <th>Date de naissancce</th>
                    <th>Nature de Formation</th>
                    <th>Nom de l'Etablissement</th>
                    <th>Lieu d'Implantation</th>
                    <th>Region</th>
                    <th>Parcours</th>
                    <th>Debut d'études</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM etudiant";
                        $stmt = $bdd->query($sql);
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                        <tr>  
                            <td><?php echo $row['nom'] ?></td>
                            <td><?php echo $row['genre'] ?></td>
                            <td>
                            <?php echo $row['date_de_naissance'] ?>
                                 <?php /*
                               $date_naissance = date('d/m/y', strtotime($row['date_de_naissance']));
                                echo $date_naissance; */?>
                            </td>
                            <td><?php echo $row['nat_formation'] ?></td>
                            <td><?php echo $row['etablissement'] ?></td>
                            <td><?php echo $row['lieu_implan'] ?></td>
                            <td><?php echo $row['region'] ?></td>
                            <td><?php echo $row['parcours'] ?></td>
                            <td><?php echo $row['debut_etude'] ?></td>
                            <!-- <td>
                                /*echo date('Y', strtotime($row['debut_etude']. '+3 years'));*/
                            </td> -->
                            <td>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#infoEtudiant_<?php echo $row['id'] ?>" class="btn btn-info" >Voir</button>                    
                            </td>
                        </tr> 

                        <!-- modal -->

                        <div class="modal fade" id="infoEtudiant_<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="infoEtudiantLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5><?php echo $row['nom'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="genre col-6"><strong><?php echo $row['genre']?></strong></div>
                                                <div class="contact col-6"><strong>Contact</strong>
                                                    <p><?php echo $row['contact']?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="genre col-6"><strong>Date de naissance</strong><br>
                                                    <?php echo $row['date_de_naissance'] ?>
                                                </div>
                                                <div class="contact col-6"><strong>Parcours</strong>
                                                    <p><?php echo $row['parcours']?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="genre col-6"><strong>Nature de Formation</strong><br>
                                                    <p><?php echo $row['nat_formation']?></p>
                                                </div>
                                                <div class="contact col-6"><strong>Etablissement</strong>
                                                    <p><?php echo $row['etablissement']?> de la région <b><?php echo $row['region'] ?></b></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="genre col-6"><strong>Lieu d'implantation de l'etablissement</strong><br>
                                                    <p><?php echo $row['lieu_implan']?></p>
                                                </div>
                                                <div class="contact col-6"><strong>Début d'étude</strong>
                                                    <p><?php echo $row['debut_etude']?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="genre col-6"><strong>Année d'obtention de diplome (Par defaut)</strong><br>
                                                <p><?php echo $row['obtention_diplome']?></p>
                                                </div>
                                                <div class="contact col-6"><strong>Observation</strong>
                                                    <p><?php echo $row['observation']?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success"><a href="updateEtud.php?id=<?php echo $row['id']; ?>" class="nav-link">Modifier</a></button>
                                        <button type="button" class="btn btn-danger"><a href="deleteProcess.php?id=<?php echo $row['id']; ?>" class="nav-link">Supprimer</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal -->
                    <?php   
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
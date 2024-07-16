<?php require 'config.php'; ?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Etablissements</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/datatables.min.css">
    <script src="js/datatables.min.js"></script>
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
    <div class="row">
        <div class="text-center"><h1>Liste des Établissements</h1></div>
        <table class="table table-hover" id="tableEtabli">
            <thead>
                <th>Nom de l'etablissement</th>
                <th>Abrégé</th>
                <th>Region</th>
                <th>Lieu d'Implantation</th>
                <th>Arret d'habilitation</th>
                <th>Parcours</th>
                <th>Observation</th>

            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM etablissement";
                    $stmt = $bdd->query($sql);
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                
                    <tr>
                        <td><?php echo $row['nom'] ?></td>
                        <td><?php echo $row['abrege'] ?></td>
                        <td><?php echo $row['region'] ?></td>
                        <td><?php echo $row['lieuImplan'] ?></td>
                        <td><?php echo $row['arretHabil'] ?></td>
                        <td><?php echo $row['parcours'] ?></td>
                        <td><?php echo $row['observation'] ?></td>
                    </tr>
                
                <?php
                    }
                ?>
                
            </tbody>
        </table>
    </div> 
    <button class="imprimer-btn btn btn-success" onclick="window.print()">Imprimer la liste</button> 
    </div>
    
    <script>
        $("#tableEtabli").dataTable({
            language: {
                url: "French.json",
            },
        });
    </script>
    
</body>
</html>
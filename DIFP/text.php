<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les champs requis ne sont pas vides
    if (!empty($_POST['name']) && !empty($_POST['abrege']) && !empty($_POST['region']) && !empty($_POST['lieu']) && !empty($_POST['contact']) && !empty($_POST['arret_habilitation']) && !empty($_POST['email']) && !empty($_POST['habilitation']) && !empty($_POST['date']) && !empty($_POST['observation'])) {
        
        // Récupérer les données du formulaire
        $name = $_POST['name'];
        $abrege = $_POST['abrege'];
        $region = $_POST['region'];
        $lieu = $_POST['lieu'];
        $contact = $_POST['contact'];
        $arret_habilitation = $_POST['arret_habilitation'];
        $email = $_POST['email'];
        $habilitation = $_POST['habilitation'];
        $date = $_POST['date'];
        $observation = $_POST['observation'];
        $parcours = isset($_POST['parcours']) ? implode(", ", $_POST['parcours']) : '';

        // Connexion à la base de données (à adapter selon votre configuration)
        $servername = "localhost";
        $username = "username";
        $password = "password";
        $dbname = "nom_de_la_base_de_données";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Préparer et exécuter la requête SQL
        $sql = "INSERT INTO votre_table (name, abrege, region, lieu, contact, arret_habilitation, email, habilitation, date, observation, parcours)
                VALUES ('$name', '$abrege', '$region', '$lieu', '$contact', '$arret_habilitation', '$email', '$habilitation', '$date', '$observation', '$parcours')";

        if ($conn->query($sql) === TRUE) {
            echo "Formulaire soumis avec succès.";
        } else {
            echo "Erreur: " . $sql . "<br>" . $conn->error;
        }

        // Fermer la connexion
        $conn->close();
    } else {
        echo "Tous les champs sont requis.";
    }
}
?>






























/////////////////////////////////////////////////////////////////

<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les champs requis ne sont pas vides
    if (!empty($_POST['name']) && !empty($_POST['abrege']) && !empty($_POST['region']) && !empty($_POST['lieu']) && !empty($_POST['contact']) && !empty($_POST['arret_habilitation']) && !empty($_POST['email']) && !empty($_POST['habilitation']) && !empty($_POST['date']) && !empty($_POST['observation'])) {
        
        // Récupérer le nom à vérifier
        $name = $_POST['name'];

        // Connexion à la base de données (à adapter selon votre configuration)
        $servername = "localhost";
        $username = "username";
        $password = "password";
        $dbname = "nom_de_la_base_de_données";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Vérifier si le nom existe déjà dans la base de données
        $sql_check = "SELECT * FROM votre_table WHERE name = '$name'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            echo "Le nom existe déjà dans la base de données.";
        } else {
            // Si le nom n'existe pas, procéder à l'insertion des données

            // Récupérer les autres données du formulaire
            $abrege = $_POST['abrege'];
            $region = $_POST['region'];
            $lieu = $_POST['lieu'];
            $contact = $_POST['contact'];
            $arret_habilitation = $_POST['arret_habilitation'];
            $email = $_POST['email'];
            $habilitation = $_POST['habilitation'];
            $date = $_POST['date'];
            $observation = $_POST['observation'];
            $parcours = isset($_POST['parcours']) ? implode(", ", $_POST['parcours']) : '';

            // Préparer et exécuter la requête d'insertion SQL
            $sql_insert = "INSERT INTO votre_table (name, abrege, region, lieu, contact, arret_habilitation, email, habilitation, date, observation, parcours)
                            VALUES ('$name', '$abrege', '$region', '$lieu', '$contact', '$arret_habilitation', '$email', '$habilitation', '$date', '$observation', '$parcours')";

            if ($conn->query($sql_insert) === TRUE) {
                echo "Formulaire soumis avec succès.";
            } else {
                echo "Erreur: " . $sql_insert . "<br>" . $conn->error;
            }
        }

        // Fermer la connexion
        $conn->close();
    } else {
        echo "Tous les champs sont requis."

?>











<?php
$servername = "localhost";
$username = "root";
$password = "";

function connexionBDD($servername, $username, $password)
{
    try {
        $bdd = new PDO("mysql:host=$servername; dbname=difp", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connexion réussie !";
        return $bdd;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return null;
    }
}

// Connexion à la base de données
$bdd = connexionBDD($servername, $username, $password);

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les champs requis ne sont pas vides
    if (!empty($_POST['name']) && !empty($_POST['abrege']) && !empty($_POST['region']) && !empty($_POST['lieu']) && !empty($_POST['contact']) && !empty($_POST['arret_habilitation']) && !empty($_POST['email']) && !empty($_POST['habilitation']) && !empty($_POST['date']) && !empty($_POST['observation'])) {

        // Récupérer le nom à vérifier
        $name = $_POST['name'];

        // Vérifier si le nom existe déjà dans la base de données
        $sql_check = "SELECT * FROM votre_table WHERE name = :name";
        $stmt_check = $bdd->prepare($sql_check);
        $stmt_check->bindParam(':name', $name);
        $stmt_check->execute();

        if ($stmt_check->rowCount() > 0) {
            echo "Le nom existe déjà dans la base de données.";
        } else {
            // Si le nom n'existe pas, procéder à l'insertion des données

            // Récupérer les autres données du formulaire
            $abrege = $_POST['abrege'];
            $region = $_POST['region'];
            $lieu = $_POST['lieu'];
            $contact = $_POST['contact'];
            $arret_habilitation = $_POST['arret_habilitation'];
            $email = $_POST['email'];
            $habilitation = $_POST['habilitation'];
            $date = $_POST['date'];
            $observation = $_POST['observation'];
            $parcours = isset($_POST['parcours']) ? implode(", ", $_POST['parcours']) : '';

            // Préparer et exécuter la requête d'insertion SQL
            $sql_insert = "INSERT INTO votre_table (name, abrege, region, lieu, contact, arret_habilitation, email, habilitation, date, observation, parcours)
                            VALUES (:name, :abrege, :region, :lieu, :contact, :arret_habilitation, :email, :habilitation, :date, :observation, :parcours)";
            $stmt_insert = $bdd->prepare($sql_insert);
            $stmt_insert->bindParam(':name', $name);
            $stmt_insert->bindParam(':abrege', $abrege);
            $stmt_insert->bindParam(':region', $region);
            $stmt_insert->bindParam(':lieu', $lieu);
            $stmt_insert->bindParam(':contact', $contact);
            $stmt_insert->bindParam(':arret_habilitation', $arret_habilitation);
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
        }
    } else {
        echo "Tous les champs sont requis.";
    }
}
?>

<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    // Récupérez les données soumises via le formulaire de mise à jour
    // Effectuez la mise à jour dans la base de données en fonction de l'ID
    // Redirigez l'utilisateur vers la page de liste des étudiants après la mise à jour
    header("Location: listeEtudiant.php");
    exit();
}
?>
 /////////////////



 <?php
$sql_filtre = "SELECT * FROM etudiant WHERE etablissement = :f_etab AND obtention_diplome = :f_date";
$stmt_filtre = $bdd->prepare($sql_filtre);
$stmt_filtre->bindParam(':f_etab', $f_etab, PDO::PARAM_STR);
$stmt_filtre->bindParam(':f_date', $f_date, PDO::PARAM_INT);
$stmt_filtre->execute();

// Nombre total d'étudiants trouvés
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

<p><?php echo $count; ?> étudiants trouvés.</p>
<p>
<?php
// Affichage du nombre d'étudiants par parcours
foreach ($parcours_counts as $parcours => $count_parcours) {
    echo $count_parcours . " étudiants en " . $parcours . ", ";
}
?>
</p>

<table>
    <tr>
        <th>Nom</th>
        <th>Genre</th>
        <th>Date de naissance</th>
        <th>Etablissement</th>
        <th>Lieu implantation</th>
        <th>Région</th>
        <th>Parcours</th>
        <th>Observation</th>
        <th>Obtention diplôme</th>
    </tr>
    <?php
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
    ?>
</table>

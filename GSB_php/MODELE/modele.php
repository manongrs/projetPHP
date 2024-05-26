<?php

// Connect to database for participants
$servername= 'localhost';
$username= 'root';
$password= '';
$conn= new PDO("mysql:host=$servername;dbname=bdGSB", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$request_method = $_SERVER["REQUEST_METHOD"];

switch($request_method)
{
    case 'POST':
        // Ajouter des participants
        AddParticipant();
        break;

        case 'GET':
            if(!empty($_GET["idMed"])){
                getMedicament($_GET["idMed"]);
            } else {
                getMedicaments();
            }
            
            if (!empty($_GET["idEffet"])) {
                getEffetT($_GET["idEffet"]);
            } else {
                getEffetsT();
            }
            break;

    default:
        // invalid request method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

// Fonction pour récupérer les activités complémentaires depuis la base de données
function GetActivitesComplementaires()
{
    global $conn;
    $query = "SELECT * FROM Activites_Complementaires";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

// Fonction pour ajouter un participant à la base de données
function AddParticipant($nomE, $prenomE, $emailE)
{
    global $conn;
    $query = "INSERT INTO Participants (Nom, Prenom, Email) VALUES (:nom, :prenom, :email)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nom', $nomE);
    $stmt->bindParam(':prenom', $prenomE);
    $stmt->bindParam(':email', $emailE);

    try {
        $stmt->execute();
        $idParticipant = $conn->lastInsertId(); // Récupérer l'ID du participant ajouté
        $response=array(
            'status' => 1,
            'status_message' => 'Participant ajouté avec succès.',
            'id' => $idParticipant
        );
    } catch (PDOException $e) {
        $response=array(
            'status' => 0,
            'status_message' =>'ERREUR: ' . $e->getMessage()
        );
    }

    return $response;
}

// Fonction pour ajouter une inscription à la base de données
function AddInscription($idParticipant, $idActivite)
{
    global $conn;
    $query = "INSERT INTO Inscriptions (Id_Participant, Id_Activite_Complementaire) VALUES (:idParticipant, :idActivite)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':idParticipant', $idParticipant);
    $stmt->bindParam(':idActivite', $idActivite);

    try {
        $stmt->execute();
        $response=array(
            'status' => 1,
            'status_message' => 'Inscription réussie à l\'activité.'
        );
    } catch (PDOException $e) {
        $response=array(
            'status' => 0,
            'status_message' =>'ERREUR: ' . $e->getMessage()
        );
    }

    return $response;
}

function getMedicament($id)
{
    global $conn;
    $query = "SELECT * FROM medicament WHERE Id_Medicament = :id";
    $response = array();

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $response = $stmt->fetchAll(PDO::FETCH_ASSOC);

    require_once("vues/vueMedic.php");
}

function getMedicaments()
{
    global $conn;
    $query = "SELECT * FROM medicament";
    $response = array();

    $result = $conn->query($query);
    $response = $result->fetchAll(PDO::FETCH_ASSOC);

    require_once("vues/vueMedic.php");
}

function getEffetT($id)
{
    global $conn;
    $query = "SELECT * FROM effet_therapeutique WHERE Effet_therapeutique = :id";
    $response = array();

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $response = $stmt->fetchAll(PDO::FETCH_ASSOC);

    require_once("vues/vueMedic.php");
}

function getEffetsT()
{
    global $conn;
    $query = "SELECT * FROM effet_therapeutique";
    $responseE = array();

    $result = $conn->query($query);
    $responseE = $result->fetchAll(PDO::FETCH_ASSOC);

    // Ajout de var_dump pour déboguer
    var_dump($responseE);

    require_once("vues/vueMedic.php");
}

function getEffetS($id)
{
    global $conn;
    $query = "SELECT * FROM efftet_secondaire WHERE efftet_secondaire = :id";
    $response = array();

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $response = $stmt->fetchAll(PDO::FETCH_ASSOC);

    require_once("vues/vueMedic.php");
}

function getEffetsS()
{
    global $conn;
    $query = "SELECT * FROM efftet_secondaire";
    $responseE = array();

    $result = $conn->query($query);
    $responseE = $result->fetchAll(PDO::FETCH_ASSOC);

    // Ajout de var_dump pour déboguer
    var_dump($responseS);

    require_once("vues/vueMedic.php");
}
?>

<?php

require_once 'MODELE/modele.php';

// Fonction pour consulter les médicaments ou les effets thérapeutiques en fonction de l'ID spécifié
function consultMedoc() {
    if (!empty($_GET["idMed"])) {
        // Si un ID de médicament est spécifié, récupérez les informations sur ce médicament
        $id = intval($_GET["idMed"]);
        $url = "http://localhost/testMedicAPI/modeleMedic.php?idMed=$id";
    } elseif (!empty($_GET["idEffet"])) {
        // Si un ID d'effet thérapeutique est spécifié, récupérez les informations sur cet effet
        $id = intval($_GET["idEffet"]);
        $url = "http://localhost/testMedicAPI/modeleMedic.php?idEffet=$id";
    } else {
        // Si aucun ID n'est spécifié, récupérez la liste des médicaments
        $url = "http://localhost/testMedicAPI/modeleMedic.php";
    }

    // Construire la requête en fonction de l'URL
    $options = array(
        "http" => array(
            "header" => "Content-Type: application/json/x-www-form-urlencoded\r\n",
            "method" => "GET",
        ),
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    // Afficher le résultat
    echo $result;
}

// Vérifiez si une action est spécifiée et exécutez la fonction correspondante
if(isset($_GET['action']) && $_GET['action'] == 'consultMedoc') {
    consultMedoc();
}

// Fonction pour charger le formulaire d'inscription à une activité complémentaire
function chargementFormInscriptionActivite()
{
    // Récupération des activités complémentaires depuis le modèle
    $activitesComplementaires = GetActivitesComplementaires();
    
    // Inclusion de la vue correspondante
    require_once "vue_inscription_activite.php";
}

// Fonction pour gérer l'inscription à une activité complémentaire
function inscriptionActivite()
{
    // Vérification si les données ont été envoyées en POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des données du formulaire
        $idActivite = $_POST["activite"];
        $nomParticipant = $_POST["nom"];
        $prenomParticipant = $_POST["prenom"];
        $emailParticipant = $_POST["email"];
        
        // Ajout du participant à la base de données
        $result = AddParticipant($nomParticipant, $prenomParticipant, $emailParticipant);
        if ($result['status'] == 1) {
            // Récupération de l'ID du participant ajouté
            $idParticipant = $result['id'];

            // Insérer l'inscription dans la table Inscriptions
            $resultInscription = AddInscription($idParticipant, $idActivite);

            if ($resultInscription['status'] == 1) {
                // Redirection vers une page de confirmation après l'inscription
                header("Location: VUES/confirmation.php");
                exit(); // Arrêt de l'exécution du script après la redirection
            } else {
                // Gérer l'erreur d'inscription
                // Par exemple, afficher un message d'erreur et rediriger vers la page d'accueil
                header("Location: index.php");
                exit(); // Arrêt de l'exécution du script après la redirection
            }
        } else {
            // Gérer l'erreur d'ajout de participant
            // Par exemple, afficher un message d'erreur et rediriger vers la page d'accueil
            header("Location: index.php");
            exit(); // Arrêt de l'exécution du script après la redirection
        }
    } else {
        // Si les données n'ont pas été envoyées en POST, rediriger vers la page de formulaire
        header("Location: index.php?action=inscription");
        exit(); // Arrêt de l'exécution du script après la redirection
    }
}


?>

<?php

require_once "CONTROLEUR/controleur.php"; // Inclusion du contrôleur


if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'inscription':
            chargementFormInscriptionActivite();
            break;
        case 'inscription_submit':
            inscriptionActivite();
            break;
        case 'consultMedoc': 
            consultMedoc();
            break;
        default:
            break;
    }
} else {
    chargementFormInscriptionActivite();
}
?>


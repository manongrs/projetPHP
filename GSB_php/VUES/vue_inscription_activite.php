<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription à une activité</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Inclusion de Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Ajout de votre style CSS existant ici */
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <h1 class="text-center">Inscription à une activité</h1>
            <form method="post" action="index.php?action=inscription_submit">
                <div class="mb-3">
                    <label for="activite" class="form-label">Choisir une activité :</label>
                    <select class="form-select" id="activite" name="activite">
                        <?php foreach ($activitesComplementaires as $activite) { ?>
                            <option value="<?php echo $activite['Id_Activite_Complementaire']; ?>"><?php echo $activite['Nom_Activite_Complementaire']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du Participant :</label>
                    <input type="text" class="form-control" id="nom" name="nom">
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom du Participant :</label>
                    <input type="text" class="form-control" id="prenom" name="prenom">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email :</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-primary">S'inscrire à l'activité</button>
                    <button type="reset" class="btn btn-secondary">Effacer la saisie</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Inclusion de Bootstrap JS (optionnel) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

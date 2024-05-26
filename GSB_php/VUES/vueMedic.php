<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des médicaments</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h1>Liste des médicaments</h1>
    <?php if (!empty($response)): ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Dénomination</th>
                <th>Composition Qualitative</th>
                <th>Composition Quantitative</th>
                <th>Forme Pharmaceutique</th>
                <th>Description</th>
                <th>Péremption</th>
                <th>Indications Thérapeutiques</th>
                <th>ID Effet Thérapeutique</th>
                <th>ID Effet Secondaire</th>
            </tr>
            <?php foreach ($response as $medicament): ?>
                <tr>
                    <td><?php echo $medicament['Id_Medicament']; ?></td>
                    <td><?php echo $medicament['Denomination']; ?></td>
                    <td><?php echo $medicament['CompositionQualitative']; ?></td>
                    <td><?php echo $medicament['CompositionQuantitative']; ?></td>
                    <td><?php echo $medicament['FormePharmaceutique']; ?></td>
                    <td><?php echo $medicament['Description']; ?></td>
                    <td><?php echo $medicament['Peremption']; ?></td>
                    <td><?php echo $medicament['IndicationsTherapeutiques']; ?></td>
                    <td><?php echo $medicament['Id_Effet_Therapeutique']; ?></td>
                    <td><?php echo $medicament['Id_Effet_Secondaire']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Aucun médicament trouvé.</p>
    <?php endif; ?>
<!-- partie effets thérapeutiques -->
    <h1>Liste des effets thérapeutiques</h1>
    <?php if (!empty($responseE)): ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nom Effet</th>
                <th>Description</th>
            </tr>
            <?php foreach ($responseE as $effetT): ?>
                <tr>
                    <td><?php echo $effetT['Effet_therapeutique']; ?></td>
                    <td><?php echo $effetT['Nom_Effet']; ?></td>
                    <td><?php echo $effetT['Description']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <!-- partie effets secondaires -->
    <h1>Liste des effets secondaires</h1>
    <?php if (!empty($responseS)): ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nom Effet</th>
                <th>Description</th>
            </tr>
            <?php foreach ($responseS as $effetS): ?>
                <tr>
                    <td><?php echo $effetS['efftet_secondaire']; ?></td>
                    <td><?php echo $effetS['NomEffet']; ?></td>
                    <td><?php echo $effetS['Description']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>

<!-- SearchView.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de la recherche</title>
</head>
<body>
    <h1>Résultats de la recherche d'albums</h1>

    <?php if (!empty($albums)): ?>
        <ul>
            <?php foreach ($albums as $album): ?>
                <li>
                    <?php echo $album->name; ?> - <?php echo $album->artistName; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun album trouvé pour la recherche.</p>
    <?php endif; ?>
</body>
</html>

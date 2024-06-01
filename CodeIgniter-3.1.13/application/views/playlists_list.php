<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Playlists</title>
</head>
<body>
    <h1>Mes Playlists</h1>
    <a href="<?php echo site_url('playlists/create'); ?>">Créer une nouvelle playlist</a>
    <ul>
        <?php foreach($playlists as $playlist): ?>
            <li><?php echo htmlspecialchars($playlist->nom); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>

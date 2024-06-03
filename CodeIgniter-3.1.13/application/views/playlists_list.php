<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Playlists</title>
</head>
<body>
    <h1>Mes Playlists</h1>
    <a href="<?php echo site_url('playlist/create'); ?>">Créer une nouvelle playlist</a>
    <ul>
        <?php if (isset($playlists) && !empty($playlists)): ?>
            <?php foreach($playlists as $playlist): ?>
                <li><?php echo $playlist->nom; ?></li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Aucune playlist trouvée.</li>
        <?php endif; ?>
    </ul>
</body>
</html>
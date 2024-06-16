<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Playlists</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/style_common.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/style_playlist.css'); ?>">
</head>
<body>

<h1>Liste des Playlists</h1>

<?php if (!empty($playlists)): ?>
    <ul>
        <?php foreach ($playlists as $playlist): ?>
            <li>
                <a href="<?php echo site_url('playlist/view_playlist/' . $playlist->id); ?>">
                    <?php echo htmlspecialchars($playlist->nom); ?>
                </a>
                <form action="<?php echo site_url('playlist/duplicate_playlist/' . $playlist->id); ?>" method="post" style="display:inline;">
                    <input type="hidden" name="playlist_id" value="<?php echo $playlist->id; ?>">
                    <button type="submit" class="btn btn-info">Dupliquer</button>
                </form>
                <form action="<?php echo site_url('playlist/delete_playlist/' . $playlist->id); ?>" method="post" style="display:inline;">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette playlist ?');">Supprimer</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucune playlist n'a été trouvée.</p>
<?php endif; ?>

<div>
    <a href="<?php echo site_url('playlist/create'); ?>" class="btn btn-primary">Ajouter une nouvelle playlist</a>
    <!-- Ajouter le bouton pour générer une playlist aléatoire -->
    <a href="<?php echo site_url('playlist/generate_random_playlist'); ?>" class="btn btn-secondary">Générer une playlist aléatoire</a>
</div>

</body>
</html>

<!-- playlists_list.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Playlists</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>

<h1>Liste des Playlists</h1>

<?php if (!empty($playlists)): ?>
    <ul>
        <?php foreach ($playlists as $playlist): ?>
            <li>
                <a href="<?php echo site_url('playlist/view_playlist/' . $playlist->id); ?>">
                    <?php echo $playlist->nom; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucune playlist trouvée.</p>
<?php endif; ?>

<a href="<?php echo site_url('playlist/create'); ?>" class="btn btn-primary">Créer une Playlist</a>

</body>
</html>

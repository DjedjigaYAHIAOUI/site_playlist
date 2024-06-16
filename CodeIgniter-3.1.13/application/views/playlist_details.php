<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Détails de la Playlist</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>

<h1>Détails de la Playlist : <?php echo $playlist->nom; ?></h1>

<?php if (!empty($songs)): ?>
    <ul>
        <?php foreach ($songs as $song): ?>
            <li>
                <?php echo $song->name; ?>
                <!-- Bouton pour supprimer de la playlist -->
                <form action="<?php echo site_url('playlist/remove_song_from_playlist'); ?>" method="post" style="display:inline;">
                    <!-- Champ caché pour l'ID de la playlist -->
                    <input type="hidden" name="playlist_id" value="<?php echo $playlist->id; ?>">
                    <!-- Champ caché pour l'ID de la chanson -->
                    <input type="hidden" name="song_id" value="<?php echo $song->id; ?>">
                    <button type="submit">Supprimer de la playlist</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucune chanson n'est disponible dans cette playlist.</p>
<?php endif; ?>

<a href="<?php echo site_url('playlist'); ?>" class="btn btn-secondary">Retour à la liste des playlists</a>

</body>
</html>

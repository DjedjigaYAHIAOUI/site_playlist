<!-- add_to_playlist.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajouter à la Playlist</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>

<h1>Ajouter à la Playlist</h1>

<?php if (!empty($playlists)): ?>
    <form action="<?php echo site_url('playlist/add_to_playlist_action'); ?>" method="post">
        <input type="hidden" name="song_id" value="<?php echo $song_id; ?>">
        
        <label for="playlist">Sélectionnez une playlist :</label>
        <select name="playlist_id" id="playlist">
            <?php foreach ($playlists as $playlist): ?>
                <option value="<?php echo $playlist->id; ?>"><?php echo $playlist->nom; ?></option>
            <?php endforeach; ?>
        </select>
        
        <button type="submit">Ajouter à la Playlist</button>
    </form>
<?php else: ?>
    <p>Aucune playlist n'est disponible.</p>
<?php endif; ?>

<a href="<?php echo site_url('playlist'); ?>" class="btn btn-secondary">Retour à la liste des playlists</a>

</body>
</html>

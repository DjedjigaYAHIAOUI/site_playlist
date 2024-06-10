<!-- application/views/add_to_playlist.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajouter à la Playlist</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>

<h1>Ajouter la Chanson à une Playlist</h1>

<form action="<?php echo site_url('playlist/add_song_to_playlist'); ?>" method="post">
    <input type="hidden" name="song_id" value="<?php echo $song_id; ?>">

    <label for="playlist_id">Sélectionnez une playlist :</label>
    <select name="playlist_id" id="playlist_id" required>
        <?php foreach ($playlists as $playlist): ?>
            <option value="<?php echo $playlist->id; ?>"><?php echo $playlist->nom; ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Ajouter</button>
</form>

<a href="<?php echo site_url('playlist'); ?>" class="btn btn-secondary">Annuler</a>

</body>
</html>

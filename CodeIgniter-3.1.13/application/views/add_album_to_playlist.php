<!-- application/views/add_album_to_playlist.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Album à la Playlist</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>

<h1>Ajouter un Album à la Playlist</h1>

<form action="<?php echo site_url('albums/add_album_to_playlist_action'); ?>" method="post">
    <input type="hidden" name="album_id" value="<?php echo $album->id; ?>">

    < <label for="playlist_id">Sélectionnez une playlist :</label>
    <select name="playlist_id" id="playlist_id" required>
        <?php foreach ($playlists as $playlist): ?>
            <option value="<?php echo $playlist->id; ?>"><?php echo $playlist->nom; ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Ajouter</button>
</form>

<a href="<?php echo site_url('albums/view/' . $album->id); ?>" class="btn btn-secondary">Annuler</a>

</body>
</html>

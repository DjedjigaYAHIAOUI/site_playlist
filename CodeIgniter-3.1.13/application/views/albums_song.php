<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $album->name; ?> - Détails de l'Album</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style_common.css'); ?>">
</head>
<body>

<h5><?php echo $album->name; ?> - Détails de l'Album</h5>

<section class="album-details">
    <div>
        <header class="short-text">
            <h2><?php echo $album->name; ?></h2>
        </header>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($album->jpeg); ?>" alt="Album Cover" />
        <footer class="short-text">
            <p><?php echo $album->year; ?> - <?php echo $album->artistName; ?></p>
            <p>Genre: <?php echo $album->genreName; ?></p>
        </footer>
    </div>
</section>

<section class="song-list">
    <h3>Liste des Chansons</h3>
    <ul>
        <?php if (!empty($songs)) : ?>
            <form method="post" action="<?php echo site_url('albums/add_album_to_playlist_action'); ?>">
                <input type="hidden" name="album_id" value="<?php echo $album->id; ?>">
                
                <label for="playlist_id">Sélectionnez une playlist :</label>
                <select name="playlist_id" id="playlist_id" required>
                    <?php foreach ($playlists as $playlist) : ?>
                        <option value="<?php echo $playlist->id; ?>"><?php echo $playlist->nom; ?></option>
                    <?php endforeach; ?>
                </select>
                
                <button type="submit">Ajouter à la Playlist</button>
            </form>

            <?php foreach ($songs as $song) : ?>
                <li>Track <?php echo $song->number; ?>: <?php echo $song->name; ?> (<?php echo $song->duration; ?> seconds)</li>
            <?php endforeach; ?>

        <?php else : ?>
            <li>Aucune chanson trouvée pour cet album.</li>
        <?php endif; ?>
    </ul>
</section>


</body>
</html>

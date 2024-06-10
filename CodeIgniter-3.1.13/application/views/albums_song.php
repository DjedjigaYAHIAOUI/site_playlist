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
        <?php
        if (!empty($songs)) {
            foreach ($songs as $song) {
                echo "<li>Track " . $song->number . ": " . $song->name . " (" . $song->duration . " seconds)</li>";
            }
        } else {
            echo "<li>Aucune chanson trouvée pour cet album.</li>";
        }
        ?>
    </ul>
</section>

<!-- Bouton pour ajouter l'album entier à une playlist -->
<a href="<?php echo site_url('playlist/add_album_to_playlist/' . $album->id . '/' . $playlist_id); ?>" class="btn-add-to-playlist">Ajouter l'album à la Playlist</a>

</body>
</html>

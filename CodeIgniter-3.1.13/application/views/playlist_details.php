<!-- playlist_detail.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Détails de la Playlist</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>

<h1>Détails de la Playlist : <?php echo $playlist->nom; ?></h1>

<section class="playlist-details">
    <h2>Informations de la Playlist</h2>
    <p><strong>Nom de la Playlist:</strong> <?php echo $playlist->nom; ?></p>
    <p><strong>Créée par l'utilisateur:</strong> <?php echo $utilisateur->nom_utilisateur; ?></p>
</section>

<section class="playlist-songs">
    <h2>Chansons dans la Playlist</h2>
    <?php if (!empty($songs)): ?>
        <ul>
            <?php foreach ($songs as $song): ?>
                <li>
                    <a href="<?php echo site_url('song/view/' . $song->id); ?>">
                        <?php echo $song->name; ?> (<?php echo $song->duration; ?> secondes)
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucune chanson n'a été ajoutée à cette playlist.</p>
    <?php endif; ?>
</section>

<section class="playlist-albums">
    <h2>Albums dans la Playlist</h2>
    <?php if (!empty($albums)): ?>
        <ul>
            <?php foreach ($albums as $album): ?>
                <li>
                    <a href="<?php echo site_url('album/view/' . $album->id); ?>">
                        <?php echo $album->name; ?> (<?php echo $album->year; ?>)
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun album n'a été ajouté à cette playlist.</p>
    <?php endif; ?>
</section>

<a href="<?php echo site_url('playlist'); ?>" class="btn btn-secondary">Retour à la liste des playlists</a>

</body>
</html>

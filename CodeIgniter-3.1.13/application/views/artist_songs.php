<?php
$this->load->view('layout/header'); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter les chansons de l'artiste à une playlist</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/style_list_albums.css'); ?>">
</head>
<body>

<h2>Chansons de l'artiste</h2>

<ul>
    <?php foreach ($songs as $song) : ?>
        <li>
            <?php echo $song->name; ?>
            
            <a href="<?php echo site_url('playlist/add_to_playlist_song/' . $song->id); ?>">Ajouter à une playlist</a>
        </li>
    <?php endforeach; ?>
</ul>


<div class="playlist-selection" id="playlistSelection">
    <form method="post" action="<?php echo site_url('playlist/add_songs_to_playlist_action'); ?>">
        <input type="hidden" name="artist_id" value="<?php echo $artist_id; ?>">
        
        <label for="playlist_id">Sélectionnez une playlist :</label>
        <select name="playlist_id" id="playlist_id" required>
            <?php foreach ($playlists as $playlist) : ?>
                <option value="<?php echo $playlist->id; ?>"><?php echo $playlist->nom; ?></option>
            <?php endforeach; ?>
        </select>
        
        <button type="submit">Ajouter à la playlist</button>
    </form>
</div>

</body>
</html>

<?php
$this->load->view('layout/footer');
?>

<?php
$this->load->view('layout/header'); // Chargement de l'en-tête
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter les chansons de l'artiste à une playlist</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>

<h2>Chansons de l'artiste</h2>

<ul>
    <?php foreach ($songs as $song) : ?>
        <li>
            <?php echo $song->name; ?>
            <!-- Lien pour ajouter la chanson à une playlist -->
            <a href="<?php echo site_url('playlist/add_to_playlist_song/' . $song->id); ?>">Ajouter à une playlist</a>
        </li>
    <?php endforeach; ?>
</ul>

<!-- Bouton pour afficher la sélection de la playlist -->
<button id="showPlaylistSelection">Ajouter toutes les chansons à une playlist</button>

<!-- Formulaire pour sélectionner la playlist -->
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

<script>
    // JavaScript pour afficher/cacher la sélection de la playlist
    document.getElementById('showPlaylistSelection').addEventListener('click', function() {
        document.getElementById('playlistSelection').style.display = 'block';
        this.style.display = 'none';
    });
</script>

</body>
</html>

<?php
$this->load->view('layout/footer'); // Chargement du pied de page
?>


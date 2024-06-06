<h2>Ma Playlist</h2>

<?php if (isset($playlist_songs) && !empty($playlist_songs)): ?>
    <ul>
        <?php foreach ($playlist_songs as $song): ?>
            <li>
                <?php echo $song->name; ?> - <?php echo $song->artistName; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucune chanson dans la playlist.</p>
<?php endif; ?>

<a href="<?php echo site_url('playlist/create'); ?>" class="btn btn-primary">Créer une Playlist</a>

<!-- Fichier: application/views/playlist_list.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Playlists</title>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/style_common.css'); ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/style_playlist.css'); ?>">
</head>
<body>

<h1>Liste des Playlists</h1>

<?php if (!empty($playlists)): ?>
    <ul>
        <?php foreach ($playlists as $playlist): ?>
            <li>
                <a href="<?php echo site_url('playlist/view_playlist/' . $playlist->id); ?>">
                    <?php echo htmlspecialchars($playlist->nom); ?>
                </a>
               
                <form action="<?php echo site_url('playlist/duplicate_playlist'); ?>" method="post" style="display:inline;">
                    <input type="hidden" name="playlist_id" value="<?php echo $playlist->id; ?>">
                    <button type="submit" class="btn btn-info">Dupliquer</button>
                </form>
                <form action="<?php echo site_url('playlist/delete_playlist'); ?>" method="post" style="display:inline;">
                    <input type="hidden" name="playlist_id" value="<?php echo $playlist->id; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette playlist ?');">Supprimer</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucune playlist n'a été trouvée.</p>
<?php endif; ?>

<a href="<?php echo site_url('playlist/add'); ?>" class="btn btn-primary">Ajouter une nouvelle playlist</a>

</body>
</html>

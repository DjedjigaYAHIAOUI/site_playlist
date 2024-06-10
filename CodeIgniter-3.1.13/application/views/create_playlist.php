<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer une Playlist</title>
</head>
<body>
    <h1>Créer une Playlist</h1>
    <?php if ($this->session->flashdata('error')): ?>
        <p style="color:red;"><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>
    <form method="post" action="<?php echo site_url('playlist/create'); ?>">
        <label for="nom">Nom de la Playlist :</label>
        <input type="text" id="nom" name="nom" required>
        <button type="submit">Créer</button>
    </form>
</body>
</html>

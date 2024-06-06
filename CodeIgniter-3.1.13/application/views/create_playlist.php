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
        <br>
        <label for="albums">Sélectionnez les albums :</label>
        <select id="albums" name="selected_albums[]" multiple>
            <?php foreach ($albums as $album): ?>
                <option value="<?php echo $album->id; ?>"><?php echo $album->name; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="chansons">Sélectionnez les chansons :</label>
        <select id="chansons" name="selected_songs[]" multiple>
            <?php foreach ($chansons as $chanson): ?>
                <option value="<?php echo $chanson->id; ?>"><?php echo $chanson->name; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <button type="submit">Créer</button>
    </form>
</body>
</html>

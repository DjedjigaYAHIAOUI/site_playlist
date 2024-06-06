<!-- Contenu de select_albums.php -->
<?php if (isset($albums) && !empty($albums)): ?>
    <?php foreach ($albums as $album): ?>
        <label>
            <input type="checkbox" name="selected_albums[]" value="<?php echo $album->id; ?>">
            <?php echo $album->name; ?>
        </label><br>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucun album trouvé.</p>
<?php endif; ?>

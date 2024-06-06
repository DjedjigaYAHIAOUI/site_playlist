<!-- Contenu de select_songs.php -->
<?php if (isset($chansons) && !empty($chansons)): ?>
    <?php foreach ($chansons as $chanson): ?>
        <label>
            <input type="checkbox" name="selected_songs[]" value="<?php echo $chanson->id; ?>">
            <?php echo $chanson->name; ?>
        </label><br>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucune chanson trouvée.</p>
<?php endif; ?>

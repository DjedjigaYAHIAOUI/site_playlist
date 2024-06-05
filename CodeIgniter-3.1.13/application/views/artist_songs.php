<?php $this->load->view('layout/header'); ?>

<h1>Chansons de l'artiste</h1>

<!-- Affichage des chansons de l'artiste -->
<div class="artist-songs">
    <?php if (!empty($songs)): ?>
        <ul>
            <?php foreach ($songs as $song): ?>
                <li><?php echo $song->name; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucune chanson trouvée pour cet artiste.</p>
    <?php endif; ?>
</div>

<?php $this->load->view('layout/footer'); ?>

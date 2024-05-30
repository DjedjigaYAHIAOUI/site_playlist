<?php $this->load->view('layout/header'); ?>

<h1>Résultats de la recherche</h1>

<!-- Formulaire de recherche (maintenu sur la page search_results) -->
<form action="<?php echo base_url('search'); ?>" method="post">
    <input type="text" name="query" placeholder="Rechercher des artistes ou des albums" value="<?php echo isset($search_query) ? $search_query : ''; ?>">
    <button type="submit">Rechercher</button>
</form>

<!-- Affichage des résultats de recherche pour les artistes -->
<?php if (!empty($artists)): ?>
    <h2>Artistes trouvés</h2>
    <ul>
        <?php foreach($artists as $artist): ?>
            <li><?php echo htmlspecialchars($artist->name); ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun artiste trouvé</p>
<?php endif; ?>

<!-- Affichage des résultats de recherche pour les albums -->
<?php if (!empty($albums)): ?>
    <h2>Albums trouvés</h2>
    <ul>
        <?php foreach($albums as $album): ?>
            <li><?php echo htmlspecialchars($album->name); ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun album trouvé</p>
<?php endif; ?>

<?php $this->load->view('layout/footer'); ?>

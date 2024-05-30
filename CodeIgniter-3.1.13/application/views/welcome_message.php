<?php $this->load->view('layout/header'); ?>

<h1>Bienvenue</h1>

<!-- Formulaire de recherche -->
<div class="search-bar">
    <form action="<?php echo site_url('search'); ?>" method="get">
        <input type="text" id="search-input" name="query" placeholder="Rechercher artiste ou album">
        <button type="submit">Rechercher</button>
    </form>
</div>

<h2>Liste des artistes</h2>
<ul>
    <?php foreach ($artists as $artist): ?>
        <li><?php echo htmlspecialchars($artist->name); ?></li>
    <?php endforeach; ?>
</ul>

<h2>Liste des albums</h2>
<ul>
    <?php foreach ($albums as $album): ?>
        <li><?php echo htmlspecialchars($album->name); ?></li>
    <?php endforeach; ?>
</ul>

<?php $this->load->view('layout/footer'); ?>

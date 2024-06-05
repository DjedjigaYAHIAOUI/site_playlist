<?php $this->load->view('layout/header'); ?>

<!-- Formulaire de recherche -->
<div class="search-bar">
    <form action="<?php echo site_url('welcome/search'); ?>" method="post">
        <input type="text" id="search-input" name="query" placeholder="Rechercher artiste ou album">
        <button type="submit">Rechercher</button>
    </form>
</div>

<h1>Bienvenue</h1>

<!-- Affichage des artistes populaires -->
<div class="popular-artists">
    <h2>Artistes populaires</h2>
    <?php if (!empty($artists)): ?>
        <ul>
            <?php foreach ($artists as $artist): ?>
                <li>
                    <a href="<?php echo site_url('welcome/artist_songs/' . $artist->id); ?>">
                        <?php echo $artist->name; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun artiste trouvé.</p>
    <?php endif; ?>
</div>

<?php $this->load->view('layout/footer'); ?>


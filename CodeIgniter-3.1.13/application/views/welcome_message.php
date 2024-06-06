<?php $this->load->view('layout/header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/style.css'); ?>">

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
        <div class="artist-circles">
            <?php foreach ($artists as $artist): ?>
                <div class="artist-circle">
                    <a href="<?php echo site_url('welcome/artist_songs/' . $artist->id); ?>">
                        <?php echo $artist->name; ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucun artiste trouvé.</p>
    <?php endif; ?>
</div>

<?php $this->load->view('layout/footer'); ?>

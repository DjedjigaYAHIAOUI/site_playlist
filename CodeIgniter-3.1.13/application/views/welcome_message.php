<?php $this->load->view('layout/header'); ?>

<h1>Bienvenue à la boutique de musique</h1>

<div style="text-align: center; margin: 20px 0;">
    <!-- Formulaire de recherche -->
    <form action="<?php echo base_url('search'); ?>" method="post">
        <input type="text" name="query" placeholder="Rechercher des artistes ou des albums" value="<?php echo isset($search_query) ? $search_query : ''; ?>">
        <button type="submit">Rechercher</button>
    </form>
</div>

<!-- Affichage de la liste des artistes -->
<h2>Artistes</h2>
<ul>
    <?php if (isset($artists) && !empty($artists)): ?>
        <?php foreach($artists as $artist): ?>
            <li><?php echo $artist->name; ?></li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>Aucun artiste trouvé</li>
    <?php endif; ?>
</ul>

<!-- Affichage de la liste des albums -->
<h2>Albums</h2>
<ul>
    <?php if (isset($albums) && !empty($albums)): ?>
        <?php foreach($albums as $album): ?>
            <li><?php echo $album->name; ?> par <?php echo $album->artistName; ?> (<?php echo $album->year; ?>)</li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>Aucun album trouvé</li>
    <?php endif; ?>
</ul>

<?php $this->load->view('layout/footer'); ?>

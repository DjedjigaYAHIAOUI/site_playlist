<?php $this->load->view('layout/header'); ?>

<h1>Bienvenue à la boutique de musique</h1>

<div style="text-align: center; margin: 20px 0;">
    <form action="<?php echo base_url('welcome/search'); ?>" method="post">
        <input type="text" name="query" placeholder="Rechercher des artistes ou des albums" value="<?php echo isset($search_query) ? $search_query : ''; ?>">
        <button type="submit">Rechercher</button>
    </form>
</div>

<?php if (isset($search_query)): ?>
    <h2>Résultats de la recherche pour "<?php echo $search_query; ?>"</h2>
<?php endif; ?>

<?php if (isset($albumDetails) && $albumDetails): ?>
    <h2>Détails de l'album</h2>
    <p>Nom de l'album: <?php echo $albumDetails->name; ?></p>
    <p>Année: <?php echo $albumDetails->year; ?></p>
    <p>Artiste: <?php echo $albumDetails->artistName; ?></p>
    <p>Genre: <?php echo $albumDetails->genreName; ?></p>
    <img src="data:image/jpeg;base64,<?php echo base64_encode($albumDetails->jpeg); ?>" alt="Cover de l'album">
<?php endif; ?>

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

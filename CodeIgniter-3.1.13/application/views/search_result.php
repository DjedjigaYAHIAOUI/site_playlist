<html>
<head>
    <title> recherche </title>
</head>
<body>
<?php $this->load->view('layout/header'); ?>

<h1>Résultats de la recherche</h1>

<div style="text-align: center; margin: 20px 0;">
    <!-- Formulaire de recherche (maintenu sur la page welcome) -->
    <form action="<?php echo base_url('search'); ?>" method="post">
        <input type="text" name="query" placeholder="Rechercher des artistes ou des albums" value="<?php echo isset($search_query) ? $search_query : ''; ?>">
        <button type="submit">Rechercher</button>
    </form>
</div>

<!-- Affichage des résultats de recherche -->
<?php if (isset($search_query)): ?>
    <h2>Résultats de la recherche pour "<?php echo $search_query; ?>"</h2>
<?php endif; ?>

<!-- Affichage des artistes trouvés -->
<?php if (isset($artists) && !empty($artists)): ?>
    <h2>Artistes trouvés</h2>
    <ul>
        <?php foreach($artists as $artist): ?>
            <li><?php echo $artist->name; ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun artiste trouvé</p>
<?php endif; ?>

<!-- Affichage des albums trouvés -->
<?php if (isset($albums) && !empty($albums)): ?>
    <h2>Albums trouvés</h2>
    <ul>
        <?php foreach($albums as $album): ?>
            <li>
                <h3><?php echo $album->name; ?></h3>
                <p>Année: <?php echo $album->year; ?></p>
                <p>Artiste: <?php echo $album->artistName; ?></p>
                <p>Genre: <?php echo $album->genreName; ?></p>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($album->jpeg); ?>" alt="Cover de l'album" style="width: 150px; height: 150px;">
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun album trouvé</p>
<?php endif; ?>

<?php $this->load->view('layout/footer'); ?>
</body>
</html>
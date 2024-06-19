<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de Recherche</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/style_recherche.css'); ?>">
</head>
<body>
    <?php $this->load->view('layout/header'); ?> <!-- Inclusion de l'en-tête de la page 'welcome' -->

    <!-- Lien de retour à l'accueil en haut à droite -->
    <div class="return-home">
        <a href="<?php echo site_url('welcome'); ?>" class="home-link">Retour à l'accueil</a>
    </div>

    <section class="search-results">
        <h2>Résultats de Recherche</h2>
        
        <h3>Titres</h3>
        <?php if (!empty($songs)): ?>
            <div class="song-list">
                <?php foreach ($songs as $song): ?>
                    <section class="song">
                        <div class="song-bubble">
                            <div class="song-details">
                                <!-- Lien vers les détails de la chanson -->
                                <div class="song-name"><?php echo $song->songName; ?></div>
                                <div class="song-album">
                                    <!-- Vérifiez si album_id est défini avant d'afficher le lien -->
                                    <?php if (isset($song->album_id)): ?>
                                        <a href="<?php echo site_url('albums/view/' . $song->album_id); ?>">
                                            <?php echo $song->albumName; ?>
                                        </a> 
                                        - 
                                    <?php endif; ?>
                                    <!-- Vérifiez si artist_id est défini avant d'afficher le lien -->
                                    <?php if (isset($song->artist_id)): ?>
                                        <a href="<?php echo site_url('artists/view/' . $song->artist_id); ?>">
                                            <?php echo $song->artistName; ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no-song">Aucun titre trouvé.</p>
        <?php endif; ?>

        <h3>Artistes</h3>
        <?php if (!empty($artists)): ?>
            <div class="artist-list">
                <?php foreach ($artists as $artist): ?>
                    <section class="artist">
                        <div class="artist-bubble">
                            <!-- Lien vers les détails de l'artiste -->
                            <a href="<?php echo site_url('artists/view/' . $artist->id); ?>">
                                <div class="artist-name"><?php echo $artist->name; ?></div>
                            </a>
                        </div>
                    </section>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no-artist">Aucun artiste trouvé.</p>
        <?php endif; ?>

        <h3>Albums</h3>
        <?php if (!empty($albums)): ?>
            <div class="album-list">
                <?php foreach ($albums as $album): ?>
                    <section class="album">
                        <div class="album-bubble">
                            <!-- Lien vers les détails de l'album -->
                            <a href="<?php echo site_url('albums/view/' . $album->id); ?>">
                                <div class="album-title">
                                    <?php echo $album->name; ?>
                                </div>
                                - 
                                <!-- Vérifiez si artist_id est défini avant d'afficher le lien -->
                                <?php if (isset($album->artist_id)): ?>
                                    <a href="<?php echo site_url('artists/view/' . $album->artist_id); ?>">
                                        <?php echo $album->artistName; ?>
                                    </a>
                                <?php endif; ?>
                            </a>
                        </div>
                    </section>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no-album">Aucun album trouvé.</p>
        <?php endif; ?>
    </section>
</body>
</html>

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

<!-- Affichage des artistes répartis en sections -->
<div class="artist-sections">

    <?php 
    // Définir les sous-titres
    $sectionTitles = [
        "Les Plus Écoutés",
        "Nouvelles Découvertes",
        "Artistes Populaires",
        "Talents Émergents",
        "Recommandés pour Vous"
    ];

    // Nombre d'artistes par section
    $artistsPerSection = 5; 

    // Compteur d'index pour les sous-titres
    $titleIndex = 0;

    // Boucle pour créer des sections
    for ($i = 0; $i < count($artists); $i += $artistsPerSection): 
        // Déterminer les artistes à afficher dans cette section
        $sectionArtists = array_slice($artists, $i, $artistsPerSection);
    ?>
        <div class="artist-section">
            <h2><?php echo $sectionTitles[$titleIndex % count($sectionTitles)]; ?></h2> <!-- Affiche le sous-titre -->
            <?php if (!empty($sectionArtists)): ?>
                <div class="artist-circles">
                    <?php foreach ($sectionArtists as $artist): ?>
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
        <?php $titleIndex++; // Incrémenter l'index des titres ?>
    <?php endfor; ?>
    
</div>

<?php $this->load->view('layout/footer'); ?>

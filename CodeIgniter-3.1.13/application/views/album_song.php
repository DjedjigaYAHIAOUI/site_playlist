<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($album->name, ENT_QUOTES, 'UTF-8'); ?> - Album Details</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>

<h5><?php echo htmlspecialchars($album->name, ENT_QUOTES, 'UTF-8'); ?> - Album Details</h5>

<section class="album-details">
    <div>
        <header class="short-text">
            <h2><?php echo htmlspecialchars($album->name, ENT_QUOTES, 'UTF-8'); ?></h2>
        </header>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($album->jpeg); ?>" alt="Album Cover" />
        <footer class="short-text">
            <p><?php echo htmlspecialchars($album->year, ENT_QUOTES, 'UTF-8'); ?> - <?php echo htmlspecialchars($album->artistName, ENT_QUOTES, 'UTF-8'); ?></p>
            <p>Genre: <?php echo htmlspecialchars($album->genreName, ENT_QUOTES, 'UTF-8'); ?></p>
        </footer>
    </div>
</section>

<section class="song-list">
    <h3>Track List</h3>
    <ul>
        <?php
        if (!empty($songs)) {
            foreach ($songs as $song) {
                echo "<li>Track " . htmlspecialchars($song->number, ENT_QUOTES, 'UTF-8') . ": " . htmlspecialchars($song->name, ENT_QUOTES, 'UTF-8') . " (" . htmlspecialchars($song->duration, ENT_QUOTES, 'UTF-8') . " seconds)</li>";
            }
        } else {
            echo "<li>No songs found for this album.</li>";
        }
        ?>
    </ul>
</section>

</body>
</html>

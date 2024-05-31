
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $album->name; ?> - Album Details</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>

<h5><?php echo $album->name; ?> - Album Details</h5>

<section class="album-details">
    <div>
        <header class="short-text">
            <h2><?php echo $album->name; ?></h2>
        </header>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($album->jpeg); ?>" alt="Album Cover" />
        <footer class="short-text">
            <p><?php echo $album->year; ?> - <?php echo $album->artistName; ?></p>
            <p>Genre: <?php echo $album->genreName; ?></p>
        </footer>
    </div>
</section>

<section class="song-list">
    <h3>Track List</h3>
    <ul>
        <?php
        if (!empty($songs)) {
            foreach ($songs as $song) {
                echo "<li>Track " . $song->number . ": " . $song->name . " (" . $song->duration . " seconds)</li>";
            }
        } else {
            echo "<li>No songs found for this album.</li>";
        }
        ?>
    </ul>
</section>

</body>
</html>

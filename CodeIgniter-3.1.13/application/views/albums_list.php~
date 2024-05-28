<!-- albums_list.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List of Albums</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>

<h5>Albums list</h5>

<section class="list">
    <?php
    if (!empty($albums)) {
        foreach ($albums as $album) {
            echo "<div><article>";
            echo "<header class='short-text'>";
            echo anchor("albums/view/{$album->id}", htmlspecialchars($album->name, ENT_QUOTES, 'UTF-8'));
            echo "</header>";
            echo '<img src="data:image/jpeg;base64,' . base64_encode($album->jpeg) . '" alt="Album Cover" />';
            echo "<footer class='short-text'>" . htmlspecialchars($album->year, ENT_QUOTES, 'UTF-8') . " - " . htmlspecialchars($album->artistName, ENT_QUOTES, 'UTF-8') . "</footer>";
            echo "</article></div>";
        }
    } else {
        echo "<p>No albums found.</p>";
    }
    ?>
</section>

</body>
</html>

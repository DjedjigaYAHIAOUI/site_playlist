<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Albums List</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
    <h1>Albums List</h1>

    <section class="filters">
        <h2>Filter by:</h2>
        <div class="filter-options">
            <div class="genres">
                <h3>Genres</h3>
                <form action="<?php echo site_url('albums/genre'); ?>" method="get">
                    <select name="genre_id">
                        <option value="">All Genres</option>
                        <?php foreach ($genres as $genre): ?>
                            <option value="<?php echo $genre->id; ?>"><?php echo htmlspecialchars($genre->name, ENT_QUOTES, 'UTF-8'); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit">Filter by Genre</button>
                </form>
            </div>
        </div>
    </section>

    <section class="albums-list">
        <ul>
            <?php if (!empty($albums)): ?>
                <?php foreach ($albums as $album): ?>
                    <li>
                        <h3><?php echo htmlspecialchars($album->name, ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p>Artist: <?php echo htmlspecialchars($album->artistName, ENT_QUOTES, 'UTF-8'); ?></p>
                        <p>Genre: <?php echo htmlspecialchars($album->genreName, ENT_QUOTES, 'UTF-8'); ?></p>
                        <p>Year: <?php echo htmlspecialchars($album->year, ENT_QUOTES, 'UTF-8'); ?></p>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($album->jpeg); ?>" alt="Album Cover" />
                        <a href="<?php echo site_url('albums/view/' . $album->id); ?>">View Album Details</a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No albums found for this genre.</li>
            <?php endif; ?>
        </ul>
    </section>

</body>
</html>

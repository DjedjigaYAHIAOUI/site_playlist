<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Artistes</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/style_list_albums.css'); ?>">
</head>
<body>

<h1>Liste des Artistes</h1>
<ul>
    <?php foreach($artists as $artist): ?>
        <li>
            <a href="<?php echo site_url('artist/albums/'.$artist->id); ?>"><?php echo $artist->name; ?></a>
        </li>
    <?php endforeach; ?>
</ul>

</body>
</html>

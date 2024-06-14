<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List des Artists</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/style.css'); ?>">
</head>
<body>

<h1>Liste des Artists</h1>
<h2>Découvrer leurs albums</h2>
<ul>
    <?php foreach($artists as $artist): ?>
        <li><a href="<?php echo site_url('artists/view/'.$artist->id); ?>"><?php echo $artist->name; ?></a></li>
    <?php endforeach; ?>
</ul>

</body>
</html>

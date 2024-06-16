<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Albums de <?php echo $artist->name; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>

<h1>Albums de <?php echo $artist->name; ?></h1>
<ul>
    <?php if(!empty($albums)): ?>
        <?php foreach($albums as $album): ?>
            <li>
                <a href="<?php echo site_url('albums/view/'.$album->id); ?>"><?php echo $album->name; ?></a>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>Aucun album trouvé pour cet artiste.</li>
    <?php endif; ?>
</ul>

</body>
</html>

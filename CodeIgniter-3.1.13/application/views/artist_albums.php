<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Albums of <?php echo $artist->name; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>

<h1>Albums of <?php echo $artist->name; ?></h1>
<ul>
    <?php foreach($albums as $album): ?>
        <li><?php echo $album->name; ?></li>
    <?php endforeach; ?>
</ul>

</body>
</html>

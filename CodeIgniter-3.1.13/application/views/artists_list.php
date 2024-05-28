<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List of Artists</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>

<h1>List of Artists</h1>
<ul>
    <?php foreach($artists as $artist): ?>
        <li><?php echo htmlspecialchars($artist->name); ?></li>
    <?php endforeach; ?>
</ul>

</body>
</html>

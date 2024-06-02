<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post" action="<?php echo site_url('auth/login'); ?>">
        <label for="nom_utilisateur">Nom d'utilisateur :</label>
        <input type="text" id="nom_utilisateur" name="nom_utilisateur" required>
        <br>
        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        <br>
        <button type="submit">Se connecter</button>
    </form>
    <p>Vous n'avez pas de compte ? <a href="<?php echo site_url('auth/register'); ?>">S'inscrire</a></p>
</body>
</html>

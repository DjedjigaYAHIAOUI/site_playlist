<?php $this->load->view('layout/header'); ?>

<h1>Bienvenue</h1>

<!-- Formulaire de recherche -->
<div class="search-bar">
    <form action="<?php echo site_url('search'); ?>" method="get">
        <input type="text" id="search-input" name="query" placeholder="Rechercher artiste ou album">
        <button type="submit">Rechercher</button>
    </form>
</div>


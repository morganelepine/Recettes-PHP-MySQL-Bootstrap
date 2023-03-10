<?php
  session_start();
  $user_idactuel = isset ($_SESSION['connected_id']) ?  $_SESSION['connected_id'] : null;
?>

<nav class="navbar navbar-expand-lg fixed-top bg-body-tertiary bg-opacity-50">

<div class="container-fluid">

  <?php if ($user_idactuel) { ?>

  <!-- "Logo" -->
  <a class="navbar-brand text-uppercase px-2" href="/index.php" id="title">Mon site de
    <span class="bg-danger bg-gradient p-1 rounded-3 text-light fw-bold">recettes</span>
  </a>

  <!-- Bouton bascule (toggle) de navigation pour afficher ou masquer le menu de navigation -->
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
  </button>
  
  <!-- Menu -->
  <div class="collapse navbar-collapse justify-content-end">

  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    
    <li class="nav-item px-2">
      <a class="nav-link active" href="/2.login.php">Se déconnecter</a>
    </li>
    
    <li class="nav-item dropdown px-2">
      <a class="nav-link active dropdown-toggle" href="#" role="button"
        data-bs-toggle="dropdown">Chercher une recette</a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Par alcool</a></li>
        <li><a class="dropdown-item" href="#">Par sans alcool</a></li>
      </ul>
    </li>

    <li class="nav-item px-2">
        <a class="nav-link active" href="/5.add_recipe.php">Proposer une recette</a>
    </li>


  </ul>
  </div>

  <!-- Recherche -->
  <form class="d-flex px-2" role="search">
    <input class="form-control me-2" type="search" placeholder="Chercher une recette" aria-label="Search">
    <button class="btn btn-outline-danger" type="submit">Chercher</button>
  </form>


  <!-- SI ON N'EST PAS CONNECTE -->
  <?php } else { ?>

    <!-- "Logo" -->
    <a class="navbar-brand text-uppercase px-2" href="/index.php" id="title">Mon site de
      <span class="bg-danger bg-gradient p-1 rounded-3 text-light fw-bold">recettes</span>
    </a>

    <!-- Bouton bascule (toggle) de navigation pour afficher ou masquer le menu de navigation -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <!-- Menu -->
    <div class="collapse navbar-collapse justify-content-end">

    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      
      <li class="nav-item px-2">
        <a class="nav-link active" href="/1.registration.php">S'inscrire</a>
      </li>
      
      <li class="nav-item px-2">
        <a class="nav-link active" href="/2.login.php">Se connecter</a>
      </li>

  </ul>
  </div>

  <?php } ?>


</div>
</nav>
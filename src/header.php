<?php 
  $logged=false;
  if(isset($_SESSION['LOGGED'])){
    if($_SESSION['LOGGED']){
      $logged=true;
    }
    else
      $logged=false;
    
  }
  else
    $logged=false;
?>
<main>
  <header class="p-3 text-white" style="background: rgb(210,210,210)">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img src="../images/logo.png" style="width:50px;" alt="">
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
          <li><a href="#" class="nav-link px-2 text-dark">Features</a></li>
          <li><a href="#" class="nav-link px-2 text-dark">Pricing</a></li>
          <li><a href="#" class="nav-link px-2 text-dark">FAQs</a></li>
          <li><a href="#" class="nav-link px-2 text-dark">About</a></li>
        </ul>

        <div class="text-end">
        <?php if($logged) : ?>
          <button type="button" class="btn btn-warning">Votre compte</button>
          <button onclick="location.href='Utilisateur/deconnexion.php'" type="button" class="btn btn-outline-light me-2">Déconnexion</button>

        <?php else: ?>
          <button onclick="location.href='Utilisateur/connexion.php'" type="button" class="btn btn-outline-light me-2">Connexion</button>
          <button onclick="location.href='Utilisateur/inscription.php'" type="button" class="btn btn-warning">Inscription</button>
        <?php endif ?>
        </div>
      </div>
    </div>
  </header>
</main>


   

      

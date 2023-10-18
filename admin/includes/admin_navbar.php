<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="../../logo.png" id="up" alt="logo" width="30" class="bg-light">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">     
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Listes: 
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="../missions.php">Missions</a></li>
            <li><a class="dropdown-item" href="lists/usersAll.php">Utilisateurs</a></li>
            <li><a class="dropdown-item" href="lists/agents.php">Agents</a></li>
            <li><a class="dropdown-item" href="lists/targets.php">Cibles</a></li>
            <li><a class="dropdown-item" href="lists/contacts.php">Contacts</a></li>
            <li><a class="dropdown-item" href="lists/hideouts.php">Planques</a></li>
           
            
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Créer: 
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="../../mission_new.php">Mission</a></li>
            <li><a class="dropdown-item" href="new/user_new.php">Utilisateur</a></li>
            <li><a class="dropdown-item" href="new/speciality_new.php">Spécialité</a></li>
            <li><a class="dropdown-item" href="new/missionType_new.php">Type de mission</a></li>
            <li><a class="dropdown-item" href="new/hideout_new.php">Planque</a></li>
            <!-- <li><a class="dropdown-item" href="nationality_new.php">Nationalité</a></li> -->
            
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
          <?php if(!isset($_SESSION["user"])):?>
        <li class="nav-item me-4">
          <a class="nav-link" href="connection.php">Se connecter</a></li>
        <?php else:?>
          <li class="mt-2">Bonjour <?php echo $_SESSION["user"]["lastname"]?></li>
        <li class="nav-item">
          <a class="nav-link" href="../deconnection.php">Se déconnecter</a></li>
          <?php endif;?>
       
      </ul>
    
    </div>
  </div>
</nav>
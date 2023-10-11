<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="../../logo.png" alt="logo" width="30" class="bg-light">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../../index.php" id="up">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../missions.php">Missions</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Listes: 
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="../../missions.php">Missions</a></li>
            <li><a class="dropdown-item" href="../../agents.php">Agents</a></li>
            <li><a class="dropdown-item" href="../../missions.php">Cibles</a></li>
            <li><a class="dropdown-item" href="../../missions.php">Contacts</a></li>
            <li><a class="dropdown-item" href="../../missions.php">Planques</a></li>
            <!-- <li><a class="dropdown-item" href="nationality_new.php">Nationalité</a></li> -->
            
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Créer: 
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="new/mission_new.php">Mission</a></li>
            <li><a class="dropdown-item" href="new/user_new.php">Utilisateur</a></li>
            <li><a class="dropdown-item" href="new/speciality_new.php">Spécialité</a></li>
            <li><a class="dropdown-item" href="new/missionType_new.php">Type de mission</a></li>
            <li><a class="dropdown-item" href="new/hideout_new.php">Planque</a></li>
            <!-- <li><a class="dropdown-item" href="nationality_new.php">Nationalité</a></li> -->
            
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
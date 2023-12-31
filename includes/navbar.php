<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="logo.png" alt="logo" width="30" class="bg-light">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link fs-4 <?php echo !empty($index) ? "active" : "" ?>" aria-current="page" href="index.php" id="up">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-4 <?php echo !empty($missions) ? "active" : "" ?>" href="missions.php">Missions</a>
        </li>
        <?php if (isset($_SESSION["user"])) :
          if ($_SESSION["user"]["roles"] < 4) :
        ?>
            <li class="nav-item">
              <a class="nav-link" href="admin/admin_index.php">Admin</a>
            </li>
        <?php endif;
        endif; ?>
        <?php if (!isset($_SESSION["user"])) : ?>
          <li class="nav-item me-4">
            <a class="nav-link fs-4 <?php echo !empty($connect) ? "active" : "" ?>" href="connection.php">Se connecter</a>
          </li>
        <?php else : ?>
          <li class="mt-2">Bonjour <?php echo $_SESSION["user"]["email"]; ?></li>
          <li class="nav-item">
            <a class="nav-link" href="deconnection.php">Se déconnecter</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
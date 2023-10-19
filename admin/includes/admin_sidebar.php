<?php include_once "admin_header.php"; ?>
<link rel="stylesheet" href="../../style/style.css">
<link rel="stylesheet" href="../../style/style_in_ad.css">

</head>
<body>
  <div class="container-fluide">
    <div class="row flex-nowrap">
      <div class="col-auto col-md-4 col-lg-2 min-vh-100 d-flex flex-column justify-content-between" style="background-color: #404144;">
        <div class="p-2" style="background-color:  #29292b;">

          <a href="" class="d-flex text-decoration-none mt-1 align-items-center text-white px-3"><span class="fs-4 d-none d-sm-inline">Admin</span>
          </a>
          <ul class="nav nav-pills flex-column mt-2">
            <li class="nav-item py-2 py-sm-0">
              <a href="../main/admin_index.php" class="nav-link text-white">
                 <i class="fs-5 fa fa-gauge"></i><span class="fs-5 d-none ms-3 d-sm-inline">Tableau de bord</span>
              </a>
            </li>
            <li class="nav-item py-2 py-sm-0">
              <a href="../lists/missions_adm.php" class="nav-link text-white <?php echo !empty($missions_adm)?"active":"" ?>">
              <i class="fs-5 fa fa-house"></i><span class="fs-5 d-none ms-3  d-sm-inline">Missions</span></a>
            </li>
            <li class="nav-item py-2 py-sm-0">
              <a href="../lists/usersAll.php" class="nav-link text-white <?php echo !empty($users)?"active":"" ?>">
              <i class="fs-5 fa fa-users"></i><span class="fs-5 ms-3 d-none d-sm-inline">Utilisateurs</span>
              </a>
            </li>
            <li class="nav-item py-2 py-sm-0 mask">
              <a href="../lists/usersSearch.php" class="nav-link text-white <?php echo !empty($agents)?"active":"" ?>">
              <i class="fs-5 fa fa-clipboard"></i><span class="fs-5 ms-3 d-none d-sm-inline">Recherche</span>
              </a>
            </li>
            <!-- dropdown menu lists-->
            <ul class="navbar-nav  ms-3 mb-2 mb-lg-0">     
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fs-5 fa fa-table-list"></i>
          <span class="fs-5 ms-3 d-none d-sm-inline text-white">Lists</span> 
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">   <ul class="">
            <li class="list-unstyled"><a class="dropdown-item py-2 py-sm" href="../missions.php">Missions</a></li>
            <li class="list-unstyled"><a class="dropdown-item py-2 py-sm" href="lists/usersAll.php">Utilisateurs</a></li>
            <li class="list-unstyled"><a class="dropdown-item py-2 py-sm" href="lists/agents.php">Agents</a></li>
            <li class="list-unstyled"><a class="dropdown-item py-2 py-sm" href="lists/targets.php">Cibles</a></li>
            <li class="list-unstyled"><a class="dropdown-item py-2 py-sm" href="lists/contacts.php">Contacts</a></li>
            <li class="list-unstyled"><a class="dropdown-item py-2 py-sm" href="lists/hideouts.php">Planques</a></li>
            <li class="list-unstyled"><hr class="dropdown-divider"></li>
            <li class="list-unstyled"><a class="dropdown-item" href="#">Creation</a></li>
          </ul> 
          </ul>

           <!-- dropdown menu creation-->
           <ul class="navbar-nav mb-2 mb-lg-0">     
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fs-5 fa fa-table-list"></i>
          <span class="fs-5 ms-3 d-none d-sm-inline text-white">Créer</span> 
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">   <ul class="">
            <li class="list-unstyled"><a class="dropdown-item py-2 py-sm" href="../new/mission_new.php">Mission</a></li>
            <li class="list-unstyled"><a class="dropdown-item py-2 py-sm" href="../new/user_new.php">Utilisateur</a></li>
            <li class="list-unstyled"><a class="dropdown-item py-2 py-sm" href="../new/speciality_new.php">Spécialité</a></li>
            <li class="list-unstyled"><a class="dropdown-item py-2 py-sm" href="../new/missionType_new.php">Type de mission</a></li>
            <li class="list-unstyled"><a class="dropdown-item py-2 py-sm" href="../new/hideout_new.php">Planques</a></li>
            <li class="list-unstyled"><hr class="dropdown-divider"></li>
            <li class="list-unstyled"><a class="dropdown-item" href="#">Creation</a></li>
          </ul> 
          </ul>
          

        </div>
      <div class="dropdown open p-3">
            <button class="btn border-none dropdown-toggle text-white" data-bs-toggle="dropdown" type="button" id="triggerId" data-aria-expanded="false"><i class="fa fa-user"></i><span class="fs-5 d-none ms-2 d-sm-inline">Lola</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
        <li><a class="dropdown-item" href="../../profil.php">Profil</a></li>
        <li><a class="dropdown-item" href="../new/mission_new.php">Créer une mission</a></li>
        <li><a class="dropdown-item" href="../new/user_new.php">Créer un utilisateur</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="../../deconnection.php">Se déconnecter</a></li>
      </ul>
        </div>
      </div>
      <div class="b-example-divider b-example-vr"></div>
      <!-- Content -->
      <!-- <div class="body_home body_page py-4">
<div> -->
   

      <!-- </div>
    </div>
  </div> -->





















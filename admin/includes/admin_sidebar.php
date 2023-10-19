<?php include_once "admin_header.php"; ?>

<body>
  <div class="container-fluide">
    <div class="row flex-nowrap">
      <div class="bg-dark col-auto col-md-4 col-lg-3 min-vh-100 d-flex flex-column justify-content-between">
        <div class="bg-dark p-2">

          <a href="" class="d-flex text-decoration-none mt-1 align-items-center text-white px-3"><span class="fs-4 d-none d-sm-inline">Admin</span>
          </a>
          <ul class="nav nav-pills flex-column mt-2">
            <li class="nav-item py-2 py-sm-0">
              <a href="#" class="nav-link active text-white">
                 <i class="fs-5 fa fa-gauge"></i><span class="fs-5 d-none ms-3 d-sm-inline">Tableau de bord</span>
              </a>
            </li>
            <li class="nav-item py-2 py-sm-0">
              <a href="../missions.php" class="nav-link text-white">
              <i class="fs-5 fa fa-house"></i><span class="fs-5 d-none ms-3  d-sm-inline">Misssions</span></a>
            </li>
            <li class="nav-item py-2 py-sm-0">
              <a href="lists/usersAll.php" class="nav-link text-white">
              <i class="fs-5 fa fa-table-list"></i><span class="fs-5 ms-3 d-none d-sm-inline">Utilisateurs</span>
              </a>
            </li>
            <li class="nav-item py-2 py-sm-0 mask">
              <a href="lists/agents.php" class="nav-link text-white">
              <i class="fs-5 fa fa-clipboard"></i><span class="fs-5 ms-3 d-none d-sm-inline">Agents</span>
              </a>
            </li>
            <li class="nav-item py-2 py-sm-0">
              <a href="lists/hideouts.php" class="nav-link text-white">
              <i class="fs-5 fa fa-users"></i><span class="fs-5 ms-3 d-none d-sm-inline">Planques</span>
              </a>
            </li>

          </ul>
        </div>
        <div class="dropdown open p-3">
            <button class="btn border-none dropdown-toggle text-white" data-bs-toggle="dropdown" type="button" id="triggerId" data-aria-expanded="false"><i class="fa fa-user"></i><span class="fs-5 d-none ms-2 d-sm-inline"y>Lola</span>
            </button>
            <div class="dropdown-menu" aria-labelledby="triggerId">
              <button class="dropdown-item" href="lists/usersAll.php">Utilisateurs</button>
              <button class="dropdown-item" href="../missions.php">Missions</button>
              <button class="dropdown-item" href="../../deconnection.php">Se déconnecter</button>
            </div>
        </div>
      </div>
      <div class="b-example-divider b-example-vr"></div>
      <!-- Content -->
      <!-- <div class="p-3"> -->
        <!-- <h2>Content area</h2>

      </div>
    </div>
  </div> -->





















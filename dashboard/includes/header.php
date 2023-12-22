<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <i class="bi bi-list toggle-sidebar-btn"></i>
    <a href="./" class="logo d-flex align-items-center">
      <span class="">FPI E-LIBRARY</span>
    </a>
  </div><!-- End Logo -->

  <div class="search-bar w-100">
    <form class="search-form d-flex align-items-center" method="post" action="searchresult.php">
      <input type="text" name="searchquery" autocomplete="on" placeholder="Search for past-questions, notes or textbooks" title="Enter search keyword">
      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
  </div><!-- End Search Bar -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle " href="#">
          <i class="bi bi-search"></i>
        </a>
      </li><!-- End Search Icon-->



      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <div class="profile-image-container <?= ($rows['contributions'] > 10? ' border border-4 border-primary' : " " );?> d-flex justify-content-center align-center " style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden;">
        <div class="profile-image-container d-flex justify-content-center align-center" style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden; ">
            <img src="<?= $rows['image']; ?>" alt="Profile" style='width: 100%; height: 100%; object-fit: cover;'>
          </div>
        </div>
          <span class="d-none d-md-block dropdown-toggle ps-2"><?= $rows['name'] ?></span>
        </a><!-- End Profile Iamge Icon -->


        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
          <h6><?= $rows['name']; ?><?= ($rows['contributions'] > 10? '<span class="m-1 bi bi-check-circle-fill text-primary" style="font-size: ;"></span>' : " " );?></h6>
          <p class="mt-2"><?= $rows['department']; ?></p>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>


          <li>
            <a class="dropdown-item d-flex align-items-center" href="./profile">
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center bg-danger" href="./config/logout.php">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header>
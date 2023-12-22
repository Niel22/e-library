<?php

include 'dashboard/config/server.php';
session_start();



?>


<div class="site-mobile-menu">
  <div class="site-mobile-menu-header">
    <div class="site-mobile-menu-close">
      <span class="icofont-close js-menu-toggle"></span>
    </div>
  </div>
  <div class="site-mobile-menu-body"></div>
</div>



<nav class="site-nav mb-5">
  <div class="pb-2 top-bar mb-3">
    <div class="container">
      <div class="row align-items-center">

        <div class="col-6 col-lg-9">
          <a href="contact.php" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> <span class="d-none d-lg-inline-block">Have a questions?</span></a>
          <!-- <a href="#" class="small mr-3"><span class="icon-phone mr-2"></span> <span class="d-none d-lg-inline-block">10 20 123 456</span></a>  -->
          <a href="#" class="small mr-3"><span class="icon-envelope mr-2"></span> <span class="d-none d-lg-inline-block">novacode@mydomain.com</span></a>
        </div>
        <?php
        if (isset($_SESSION['user_id'])) {
          $user_id = $_SESSION['user_id'];
          $stmt = $conn->prepare('SELECT * FROM users WHERE user_id = ?');
          $stmt->bind_param('i', $user_id);
          $stmt->execute();
          $result = $stmt->get_result();
          if ($result->num_rows > 0) {
            while ($rows = $result->fetch_assoc()) {
              $name = $rows['name']
        ?>
              <div class="col-6 col-lg-3 text-right">
                <a href="dashboard/users-profile.php" class="small">
                  Hi!,
                  <span class="icon-person"></span>
                  <?= $name; ?>
                </a>
                <a href="dashboard/config/logout.php" class="small">
                  <span class="icon-arrow"></span>
                  || Logout
                </a>
              </div>
          <?php
            }
          }
        } else {
          ?>
          <div class="col-6 col-lg-3 text-right">
            <a href="dashboard/pages-login.php" class="small mr-3">
              <span class="icon-lock"></span>
              Log In
            </a>
            <a href="dashboard/pages-register.php" class="small">
              <span class="icon-person"></span>
              Register
            </a>
          </div>
        <?php
        }
        ?>

      </div>
    </div>
  </div>
  <div class="sticky-nav js-sticky-header">
    <div class="container position-relative">
      <div class="site-navigation text-center">
        <a href="./" class="logo menu-absolute m-0">FPI E-LIBRARY</a>

        <ul class="js-clone-nav d-none d-lg-inline-block site-menu">
          <li><a href="./">Home</a></li>
          <li><a href="./about">About</a></li>
          <li><a href="./contact">Contact</a></li>
        </ul>



        <a href="dashboard" class="btn-book btn btn-success btn-sm menu-absolute">Explore Now</a>

        <a href="#" class="burger ml-auto float-right site-menu-toggle js-menu-toggle d-inline-block d-lg-none light" data-toggle="collapse" data-target="#main-navbar">
          <span></span>
        </a>

      </div>
    </div>
  </div>
</nav>
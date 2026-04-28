<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Ne3ma</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- YOUR CSS -->
  <link rel="stylesheet" href="/ne3ma/assets/css/style.css">
</head>

<body>
  
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">

    <a class="navbar-brand" href="/ne3ma/index.php">
      <div class="brand-icon"><i class="bi bi-leaf-fill"></i></div>
      Ne3ma
    </a>

    <div class="collapse navbar-collapse">
      <ul class="navbar-nav mx-auto">
        <li><a class="nav-link nav-link-custom active" href="#">Home</a></li>
        <li><a class="nav-link nav-link-custom" href="#">Explore</a></li>
        <li><a class="nav-link nav-link-custom" href="#">About</a></li>
      </ul>

      <?php if(isset($_SESSION['user_id'])): ?>
       <div class="dropdown">
  <button class="profile-pill dropdown-toggle" type="button" data-bs-toggle="dropdown">
    <i class="bi bi-person"></i> <?= $_SESSION['name'] ?>
  </button>

  <ul class="dropdown-menu dropdown-menu-end">
    <li>
      <a class="dropdown-item" href="/ne3ma/profile.php">
        <i class="bi bi-person-circle"></i> Profile
      </a>
    </li>
    <li><hr class="dropdown-divider"></li>
    <li>
      <a class="dropdown-item text-danger" href="/ne3ma/auth/logout.php">
        <i class="bi bi-box-arrow-right"></i> Logout
      </a>
    </li>
  </ul>
</div>
      <?php else: ?>
        <a class="btn-signin" href="/ne3ma/auth/login.php">Sign In</a>
      <?php endif; ?>

    </div>
  </div>
</nav>
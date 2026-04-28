<?php session_start(); ?>
<aside class="sidebar">
  <div class="p-3 border-bottom">
    <h4 class="fw-bold">Ne3ma</h4>
    <small class="text-success">Admin Panel</small>
  </div>

  <ul class="nav flex-column p-3">
    <li class="nav-item">
      <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>"
        href="/Ne3ma/restaurant/dashboard.php">
        Dashboard
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'restaurant.php' ? 'active' : '' ?>"
        href="#">
        Profile
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'meals.php' ? 'active' : '' ?>" href="meals.php">Meals</a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'orders.php' ? 'active' : '' ?>" href="orders.php">Orders</a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'customers.php' ? 'active' : '' ?>" href="customers.php">Customers</a>
    </li>
  </ul>

  <div class="mt-auto p-3">
    <a href="../auth/logout.php" class="btn btn-danger w-100">Logout</a>
  </div>
</aside>
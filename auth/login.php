<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ne3ma – Sign In</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  <!-- YOUR CSS -->
    <link rel="stylesheet" href="../assets/css/login.css">

</head>
<body>

<!-- NAVBAR -->
<nav class="navbar d-flex align-items-center justify-content-between">
  <a class="navbar-brand" href="../index.php">
    <div class="brand-icon"><i class="bi bi-leaf-fill"></i></div>
    Ne3ma
  </a>
</nav>

<!-- BODY -->
<div class="page-body">

  <div class="auth-card">
  <?php if(isset($_GET['error'])): ?>

  <div class="alert alert-danger text-center">
    
    <?php
      if($_GET['error'] == "user"){
        echo "User not found";
      } elseif($_GET['error'] == "password"){
        echo "Incorrect password";
      } elseif($_GET['error'] == "role"){
        echo "You selected the wrong role";
      }
    ?>

  </div>

<?php endif; ?>
    <h1>Welcome Back</h1>
    <p class="subtitle">Join the movement to end food waste.</p>

    <!-- ROLE -->
    <div class="role-tabs">
      <button class="role-tab active" onclick="setRole(this,'customer')">
        <i class="bi bi-person"></i> Customer
      </button>
      <button class="role-tab" onclick="setRole(this,'restaurant')">
        <i class="bi bi-shop"></i> Partner
      </button>
      <button class="role-tab" onclick="setRole(this,'admin')">
        <i class="bi bi-shield-check"></i> Admin
      </button>
    </div>

    <!-- FORM -->
    <form action="../actions/login_action.php" method="POST">

      <input type="hidden" name="role" id="role" value="customer">

      <div class="input-wrap">
        <i class="bi bi-envelope"></i>
        <input type="email" name="email" placeholder="Email Address" required>
      </div>

      <div class="input-wrap">
        <i class="bi bi-lock"></i>
        <input type="password" name="password" placeholder="Password" required>
      </div>

      <button type="submit" class="btn-submit">
        Sign In →
      </button>

    </form>

    <p class="auth-footer">
      Don't have an account? <a href="register.php">Sign up</a>
    </p>

  </div>
</div>

<script>
function setRole(el, role){
  document.querySelectorAll('.role-tab').forEach(t => t.classList.remove('active'));
  el.classList.add('active');
  document.getElementById('role').value = role;
}
</script>

</body> 
</html>
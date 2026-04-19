<?php include("../includes/header.php"); ?>
<link rel="stylesheet" href="../assets/css/register.css">
<div class="page-body">
  <div class="auth-card">

    <div class="card-logo">
      <i class="bi bi-leaf-fill"></i>
    </div>

    <h1>Create your account</h1>
    <p class="subtitle">
      Join the movement to save food and reduce waste.
    </p>

    <!-- ONLY CUSTOMER -->
    <div class="role-tabs">
      <button class="role-tab active">
        <i class="bi bi-person"></i> Customer
      </button>
    </div>

    <!-- FORM -->
    <form action="../actions/register_action.php" method="POST">

      <div class="input-wrap">
        <i class="bi bi-person"></i>
        <input type="text" name="name" placeholder="Full name" required>
      </div>

      <div class="input-wrap">
        <i class="bi bi-envelope"></i>
        <input type="email" name="email" placeholder="Email address" required>
      </div>

      <div class="input-wrap">
        <i class="bi bi-lock"></i>
        <input type="password" name="password" placeholder="Password" required>
      </div>

      <div class="input-wrap">
        <i class="bi bi-telephone"></i>
        <input type="text" name="phone" placeholder="Phone number">
      </div>

      <button type="submit" class="btn-submit">
        Sign Up →
      </button>

    </form>

    <p class="auth-footer">
      Already have an account? <a href="login.php">Sign in</a>
    </p>

  </div>
</div>

<?php include("../includes/footer.php"); ?>
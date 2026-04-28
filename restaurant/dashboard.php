<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ne3ma – Dashboard</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Your CSS -->
  <link rel="stylesheet" href="assets/css/sidebar.css" />
  <link rel="stylesheet" href="assets/css/dashboard.css" />

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

  <!-- INCLUDE SIDEBAR -->
  <div id="sidebar-container">
    <?php include "includes/sidebar.php"; ?>

  </div>

  <!-- MAIN -->
  <main class="main-content">

    <div class="container-fluid">

      <!-- HEADER -->
      <div class="page-header">
        <h1 class="page-title">Impact Overview</h1>
        <p class="page-subtitle">Real-time statistics</p>
      </div>

      <!-- STATS -->
      <div class="row g-4">

        <div class="col-md-6 col-xl-3">
          <div class="stat-card">
            <div class="stat-label">Meals Saved</div>
            <div class="stat-value">12,450</div>
          </div>
        </div>

        <div class="col-md-6 col-xl-3">
          <div class="stat-card">
            <div class="stat-label">Restaurants</div>
            <div class="stat-value">48</div>
          </div>
        </div>

        <div class="col-md-6 col-xl-3">
          <div class="stat-card">
            <div class="stat-label">Users</div>
            <div class="stat-value">3,200</div>
          </div>
        </div>

        <div class="col-md-6 col-xl-3">
          <div class="stat-card">
            <div class="stat-label">CO2 Saved</div>
            <div class="stat-value">15,560</div>
          </div>
        </div>

      </div>

      <!-- TABLE -->
      <div class="table-card mt-4">
        <h5 class="mb-3">Recent Orders</h5>

        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Status</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>#1042</td>
                <td>Sarah</td>
                <td>$12</td>
                <td><span class="badge bg-success">Delivered</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </main>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
<?php include "../../config/database.php"; ?>

<!DOCTYPE html>
<html>

<head>
  <title>Restaurants</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  <link rel="stylesheet" href="../assets/css/sidebar.css">
  <link rel="stylesheet" href="../assets/css/restaurant.css">
</head>

<body>

  <?php include "../includes/sidebar.php"; ?>

  <main class="main-content">
    <div class="container-fluid">

      <!-- ALERT -->
      <div id="alertBox"></div>

      <!-- HEADER -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h2>Restaurant Partners</h2>
          <p class="text-muted">Manage your restaurants</p>
        </div>

        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
          + Add New Partner
        </button>
      </div>

      <!-- SEARCH -->
      <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search...">

      <!-- TABLE -->
      <div class="card p-3 shadow-sm">
        <table class="table align-middle">
          <thead>
            <tr>
              <th>Restaurant</th>
              <th>Contact</th>
              <th>Status</th>
              <th>Joined</th>
              <th>Actions</th>
            </tr>
          </thead>

          <tbody id="tableBody"></tbody>
        </table>

        <ul class="pagination justify-content-center" id="pagination"></ul>
      </div>

    </div>
  </main>

  <!-- ================= ADD MODAL ================= -->
  <div class="modal fade" id="addModal">
    <div class="modal-dialog">
      <form id="addForm" class="modal-content">
        <div class="modal-header">
          <h5>Add Restaurant</h5>
          <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <input name="name" class="form-control mb-2" placeholder="Name" required>
          <input name="email" class="form-control mb-2" placeholder="Email" required>
          <input name="phone" class="form-control mb-2" placeholder="Phone" required>
          <input name="address" class="form-control mb-2" placeholder="Location" required>

          <select name="status" class="form-select">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>

        <div class="modal-footer">
          <button class="btn btn-success">Save</button>
        </div>
      </form>
    </div>
  </div>

  <!-- ================= EDIT MODAL ================= -->
  <div class="modal fade" id="editModal">
    <div class="modal-dialog">
      <form id="editForm" class="modal-content">
        <div class="modal-header">
          <h5>Edit Restaurant</h5>
          <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" name="user_id" id="edit_id">

          <input name="name" id="edit_name" class="form-control mb-2">
          <input name="email" id="edit_email" class="form-control mb-2">
          <input name="phone" id="edit_phone" class="form-control mb-2">
          <input name="address" id="edit_address" class="form-control mb-2">
        </div>

        <div class="modal-footer">
          <button class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>

  <!-- ================= DELETE MODAL ================= -->
  <div class="modal fade" id="deleteModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header bg-danger text-white">
          <h5>Delete</h5>
          <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body text-center">
          Are you sure you want to delete this restaurant?
        </div>

        <div class="modal-footer justify-content-center">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button class="btn btn-danger" onclick="confirmDelete()">Delete</button>
        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    let currentPage = 1;
    let currentSearch = "";
    let deleteId = null;

    // ALERT
    function showAlert(msg, type = "success") {
      document.getElementById("alertBox").innerHTML =
        `<div class="alert alert-${type} alert-dismissible fade show">
    ${msg}
    <button class="btn-close" data-bs-dismiss="alert"></button>
  </div>`;
    }

    // LOAD TABLE
    function loadTable(page = 1) {
      currentPage = page;

      fetch(`search_restaurant.php?page=${page}&search=${currentSearch}`)
        .then(res => res.json())
        .then(data => {
          document.getElementById("tableBody").innerHTML = data.table;
          document.getElementById("pagination").innerHTML = data.pagination;
        });
    }

    // SEARCH
    document.getElementById("searchInput").addEventListener("keyup", function() {
      currentSearch = this.value;
      loadTable(1);
    });

    // ADD
    document.getElementById("addForm").onsubmit = e => {
      e.preventDefault();
      let fd = new FormData(e.target);
      fd.append("action", "add");

      fetch("restaurant_ajax.php", {
          method: "POST",
          body: fd
        })
        .then(res => res.json())
        .then(res => {
          showAlert(res.message);
          loadTable(currentPage);
          bootstrap.Modal.getInstance(document.getElementById("addModal")).hide();
          e.target.reset();
        });
    };

    // EDIT
    function openEditModal(id, name, email, phone, address) {
      edit_id.value = id;
      edit_name.value = name;
      edit_email.value = email;
      edit_phone.value = phone;
      edit_address.value = address;

      new bootstrap.Modal(editModal).show();
    }

    document.getElementById("editForm").onsubmit = e => {
      e.preventDefault();
      let fd = new FormData(e.target);
      fd.append("action", "edit");

      fetch("restaurant_ajax.php", {
          method: "POST",
          body: fd
        })
        .then(res => res.json())
        .then(res => {
          showAlert(res.message, "info");
          loadTable(currentPage);
          bootstrap.Modal.getInstance(editModal).hide();
        });
    };

    // DELETE
    function openDeleteModal(id) {
      deleteId = id;
      new bootstrap.Modal(deleteModal).show();
    }

    function confirmDelete() {
      let fd = new FormData();
      fd.append("action", "delete");
      fd.append("id", deleteId);

      fetch("restaurant_ajax.php", {
          method: "POST",
          body: fd
        })
        .then(res => res.json())
        .then(res => {
          showAlert(res.message, "danger");
          loadTable(currentPage);
          bootstrap.Modal.getInstance(deleteModal).hide();
        });
    }

    // TOGGLE
    function toggleStatus(id) {
      let fd = new FormData();
      fd.append("action", "toggle");
      fd.append("id", id);

      fetch("restaurant_ajax.php", {
          method: "POST",
          body: fd
        })
        .then(res => res.json())
        .then(res => {
          showAlert(res.message, "warning");
          loadTable(currentPage);
        });
    }

    loadTable();
  </script>

</body>

</html>
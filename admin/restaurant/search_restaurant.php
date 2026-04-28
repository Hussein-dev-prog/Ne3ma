<?php
include "../../config/database.php";

$search = $_GET['search'] ?? '';
$page   = $_GET['page'] ?? 1;
$limit  = 5;

$offset = ($page - 1) * $limit;

// COUNT TOTAL
$countQuery = mysqli_query($conn, "
  SELECT COUNT(*) as total
  FROM restaurants r
  LEFT JOIN users u ON r.user_id = u.user_id
  WHERE r.restaurant_name LIKE '%$search%'
     OR u.email LIKE '%$search%'
     OR r.phone LIKE '%$search%'
");

$total = mysqli_fetch_assoc($countQuery)['total'];
$pages = ceil($total / $limit);

// FETCH DATA
$query = mysqli_query($conn, "
  SELECT r.*, u.name, u.email, u.status
  FROM restaurants r
  LEFT JOIN users u ON r.user_id = u.user_id
  WHERE r.restaurant_name LIKE '%$search%'
     OR u.email LIKE '%$search%'
     OR r.phone LIKE '%$search%'
  ORDER BY r.restaurant_id DESC
  LIMIT $limit OFFSET $offset
");

// TABLE HTML
ob_start();

while ($row = mysqli_fetch_assoc($query)):
?>
    <tr>

        <td>
            <strong><?= $row['restaurant_name'] ?></strong><br>
            <small><?= $row['location'] ?></small>
        </td>

        <td>
            <?= $row['email'] ?><br>
            <small><?= $row['phone'] ?></small>
        </td>

        <td>
            <button onclick="toggleStatus(<?= $row['user_id'] ?>)"
                class="badge <?= $row['status'] == 'active' ? 'bg-success' : 'bg-danger' ?>">
                <?= ucfirst($row['status']) ?>
            </button>
        </td>

        <td><?= $row['created_at'] ?></td>

        <td>
            <button class="btn btn-sm btn-outline-primary"
                onclick="openEditModal(
<?= $row['user_id'] ?>,
'<?= $row['restaurant_name'] ?>',
'<?= $row['email'] ?>',
'<?= $row['phone'] ?>',
'<?= $row['location'] ?>'
)">
                <i class="bi bi-pencil"></i>
            </button>

            <button class="btn btn-sm btn-outline-danger"
                onclick="openDeleteModal(<?= $row['user_id'] ?>)">
                <i class="bi bi-trash"></i>
            </button>
        </td>

    </tr>
<?php endwhile;

$table = ob_get_clean();

// PAGINATION HTML
$pagination = '';

for ($i = 1; $i <= $pages; $i++) {
    $active = ($i == $page) ? 'active' : '';
    $pagination .= "<li class='page-item $active'>
                    <a class='page-link' href='#' onclick='loadTable($i)'>$i</a>
                  </li>";
}

echo json_encode([
    "table" => $table,
    "pagination" => $pagination
]);

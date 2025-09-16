<?php
include __DIR__ . '/../config.php';
include $basePath . 'includes/connection.php';

// ✅ Fetch jobs_apply + employee + history + roles
$sql = "
    SELECT 
        ja.apply_id,
        ja.emp_id,
        ja.type,
        
        ja.notice_period,
        ja.company_interest,
        ja.manage_team,
        ja.location_islamabad,
        ja.status,

        te.emp_name,
        te.emp_email,
        te.emp_mobile,
        te.staff,
        te.company,
        te.sps_corporate,

        eh.job_title AS `group`,
      eh.functional_role AS best_fit,

        er.emp_role_name AS role_name
    FROM jobs_apply ja
    LEFT JOIN timelive_emp te 
        ON ja.emp_id = te.emp_id
    LEFT JOIN emp_history eh 
        ON ja.emp_id = eh.emp_id
    LEFT JOIN tbl_emp_roles er 
        ON eh.role_id = er.emp_role_id
    ORDER BY ja.apply_date DESC, ja.apply_time DESC
";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}

echo '<div class="table-responsive">
<table class="table table-bordered table-hover mb-0">
  <thead class="table-light sticky-header">
    <tr>
        <th>Select</th>
        <th>Name</th>
        <th>Type</th>
        <th>Job Status</th>
        <th>Manager</th>
        <th>Company</th>
        <th>Team</th>
        <th class="group">Group</th>
        <th>Practice</th>
        <th>Location</th>
        <th>Mobile No</th>
        <th>Email</th>
        <th>Access</th>
        <th>Staff</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
  </thead>
  <tbody>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

     

       echo "<tr>
        <td><input type='checkbox' name='select_emp[]' value='{$row['emp_id']}'></td>
        <td class='fw-bold'>" . htmlspecialchars($row['emp_name'] ?? '-') . "</td>
        <td><span class='badge bg-primary'>" . htmlspecialchars($row['type'] ?? '-') . "</span></td>
        <td><span class='badge bg-danger'>" . htmlspecialchars($row['notice_period'] ?? '-') . "</span></td>
        <td class='compact'>" . htmlspecialchars($row['role_name'] ?? '-') . "</td>
        <td>" . htmlspecialchars($row['company_interest'] ?? '-') . "</td>
        <td>" . htmlspecialchars($row['manage_team'] ?? '-') . "</td>
        <td>" . htmlspecialchars($row['group'] ?? '-') . "</td>
        <td>" . htmlspecialchars($row['best_fit'] ?? '-') . "</td>
        <td>" . htmlspecialchars($row['location_islamabad'] ?? '-') . "</td>
        <td>" . htmlspecialchars($row['emp_mobile'] ?? '-') . "</td>
        <td class='compact'>" . htmlspecialchars($row['emp_email'] ?? '-') . "</td>
        <td><span class='text-muted'>--</span></td>
        <td><span class='badge bg-info'>" . htmlspecialchars($row['staff'] ?? '-') . "</span></td>
        <td><span class='badge bg-secondary'>" . htmlspecialchars($row['status'] ?? '-') . "</span></td>
        <td>
            <button class='btn btn-outline-dark   '
                    data-bs-toggle='modal' data-bs-target='#actionModal{$row['emp_id']}'>
                <i class='bi bi-list'></i>
            </button>
        </td>
      </tr>";

        // ✅ Modal for each employee
        echo "
        <div class='modal fade' id='actionModal{$row['emp_id']}' tabindex='-1' aria-labelledby='actionModalLabel{$row['emp_id']}' aria-hidden='true'>
          <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
              <div class='modal-header'>
                <h5 class='modal-title'>Choose Action</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
              </div>
              <div class='modal-body text-center'>
                <a href='modules/edit.php?id={$row['emp_id']}' class='btn btn-warning w-100 mb-2'>Edit</a>
                <a href='modules/delete.php?id={$row['emp_id']}' class='btn btn-danger w-100' onclick='return confirm(\"Are you sure?\");'>Delete</a>
              </div>
            </div>
          </div>
        </div>";
    }
} else {
    echo '<tr><td colspan="16" class="text-center">No employees found.</td></tr>';
}

echo '</tbody></table></div>';

mysqli_close($conn);
?>

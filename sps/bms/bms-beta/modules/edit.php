<?php
include "../config.php";
include "includes/connection.php";
include "save.php";

$emp_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Initialize variables to avoid undefined index notices
$emp = $emp ?? [];
$history = $history ?? [];
$commSkills = $commSkills ?? [];
?>
<!DOCTYPE html>
<html>

<head>
    <title>Update Employee Dashboard</title>
    <!-- Add Bootstrap CSS (if not already included globally) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">Update employee dashboard</h2>

    <!-- Trigger Buttons -->
    <div class="mb-3">
        <button class="btn btn-outline-dark w-100 text-start py-3 px-4 shadow-sm rounded"
                data-bs-toggle="modal" data-bs-target="#empModal">
            Edit Employee
        </button>
    </div>
    <div class="mb-3">
        <button class="btn btn-outline-dark w-100 text-start py-3 px-4 shadow-sm rounded"
                data-bs-toggle="modal" data-bs-target="#historyModal">
            Edit History
        </button>
    </div>

    <!-- Employee Information Dropdown -->
    <div class="mb-3 d-flex align-items-center">
        <div class="dropdown w-100">
            <button class="dash-dropdown-btn dropdown-toggle w-100 text-start btn btn-outline-dark py-3 px-4"
                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Employee Information
            </button>
            <ul class="dropdown-menu w-100">
                <li class="d-flex justify-content-between align-items-center px-3">
                    <a class="dropdown-item flex-grow-1" href="#">Personal Information</a>
                    <i class="bi bi-plus-circle text-dark ms-2" role="button" 
                       data-bs-toggle="modal" data-bs-target="#personalinformationModal"></i>
                </li>
                <li class="d-flex justify-content-between align-items-center px-3">
                    <a class="dropdown-item flex-grow-1" href="#">Communication Skills</a>
                    <i class="bi bi-plus-circle text-dark ms-2" role="button" 
                       data-bs-toggle="modal" data-bs-target="#commSkillsModal"></i>
                </li>
            </ul>
        </div>
    </div>

    <!-- Department Attributes -->
    <div class="mb-3 d-flex align-items-center">
        <div class="dropdown w-100">
            <button class="dash-dropdown-btn dropdown-toggle w-100 text-start btn btn-outline-dark py-3 px-4 shadow-sm rounded"
                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Department Attributes
            </button>
            <ul class="dropdown-menu w-100">
                <?php
                $da_items = ["Products", "Customer", "Projects"];
                foreach ($da_items as $item) {
                    $id = strtolower(str_replace(' ', '', $item));
                    echo "
                    <li class='d-flex justify-content-between align-items-center px-3'>
                        <a class='dropdown-item flex-grow-1' href='#'>$item</a>
                        <i class='bi bi-plus-circle text-dark ms-2' role='button' data-bs-toggle='modal' data-bs-target='#{$id}Modal'></i>
                    </li>
                    ";
                }
                ?>
            </ul>
        </div>
    </div>

    <!-- Corporate Leadership -->
    <div class="mb-3 d-flex align-items-center">
        <div class="dropdown w-100">
            <button class="dash-dropdown-btn dropdown-toggle w-100 text-start btn btn-outline-dark py-3 px-4 shadow-sm rounded"
                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Corporate Leadership
            </button>
            <ul class="dropdown-menu w-100">
                <?php
                $cl_items = ["Vendors", "Product", "Services", "Practices", "Partners", "Customers"];
                foreach ($cl_items as $item) {
                    $id = strtolower(str_replace(' ', '', $item));
                    echo "
                    <li class='d-flex justify-content-between align-items-center px-3'>
                        <a class='dropdown-item flex-grow-1' href='#'>$item</a>
                        <i class='bi bi-plus-circle text-dark ms-2' role='button' data-bs-toggle='modal' data-bs-target='#{$id}Modal'></i>
                    </li>
                    ";
                }
                ?>
            </ul>
        </div>
    </div>
</div> <!-- end container -->

<!-- Employee Modal -->
<div class="modal fade" id="empModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form method="post" action="save.php?id=<?= htmlspecialchars($emp_id) ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Employee Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="emp_name" value="<?= htmlspecialchars($emp['emp_name'] ?? '') ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="emp_email" value="<?= htmlspecialchars($emp['emp_email'] ?? '') ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Mobile</label>
                        <input type="text" name="emp_mobile" value="<?= htmlspecialchars($emp['emp_mobile'] ?? '') ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Country</label>
                        <input type="text" name="emp_country" value="<?= htmlspecialchars($emp['emp_country'] ?? '') ?>" class="form-control">
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="staff" <?= !empty($emp['staff']) ? 'checked' : '' ?>>
                        <label class="form-check-label">Staff</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="sps_corporate" <?= !empty($emp['sps_corporate']) ? 'checked' : '' ?>>
                        <label class="form-check-label">Corporate Access</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update_emp" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- History Modal -->
<div class="modal fade" id="historyModal" tabindex="-1">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <form method="post" action="save.php?id=<?= htmlspecialchars($emp_id) ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Employment History</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Start Date</label>
                        <input type="date" name="hire_date" value="<?= htmlspecialchars($history['hire_date'] ?? '') ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>End Date</label>
                        <input type="date" name="termination_date" value="<?= htmlspecialchars($history['termination_date'] ?? '') ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Job Title</label>
                        <input type="text" name="job_title" value="<?= htmlspecialchars($history['job_title'] ?? '') ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Functional Role</label>
                        <input type="text" name="functional_role" value="<?= htmlspecialchars($history['functional_role'] ?? '') ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Corporate Role</label>
                        <input type="text" name="corporate_role" value="<?= htmlspecialchars($history['corporate_role'] ?? '') ?>" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update_history" class="btn btn-success">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Communication Skills Modal -->
<div class="modal fade" id="commSkillsModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form method="post" action="save.php?id=<?= htmlspecialchars($emp_id) ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Communication Skills</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($emp_id) ?>">
                    <div class="mb-3">
                        <label>Writing Score</label>
                        <input type="number" name="count_writing" value="<?= htmlspecialchars($commSkills['count_writing'] ?? '') ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Listening Score</label>
                        <input type="number" name="count_listening" value="<?= htmlspecialchars($commSkills['count_listening'] ?? '') ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Speaking Score</label>
                        <input type="number" name="count_speaking" value="<?= htmlspecialchars($commSkills['count_speaking'] ?? '') ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Comments</label>
                        <textarea name="comments" class="form-control"><?= htmlspecialchars($commSkills['comments'] ?? '') ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Date</label>
                        <input type="date" name="added_on" value="<?= htmlspecialchars($commSkills['added_on'] ?? date('Y-m-d')) ?>" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update_comm" class="btn btn-success">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS (needed for modals & dropdowns) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

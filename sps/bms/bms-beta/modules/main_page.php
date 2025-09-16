<?php
include __DIR__ . '/../config.php'; // Load base path
include $basePath . 'includes/header.php';
include $basePath . 'includes/navbar.php';
?>

<!-- Main Content Wrapper -->


            <div class="flex-grow-1 p-4">
    <div class="body" >

        <!-- Page Title -->
       <h1> </h1>
        <div class="d-flex align-items-center justify-content-between ">
            <h4 class="fw-bold text-dark">
                <i class="bi bi-people-fill me-2"></i> Human Resource Management
            </h4>
            <a href="<?php echo $baseURL; ?>modules/employee_dashboard.php" 
               class="badge text-black fs-6 p-2 shadow-sm text-decoration-none bx-outline-dark bg-light">
                <i class="bi bi-plus-circle text-black me-1"></i> Add New
            </a>
        </div>

        <!-- Filters Card -->
        <div class="card shadow-sm border-0 sticky-top w-100 mb-4" style="top:70px; z-index:10;">
            <div class="card-body">
                <!-- First Row: Show All + Add New + Search -->
                <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
                    <a href="#" class="text-black fw-semibold d-flex align-items-center">
                        <i class="bi bi-funnel-fill me-1"></i> Show All / Active Only
                    </a>
                    <div class="input-group input-group-sm" style="max-width: 250px;">
                        <input type="text" class="form-control bx-outline-dark" placeholder="Search employees...">
                        <button class="btn btn-outline-dark"><i class="bi bi-search bx-outline-dark"></i></button>
                    </div>
                </div>

                <!-- Second Row: Filters -->
                <div class="row g-2 align-items-center">
                    <div class="col-auto">
                        <select class="form-select form-select-sm">
                            <option>Select Department</option>
                            <option>IT</option>
                            <option>OT</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <select class="form-select form-select-sm">
                            <option>Select Group</option>
                            <option>BMS</option>
                            <option>CSM</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <select class="form-select form-select-sm">
                            <option>Select Practice</option>
                            <option>Training</option>
                            <option>Completed</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <select class="form-select form-select-sm">
                            <option>Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <select class="form-select form-select-sm">
                            <option>Select Location</option>
                            <option>US</option>
                            <option>PK</option>
                            <option>ME</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <select class="form-select form-select-sm">
                            <option>Select Type of HR</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <select class="form-select form-select-sm">
                            <option>Select Work Status</option>
                            <option>Full time</option>
                            <option>Part time</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-sm btn-outline-dark">
                            <i class="bi bi-eye text-black"></i> Show
                        </button>
                    </div>

                    <!-- Right side compact controls -->
                    <div class="col-auto ms-auto d-flex align-items-center gap-2">
                        <select class="form-select form-select-sm" style="height:32px; padding:0 8px 2px 4px; font-size:0.85rem;">
                            <option>2025</option>
                            <option>2024</option>
                            <option>2023</option>
                        </select>
                        <select class="form-select form-select-sm" style="height:32px; padding:0 20px 8px 9px; font-size:0.85rem;">
                            <option>Annual</option>
                            <option>Monthly</option>
                        </select>
                        <button class="btn btn-outline-dark text-black p-1 px-2" style="height:32px; line-height:1; white-space: nowrap; font-size:0.85rem;">
                            <i class="bi bi-send-fill"></i> Send Planning Form
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Area -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-dark btn-sm">
                            <i class="bi bi-file-earmark-text"></i> Export CSV
                        </button>
                        <button class="btn btn-outline-dark btn-sm">
                            <i class="bi bi-file-earmark-excel"></i> Export Excel
                        </button>
                    </div>
                </div>

                <!-- ✅ Fetch Data Table -->
                <div class="table-responsive">
                    <?php include $basePath . "modules/fetch_data.php"; ?>
                </div>
            </div>
        </div>

    </div> <!-- container-fluid -->
</div> <!-- flex-grow -->

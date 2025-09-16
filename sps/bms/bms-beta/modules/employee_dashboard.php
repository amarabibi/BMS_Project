<?php
include __DIR__ . '/../config.php'; // Load base path and URL

include $basePath . 'includes/header.php';
include $basePath . 'includes/navbar.php';
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const BASE_URL = "/my-site/sps/bms/bms-beta/";
</script>
<!-- ✅ Main Layout Wrapper -->
<div class=" " style="margin-top:56px;">




    <div class="flex-grow-1 p-4 bg-light">
        <div class=" employeeTableContainer container-xxl ">

            <h1 class="mb-4 fw-bold">Employee Dashboard</h1>

            <!-- Employee Personal Information -->
            <div class="mb-3 d-flex align-items-center">
                <div class="dropdown  w-100">
                    <!-- Dropdown Toggle -->
                    <button class="dash-dropdown-btn dropdown-toggle w-100 text-start btn btn-outline-dark w-100 text-start py-3 px-4 " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Employee Information
                    </button>

                    <!-- Dropdown Menu -->
                    <ul class="dropdown-menu w-100 ">
                        <?php
                        $epi_items = [
                            "Personal Information",
                            "Education",
                            "Guardian Info",
                            "Supervisor",
                            "Attachments",
                            "Learning and Development",
                            "Communication Skills",
                            "Employment Certification",
                            "Employment Badges"
                        ];

                        foreach ($epi_items as $item) {
                            $id = strtolower(str_replace(' ', '', $item));

                            echo "
                <li class='d-flex justify-content-between align-items-center px-3'>

                    <!-- Dropdown Item -->
                    <a class='dropdown-item flex-grow-1' href='#'>
                        $item
                    </a>

                    <!-- Action Button (Modal Trigger) -->
                    <i class='bi bi-plus-circle text-dark ms-2' role='button' data-bs-toggle='modal' data-bs-target='#{$id}Modal'></i>

                    <!-- Hidden Form -->
                    <form id='{$id}Form' action='{$baseURL}modules/backend/employee_data/' method='post' class='d-none'>
                        <input type='hidden' name='section' value='{$item}'>
                        <!-- Add other hidden fields as needed -->
                    </form>
                </li>
                ";
                        }
                        ?>
                    </ul>
                </div>
            </div>


            <!-- Roles -->
          <!-- Add New Role Modal -->
             <div class="mb-3">
                <button class="btn btn-outline-dark w-100 text-start py-3 px-4 shadow-sm rounded"
                    data-bs-toggle="modal" data-bs-target="#addRoleModal">
                    <i class=""></i>Add role
                </button>
            </div>
<div class="modal fade" id="addRoleModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info  text-white">
        <h5 class="modal-title">Add New Role</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form method="POST" action="tbl_emp_roles.php">
        <div class="modal-body">
          <div class="row">
            
            <!-- Department -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Department <span class="text-danger">*</span></label>
              <select name="department_id" class="form-control" required>
                <option value="">Select Department</option>
                <option value="1">Human Resources</option>
                <option value="2">Finance</option>
                <option value="3">IT</option>
                <option value="4">Marketing</option>
              </select>
            </div>

            <!-- Group -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Group <span class="text-danger">*</span></label>
              <select name="group_id" class="form-control" required>
                <option value="">Select Group</option>
                <option value="1">Management</option>
                <option value="2">Development</option>
                <option value="3">Support</option>
                <option value="4">Operations</option>
              </select>
            </div>

            <!-- Practice -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Practice <span class="text-danger">*</span></label>
              <select name="practice_id" class="form-control" required>
                <option value="">Select Practice</option>
                <option value="1">Agile</option>
                <option value="2">Waterfall</option>
                <option value="3">Scrum</option>
                <option value="4">DevOps</option>
              </select>
            </div>

            <!-- Role -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Role <span class="text-danger">*</span></label>
              <input type="text" name="emp_role_name" class="form-control" placeholder="Enter Role Name" required>
            </div>

            <!-- Level -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Level</label>
              <select name="category" class="form-control">
                <option value="">Select Level</option>
                <option value="Junior">Junior</option>
                <option value="Mid">Mid</option>
                <option value="Senior">Senior</option>
                <option value="Lead">Lead</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
      <div class="errorBox"></div>

    </div>
  </div>
</div>



            <!-- Employee History -->
            <div class="mb-3">
                <button class="btn btn-outline-dark w-100 text-start py-3 px-4 shadow-sm rounded"
                    data-bs-toggle="modal" data-bs-target="#jobroleModal">
                    <i class=""></i> Employee History
                </button>
            </div>
<div class="modal fade" id="jobroleModal" tabindex="-1" aria-labelledby="jobroleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-scrollable">
    <div class="modal-content">
      <div class="modal-header text-white bg-info">
        <h5 class="modal-title" id="jobroleModalLabel">Employment History</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form id="historyform" action="<?php echo $baseURL ?>modules/employment_history.php" method="post">
        <div class="modal-body">
          <div class="row g-3">
            <!-- Department -->
            <div class="col-md-6">
              <label class="form-label">Department <span class="text-danger">*</span></label>
              <select name="department_id" class="form-control" required>
                <option value="">Select Department</option>
                <option value="1">Human Resources</option>
                <option value="2">Finance</option>
                <option value="3">IT</option>
                <option value="4">Marketing</option>
              </select>
            </div>

            <!-- Group -->
            <div class="col-md-6">
              <label class="form-label">Group <span class="text-danger">*</span></label>
              <select name="group_id" class="form-control" required>
                <option value="">Select Group</option>
                <option value="1">Management</option>
                <option value="2">Development</option>
                <option value="3">Support</option>
                <option value="4">Operations</option>
              </select>
            </div>
          </div>

          <div class="row g-3 mt-3">
            <!-- Practice -->
            <div class="col-md-6">
              <label class="form-label">Practice <span class="text-danger">*</span></label>
              <select name="practice_id" class="form-control" required>
                <option value="">Select Practice</option>
                <option value="1">Agile</option>
                <option value="2">Waterfall</option>
                <option value="3">Scrum</option>
                <option value="4">DevOps</option>
              </select>
            </div>

            <!-- Role -->
            <div class="col-md-6">
              <label class="form-label">Role <span class="text-danger">*</span></label>
              <select name="role_id" class="form-control" required>
                <option value="">Select Role</option>
                <option value="1">Developer</option>
                <option value="2">Team Lead</option>
                <option value="3">Project Manager</option>
                <option value="4">Analyst</option>
              </select>
            </div>
          </div>

          <div class="row g-3 mt-3">
            <!-- Job Title -->
            <div class="col-md-6">
              <label class="form-label">Job Title <span class="text-danger">*</span></label>
              <select name="job_title" class="form-control" required>
                <option value="">Select Job Title</option>
                <option value="Software Engineer">Software Engineer</option>
                <option value="Senior Developer">Senior Developer</option>
                <option value="Technical Lead">Technical Lead</option>
                <option value="Project Manager">Project Manager</option>
              </select>
            </div>

            <!-- Functional Level -->
            <div class="col-md-6">
              <label class="form-label">Functional Level <span class="text-danger">*</span></label>
              <select name="functional_role" class="form-control" required>
                <option value="">Select Level</option>
                <option value="Junior">Junior</option>
                <option value="Mid">Mid</option>
                <option value="Senior">Senior</option>
                <option value="Lead">Lead</option>
              </select>
            </div>
          </div>

          <div class="row g-3 mt-3">
            <!-- Corporate Role -->
            <div class="col-md-6">
              <label class="form-label">Corporate Role <span class="text-danger">*</span></label>
              <select name="corporate_role" class="form-control" required>
                <option value="">Select Corporate Role</option>
                <option value="Staff">Staff</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Manager">Manager</option>
                <option value="Director">Director</option>
              </select>
            </div>

            <!-- Hire Date -->
            <div class="col-md-6">
              <label class="form-label">Hire Date <span class="text-danger">*</span></label>
              <input type="date" name="hire_date" class="form-control" required>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
      <div class="errorBox"></div>

    </div>
  </div>
</div>



            <!-- Personal Leadership -->
            <div class="mb-3">
                <button class="btn btn-outline-dark w-100 text-start py-3 px-4 shadow-sm rounded"
                    data-bs-toggle="modal" data-bs-target="#leadershipModal">
                    <i class=""></i> Personal Leadership
                </button>
            </div>

            <div class="modal fade" id="leadershipModal" tabindex="-1" aria-labelledby="leadershipLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">

                        <div class="modal-header text-white bg-info ">
                            <h5 class="modal-title" id="leadershipLabel">Personal Leadership</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form id="leadershipForm" action="#" method="POST">
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Leadership Incentives <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="leadership_incentives" placeholder="Enter incentives">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">% Multiplier <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="multiplier" placeholder="Enter % multiplier">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Practice Multiplier <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="practice_multiplier" placeholder="Enter practice multiplier">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">KPI Target <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="kpi_target" placeholder="Enter KPI target">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">KPI Actual <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="kpi_actual" placeholder="Enter KPI actual">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Bonus Target <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="bonus_target" placeholder="Enter bonus target">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Bonus Actual <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="bonus_actual" placeholder="Enter bonus actual">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Plan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="plan" placeholder="Enter plan">
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                        <div class="errorBox"></div>



                    </div>
                </div>
            </div>

            <!-- Department Attributes -->
            <div class="mb-3 d-flex align-items-center">
                <div class="dropdown w-100">
                    <!-- Dropdown Toggle -->
                    <button class="dash-dropdown-btn dropdown-toggle w-100 text-start btn btn-outline-dark py-3 px-4 shadow-sm rounded"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Department Attributes
                    </button>

                    <!-- Dropdown Menu -->
                    <ul class="dropdown-menu w-100">
                        <?php
                        $da_items = ["Products", "Customer", "Projects"];
                        shuffle($da_items); // random order if needed

                        foreach ($da_items as $item) {
                            $id = strtolower(str_replace(' ', '', $item));

                            echo "
                <li class='d-flex justify-content-between align-items-center px-3'>
                    <!-- Dropdown Item -->
                    <a class='dropdown-item flex-grow-1' href='#'>$item</a>

                    <!-- Action Button (Modal Trigger) -->
                    <i class='bi bi-plus-circle text-dark ms-2' role='button' data-bs-toggle='modal' data-bs-target='#{$id}Modal'></i>

                    <!-- Hidden Form -->
                    <form id='{$id}Form' action='{$baseURL}modules/tbl_emp_roles.php' method='post' class='d-none'>
                        <input type='hidden' name='section' value='{$item}'>
                    </form>
                    <div class='errorBox'></div>

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
                    <!-- Dropdown Toggle -->
                    <button class="dash-dropdown-btn dropdown-toggle w-100 text-start btn btn-outline-dark py-3 px-4 shadow-sm rounded"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Corporate Leadership
                    </button>

                    <!-- Dropdown Menu -->
                    <ul class="dropdown-menu w-100">
                        <?php
                        $cl_items = ["Vendors", "Product", "Services", "Practices", "Partners", "Customers"];
                        shuffle($cl_items); // random order if needed

                        foreach ($cl_items as $item) {
                            $id = strtolower(str_replace(' ', '', $item));

                            echo "
                <li class='d-flex justify-content-between align-items-center px-3'>
                    <!-- Dropdown Item -->
                    <a class='dropdown-item flex-grow-1' href='#'>$item</a>

                    <!-- Action Button (Modal Trigger) -->
                    <i class='bi bi-plus-circle text-dark ms-2' role='button' data-bs-toggle='modal' data-bs-target='#{$id}Modal'></i>

                    <!-- Hidden Form -->
                    <form id='{$id}Form' action='{$baseURL}modules/tbl_emp_roles.php' method='post' class='d-none'>
                        <input type='hidden' name='section' value='{$item}'>
                    </form>
                    <div class='errorBox'></div>

                </li>
                ";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div><!-- /.d-flex -->

<!-- Modals -->
<?php
$all_items = array_merge($epi_items, $da_items, $cl_items);

foreach ($all_items as $item) {
    $id = strtolower(str_replace(' ', '', $item));
    //Education
    if ($id === "education") {
        echo "
<div class='modal fade' id='{$id}Modal' tabindex='-1'>
    <div class='modal-dialog modal-lg'>
        <div class='modal-content'> 
            <div class='modal-header text-white bg-info '>
                <h5 class='modal-title'>Add Education</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
            </div>
            <div class='modal-body'>
                <form id='educationform' action='{$baseURL}modules/education_backend.php' method='post'>
                    <div class='row mb-3 from-fields' >
                        <div class='col-md-6'>
                            <label class='form-label'>University</label>
                            <input type='text' name='edu_level' class='form-control' required />
                        </div>
                        <div class='col-md-6'>
                            <label class='form-label'>Field of Study</label>
                            <input type='text' name='field_studies' class='form-control' required />
                        </div>
                    </div>
                    <div class='row mb-3'>
                        <div class='col-md-4'>
                            <label class='form-label'>Passing Year</label>
                            <input type='number' name='passing_year' class='form-control' required />
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Course</label>
                            <input type='text' name='course' class='form-control' required />
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Grade/GPA</label>
                            <input type='text' name='grade' class='form-control' required />
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                        <button type='submit' id='savebutton' class='btn btn-primary'>Save</button>
                    </div>
                </form>
                <div class='errorBox'></div>

               
<div id='response'></div>
            </div>
        </div>
    </div>
</div>
    ";
    }
    //Supervisor

    elseif ($item === "Supervisor") {
        echo "
    <div class='modal fade' id='{$id}Modal' tabindex='-1'>
        <div class='modal-dialog modal-lg modal-dialog-scrollable'>
            <div class='modal-content'>
                <div class='modal-header text-white bg-info '>
                    <h5 class='modal-title'>Add Supervisor</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div>
                <div class='modal-body'>
                    <form id='supervisorform' action='{$baseURL}modules/timelive_emp.php' method='POST'>

                        <div class='row g-3'>
                            <div class='col-md-6'>
                                <label class='form-label'>Name *</label>
                                <input type='text' name='emp_name' class='form-control' required>
                            </div>

                            <div class='col-md-6'>
                                <label class='form-label'>Email *</label>
                                <input type='email' name='emp_email' class='form-control' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Mobile</label>
                                <input type='text' name='emp_mobile' class='form-control'>
                            </div>

                           
                            <div class='col-md-6'>
                                <label class='form-label'>Company</label>
                                <input type='text' name='company' value='422' class='form-control'>
                            </div>

                            <div class='col-md-6'>
                                <div class='form-check'>
                                    <input class='form-check-input' type='checkbox' name='sps_corporate' value='1' id='spsCorporate'>
                                    <label class='form-check-label' for='spsCorporate'>SPS Corporate</label>
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class='form-check'>
                                    <input class='form-check-input' type='checkbox' name='staff' value='1' id='staffCheck'>
                                    <label class='form-check-label' for='staffCheck'>Staff</label>
                                </div>
                            </div>

                        </div>

                        <div class='mt-3 text-end'>
                            <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                        <button type='submit' id='savebutton' class='btn btn-primary'>Save</button>
                    </div>
                        </div>
                    </form>
                    <div class='errorBox'></div>

                    <div id='response'></div>
                </div>
            </div>
        </div>
    </div>
    ";
    }

    // Guardian Info Modal
    elseif ($item === "Guardian Info") {
        echo "
    <div class='modal fade' id='{$id}Modal' tabindex='-1' id='employeeTableContainer'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header text-white bg-info '>
                    <h5 class='modal-title'>Add Guardian Information</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div>
                <div class='modal-body'>
                    <form action='../modules/timelive_emp_detail.php' method='POST'>
                        <div class='row mb-3'>
                            <div class='col-md-6'>
                                <label class='form-label'>Employee CNIC</label>
                                <input type='text' class='form-control'>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Parent/Guardian Name</label>
                                <input type='text' class='form-control'>
                            </div>
                        </div>
                        <div class='row mb-3'>
                            <div class='col-md-6'>
                                <label class='form-label'>Parent/Guardian Contact</label>
                                <input type='text' class='form-control' name='emergency_no'>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Parent/Guardian Address</label>
                                <textarea class='form-control' rows='1' name='home_no'></textarea>
                            </div>
                        </div>
                       <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                        <button type='submit' id='savebutton' class='btn btn-primary'>Save</button>
                    </div>
                    </form>
                    <div class='errorBox'></div>

                </div>
            </div>
        </div>
    </div>
    ";
    }
    //Attachments
    elseif ($item === "Attachments") {
        echo "
    <div class='modal fade' id='{$id}Modal' tabindex='-1'>
        <div class='modal-dialog modal-md'>
            <div class='modal-content'>
                <div class='modal-header text-white bg-info '>
                    <h5 class='modal-title'>Add Attachments</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div>
                <div class='modal-body'>
                    <form id='docsform' action='{$baseURL}modules/timelive_emp_docs.php' method='post' enctype='multipart/form-data'>
                        <div class='mb-3'>
                            <label class='form-label'>Employee ID</label>
                            <input type='number' name='emp_id' class='form-control' required>
                        </div>
                        <div class='mb-3'>
                            <label class='form-label'>Document Title</label>
                            <input type='text' name='doc_title' class='form-control' required>
                        </div>
                        <div class='mb-3'>
                            <label class='form-label'>Upload Document</label>
                            <input type='file' name='doc_attachment' class='form-control'>
                        </div>
                        <div class='mb-3'>
                            <label class='form-label'>Added By (Date)</label>
                            <input type='date' name='added_by' class='form-control'>
                        </div>
                       <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                        <button type='submit' id='savebutton' class='btn btn-primary'>Save</button>
                    </div>
                    </form>
                    <div class='errorBox'></div>

                </div>
            </div>
        </div>
    </div>
    ";
    }

    //Communication Skills Modal
    elseif ($item === "Communication Skills") {
        echo "
    <div class='modal fade' id='{$id}Modal' tabindex='-1'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header text-white bg-info '>
                    <h5 class='modal-title'>Add Communication Skills</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div>
                <div class='modal-body'>
                    <form id='learningform' action='{$baseURL}modules/timelive_emp_communication_skills.php' method='POST'>
                        <div class='row mb-3'>
                            <div class='col-md-4'>
                                <label class='form-label'>Writing</label>
                                <input type='text' name='count_writing' class='form-control'>
                            </div>
                            <div class='col-md-4'>
                                <label class='form-label'>Listening</label>
                                <input type='text' name='count_listening' class='form-control'>
                            </div>
                            <div class='col-md-4'>
                                <label class='form-label'>Speaking</label>
                                <input type='text' name='count_speaking' class='form-control'>
                            </div>
                        </div>

                        <div class='row mb-3'>
                            <div class='col-12'>
                                <label class='form-label'>Comments</label>
                                <textarea name='comments' class='form-control' rows='3'></textarea>
                            </div>
                        </div>
<div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                        <button type='submit' id='savebutton' class='btn btn-primary'>Save</button>
                    </div>
                    </form>
                    <div class='errorBox'></div>

                    <div id='response'></div>
                </div>
            </div>
        </div>
    </div>
    ";
    }


    // Learning & Development Modal
    elseif ($item === "Learning and Development") {
        echo "
    <div class='modal fade' id='{$id}Modal' tabindex='-1'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header text-white bg-info '>
                    <h5 class='modal-title'>Add Learning and Development</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div>
                <div class='modal-body'>
                    <form id='learningform' action='{$baseURL}modules/timelive_emp_communication_skills.php' method='POST'>
                        <div class='row mb-3'>
                            <div class='col-md-4'>
                                <label class='form-label'>Writing</label>
                                <input type='text' name='count_writing' class='form-control'>
                            </div>
                            <div class='col-md-4'>
                                <label class='form-label'>Listening</label>
                                <input type='text' name='count_listening' class='form-control'>
                            </div>
                            <div class='col-md-4'>
                                <label class='form-label'>Speaking</label>
                                <input type='text' name='count_speaking' class='form-control'>
                            </div>
                        </div>

                        <div class='row mb-3'>
                            <div class='col-12'>
                                <label class='form-label'>Comments</label>
                                <textarea name='comments' class='form-control' rows='3'></textarea>
                            </div>
                        </div>

                        

                        <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                        <button type='submit' id='savebutton' class='btn btn-primary'>Save</button>
                    </div>
                    </form>
                    <div class='errorBox'></div>

                    <div id='response'></div>
                </div>
            </div>
        </div>
    </div>
    ";
    }

    // employee certification
   elseif ($item === "Employment Certification") {
    echo "
    <div class='modal fade' id='{$id}Modal' tabindex='-1'>
        <div class='modal-dialog modal-lg modal-dialog-scrollable'>
            <div class='modal-content'>
                <div class='modal-header text-white bg-info '>
                    <h5 class='modal-title'>Employee Certifications</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div>
                <div class='modal-body'>
                    <form id='certForm' action='{$baseURL}modules/timelive_emp_certs.php' method='POST' enctype='multipart/form-data'>
                        
                        <!-- Title ID & Cert Code -->
                        <div class='row mb-3'>
                            <div class='col-md-6'>
                                <label class='form-label'>Title ID</label>
                                <input type='number' name='certtitle_id' class='form-control'>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Cert Code</label>
                                <input type='text' name='cert_code' class='form-control' required>
                            </div>
                        </div>

                        <!-- URL & Status -->
                        <div class='row mb-3'>
                            <div class='col-md-6'>
                                <label class='form-label'>URL</label>
                                <input type='url' name='cert_url' class='form-control'>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Status</label>
                                <select name='cert_status' class='form-select' required>
                                    <option value='' disabled selected>Select Status</option>
                                    <option value='Active'>Active</option>
                                    <option value='Expired'>Expired</option>
                                    <option value='In Progress'>In Progress</option>
                                </select>
                            </div>
                        </div>

                        <!-- Exam Date & Expiry Date -->
                        <div class='row mb-3'>
                            <div class='col-md-6'>
                                <label class='form-label'>Exam Date</label>
                                <input type='date' name='cert_exam_date' class='form-control'>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Expiry Date</label>
                                <input type='date' name='cert_expiry_date' class='form-control'>
                            </div>
                        </div>

                        <!-- Score & Attachment -->
                        <div class='row mb-3'>
                            <div class='col-md-6'>
                                <label class='form-label'>Score</label>
                                <input type='text' name='cert_score' class='form-control'>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Attachment</label>
                                <input type='file' name='cert_attachment' class='form-control' accept='.pdf,.jpg,.png,.docx'>
                                <div class='mt-2'>
                                    <small class='text-muted'>Allowed: PDF, JPG, PNG, DOCX</small><br>
                                    <img id='filePreview' src='' alt='Preview' style='max-width:100px; display:none;' />
                                </div>
                            </div>
                        </div>

                        <!-- Created On -->
                        <div class='row mb-3'>
                            <div class='col-md-6'>
                                <label class='form-label'>Created On</label>
                                <input type='date' name='created_on' class='form-control' required>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                            <button type='submit' id='savebutton' class='btn btn-primary'>Save</button>
                        </div>

                    </form>
                    <div class='errorBox'></div>

                </div>
            </div>
        </div>
    </div>
    ";
}


    // Employment Badges
    elseif ($item === "Employment Badges") {
        echo "
    <div class='modal fade' id='{$id}Modal' tabindex='-1'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header text-white bg-info '>
                    <h5 class='modal-title'>Employee Badges</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div>
                <div class='modal-body'>
                    <form id='badgeForm' action='{$baseURL}modules/timelive_emp_badges.php' method='POST' enctype='multipart/form-data'>
                        <div class='row mb-3'>
                            <div class='col-md-6'>
                                <label class='form-label'>Badge Title</label>
                                <input type='text' name='badge_title' class='form-control' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Badge URL</label>
                                <input type='url' name='badge_url' class='form-control'>
                            </div>
                        </div>

                        <div class='row mb-3'>
                            <div class='col-md-6'>
                                <label class='form-label'>Completed On</label>
                                <input type='date' name='completed_on' class='form-control'>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Expiry Date</label>
                                <input type='date' name='expiry_date' class='form-control'>
                            </div>
                        </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Created On</label>
                                <input type='date' name='created_on' class='form-control' required>
                            </div>
                        </div>

                        <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                        <button type='submit' id='savebutton' class='btn btn-primary'>Save</button>
                    </div>
                    </form>
                    <div class='errorBox'></div>

                </div>
            </div>
        </div>
    </div>
    ";
    }

    //personal information
elseif ($item === "Personal Information") {
    echo "
    <div class='modal fade' id='{$id}Modal' tabindex='-1'>
        <div class='modal-dialog modal-xl modal-dialog-scrollable'>
            <div class='modal-content'>
                <div class='modal-header text-white bg-info'>
                    <h5 class='modal-title'>Add Employee Information</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div>
                <div class='modal-body'>
                    <form id='personalform' class='row g-3' action='{$baseURL}modules/jobs_apply.php' method='post' enctype='multipart/form-data'>

                        <!-- Basic Info -->
                        <h6 class='fw-bold'>Basic Info</h6>
                        <div class='col-md-4'>
                            <label class='form-label'>Name</label>
                            <input type='text' name='emp_name' class='form-control'>
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Type</label>
                            <select name='emp_type' class='form-select'>
                                <option value=''>Select</option>
                                <option value='Permanent'>Permanent</option>
                                <option value='Contract'>Contract</option>
                                <option value='Intern'>Intern</option>
                            </select>
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Work Status</label>
                            <select name='work_status' class='form-select'>
                                <option value=''>Select</option>
                                <option value='Active'>Active</option>
                                <option value='On Leave'>On Leave</option>
                                <option value='Resigned'>Resigned</option>
                            </select>
                        </div>

                        <!-- Contact Info -->
                        <h6 class='fw-bold mt-3'>Contact Info</h6>
                        <div class='col-md-4'>
                            <label class='form-label'>Official Email</label>
                            <input type='email' name='emp_email' class='form-control'>
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Personal Email</label>
                            <input type='email' name='personal_email' class='form-control'>
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Mobile No</label>
                            <input type='text' name='emp_mobile' class='form-control'>
                        </div>

                        <!-- Personal Info -->
                        <h6 class='fw-bold mt-3'>Personal Info</h6>
                        <div class='col-md-4'>
                            <label class='form-label'>Gender</label>
                            <select name='emp_gender' class='form-select'>
                                <option value='Male'>Male</option>
                                <option value='Female'>Female</option>
                            </select>
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Date of Birth</label>
                            <input type='date' name='dob' class='form-control'>
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Location</label>
                            <select name='location' class='form-select'>
                                <option value=''>Select Location</option>
                                <option value='Lahore'>Lahore</option>
                                <option value='Karachi'>Karachi</option>
                                <option value='Islamabad'>Islamabad</option>
                            </select>
                        </div>
                        <div class='col-md-12'>
                            <label class='form-label'>Residential Address</label>
                            <textarea name='emp_address' class='form-control' rows='2'></textarea>
                        </div>

                        <!-- Job Info -->
                        <h6 class='fw-bold mt-3'>Job Information</h6>
                        <div class='col-md-4'>
                            <label class='form-label'>Job Title</label>
                            <select name='job_title' class='form-select'>
                                <option value=''>Select</option>
                                <option value='Junior Developer'>Junior Developer</option>
                                <option value='Senior Developer'>Senior Developer</option>
                                <option value='Team Lead'>Team Lead</option>
                                <option value='Project Manager'>Project Manager</option>
                            </select>
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Job</label>
                            <select name='emp_level' class='form-select'>
                                <option value=''>Select</option>
                                <option value='Entry'>Entry</option>
                                <option value='Mid'>Mid</option>
                                <option value='Senior'>Senior</option>
                                <option value='Lead'>Lead</option>
                            </select>
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Business Area</label>
                            <input type='text' name='business_area' class='form-control'>
                        </div>

                        <!-- Department Info -->
                        <h6 class='fw-bold mt-3'>Department</h6>
                        <div class='col-md-4'>
                            <label class='form-label'>Department</label>
                            <select name='department' class='form-select'>
                                <option value=''>Select</option>
                                <option value='IT'>IT</option>
                                <option value='HR'>HR</option>
                                <option value='Finance'>Finance</option>
                                <option value='Marketing'>Marketing</option>
                            </select>
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Group</label>
                            <select name='group' class='form-select'>
                                <option value=''>Select</option>
                                <option value='Scrum'>Scrum</option>
                                <option value='Agile'>Agile</option>
                                <option value='DevApps'>DevApps</option>
                            </select>
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Practice</label>
                            <select name='practice' class='form-select'>
                                <option value=''>Select</option>
                                <option value='Web Development'>Web Development</option>
                                <option value='App Development'>App Development</option>
                                <option value='Cloud Computing'>Cloud Computing</option>
                            </select>
                        </div>

                        <!-- Education -->
                        <h6 class='fw-bold mt-3'>Education</h6>
                        <div class='col-md-4'>
                            <label class='form-label'>Educational Level</label>
                            <select name='educational_level' class='form-select'>
                                <option value=''>Select</option>
                                <option value='Bachelor'>Bachelor</option>
                                <option value='Master'>Master</option>
                                <option value='PhD'>PhD</option>
                                <option value='Diploma'>Diploma</option>
                            </select>
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Field of Studies</label>
                            <select name='field_of_studies' class='form-select'>
                                <option value=''>Select</option>
                                <option value='Computer Science'>Computer Science</option>
                                <option value='Information Technology'>Information Technology</option>
                                <option value='Software Engineering'>Software Engineering</option>
                                <option value='Business Administration'>Business Administration</option>
                            </select>
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Company</label>
                            <select name='company_interest' class='form-select'>
                                <option value=''>Select</option>
                                <option value='SPS'>SPS</option>
                                <option value='ABC Pvt Ltd'>ABC Pvt Ltd</option>
                                <option value='XYZ Ltd'>XYZ Ltd</option>
                                <option value='TechSoft'>TechSoft</option>
                            </select>
                        </div>

                        <!-- Employment -->
                        <h6 class='fw-bold mt-3'>Employment</h6>
                        <div class='col-md-4'>
                            <label class='form-label'>Total Employment (Years)</label>
                            <input type='text' name='total_employment' class='form-control'>
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Hire Source</label>
                            <select name='hire_source' class='form-select'>
                                <option value=''>Select</option>
                                <option value='LinkedIn'>LinkedIn</option>
                                <option value='Job Portal'>Job Portal</option>
                                <option value='Referral'>Referral</option>
                                <option value='Walk-in'>Walk-in</option>
                            </select>
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Employee Picture</label>
                            <input type='file' name='emp_picture' class='form-control'>
                        </div>

                        <!-- Job Application Details -->
                        <h6 class='fw-bold mt-3'>Job Application</h6>
                        <div class='col-md-4'>
                            <label class='form-label'>Cover Letter</label>
                            <input type='file' name='cover_letter' class='form-control'>
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Experience Years</label>
                            <input type='text' name='experience_years' class='form-control'>
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Current Salary</label>
                            <input type='text' name='current_salary' class='form-control'>
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Expected Salary</label>
                            <input type='text' name='expected_salary' class='form-control'>
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Job Type</label>
                            <select name='notice_period' class='form-select'>
                                <option value=''>Select</option>
                                <option value='Full time'>Full time</option>
                                 <option value='Part time'>Part time</option>
                            </select>
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Portfolio</label>
                            <input type='text' name='portfolio' class='form-control'>
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Tool Proficiency</label>
                            <input type='text' name='tool_proficiency' class='form-control'>
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Best Fit</label>
                            <input type='text' name='best_fit' class='form-control'>
                        </div>
                        <div class='col-md-4'>
                            <label class='form-label'>Manage Team</label>
                            <input type='text' name='manage_team' class='form-control'>
                        </div>

                        <!-- Submit -->
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                            <button type='submit' id='savebutton' class='btn btn-primary'>Save</button>
                        </div>
                        <div id='response' class='mt-2'></div>
                    </form>
                    <div class='errorBox'></div>

                </div>
            </div>
        </div>
    </div>
    ";
}


    //Department attributes
// Products Modal
elseif ($item === "Products") {
    echo "
    <div class='modal fade' id='{$id}Modal' tabindex='-1'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header text-white bg-info '>
                    <h5 class='modal-title'>Add Product</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div>
                <div class='modal-body'>
                    <form action='{$baseURL}modules/' method='POST'>
                        <input type='hidden' name='section' value='Products'>

                        <div class='row mb-3'>
                        <div class='col-md-6'>
                                <label class='form-label'>Product ID</label>
                                <input type='number' name='prod_id' class='form-control' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Product Name</label>
                                <input type='text' name='prod_name' class='form-control' required>
                            </div>
                            
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                            <button type='submit' class='btn btn-primary'>Save</button>
                        </div>
                    </form>
                    <div class='errorBox'></div>

                </div>
            </div>
        </div>
    </div>";
}

// Customer Modal
elseif ($item === "Customer") {
    echo "
    <div class='modal fade' id='{$id}Modal' tabindex='-1'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header text-white bg-info '>
                    <h5 class='modal-title'>Add Customer</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div>
                <div class='modal-body'>
                    <form action='{$baseURL}modules/' method='POST'>
                        <input type='hidden' name='section' value='Customer'>

                        <div class='row mb-3'>
                            <div class='col-md-6'>
                                <label class='form-label'>Customer ID</label>
                                <input type='text' name='cust_id' class='form-control' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Customer name</label>
                                <input type='text' name='cust_name' class='form-control'>
                            </div>
                        </div>

                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                            <button type='submit' class='btn btn-primary'>Save</button>
                        </div>
                    </form>
                    <div class='errorBox'></div>

                </div>
            </div>
        </div>
    </div>";
}


// Projects Modal
elseif ($item === "Projects") {
    echo "
    <div class='modal fade' id='{$id}Modal' tabindex='-1'>
        <div class='modal-dialog modal-lg modal-dialog-scrollable'>
            <div class='modal-content'>
                <div class='modal-header text-white bg-info '>
                    <h5 class='modal-title'>Add Project</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div>
                <div class='modal-body'>
                    <form action='{$baseURL}modules/
                    ' method='POST'>
                        <input type='hidden' name='section' value='Projects'>

                        <div class='row mb-3'>
                            <div class='col-md-6'>
                                <label class='form-label'>Project ID</label>
                                <input type='number' name='proj_id' class='form-control' 
                                >
                            </div>
                           <div class='col-md-6'>
                               <label class='form-label'>Project name</label>
                               <input name='proj_name' class='form-control' 
                               >
                           </div>
                        </div>

                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                            <button type='submit' class='btn btn-primary'>Save</button>
                        </div>
                    </form>
                    <div class='errorBox'></div>

                </div>
            </div>
        </div>
    </div>";
}

// Products Modal

// Product Modal
elseif ($item === "Product") {
    echo "
    <div class='modal fade' id='{$id}Modal' tabindex='-1'>
        <div class='modal-dialog modal-lg modal-dialog-scrollable'>
            <div class='modal-content'>
                <div class='modal-header text-white bg-info'>
                    <h5 class='modal-title'>Add Product</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div>
                <div class='modal-body'>
                    <form action='{$baseURL}modules/product_management.php' method='POST' enctype='multipart/form-data'>
                        <input type='hidden' name='section' value='Products'>

                        <div class='row g-3'>
                            <div class='col-md-6'>
                                <label class='form-label'>Product Name <span class='text-danger'>*</span></label>
                                <input type='text' name='prod_name' class='form-control' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>% Multiplier <span class='text-danger'>*</span></label>
                                <input type='number' class='form-control' name='multiplier' placeholder='Enter % multiplier' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Practice Multiplier <span class='text-danger'>*</span></label>
                                <input type='number' class='form-control' name='practice_multiplier' placeholder='Enter practice multiplier' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>KPI Target <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='kpi_target' placeholder='Enter KPI target' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>KPI Actual <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='kpi_actual' placeholder='Enter KPI actual' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Bonus Target <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='bonus_target' placeholder='Enter bonus target' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Bonus Actual <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='bonus_actual' placeholder='Enter bonus actual' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Plan <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='plan' placeholder='Enter plan' required>
                            </div>
                        </div>

                        <div class='modal-footer mt-3'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                            <button type='submit' class='btn btn-primary'>Save</button>
                        </div>
                    </form>
                    <div class='errorBox'></div>

                </div>
            </div>
        </div>
    </div>";
}

// Vendors Modal
elseif ($item === "Vendors") {
    echo "
    <div class='modal fade' id='{$id}Modal' tabindex='-1'>
        <div class='modal-dialog modal-lg modal-dialog-scrollable'>
            <div class='modal-content'>
                <div class='modal-header text-white bg-info'>
                    <h5 class='modal-title'>Add Vendor</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div>
                <div class='modal-body'>
                    <form action='{$baseURL}modules/backend_vendor.php' method='POST'>
                        <input type='hidden' name='section' value='Vendors'>

                        <div class='row g-3'>
                            <div class='col-md-6'>
                                <label class='form-label'>Vendor Name <span class='text-danger'>*</span></label>
                                <input type='text' name='vnd_name' class='form-control' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>% Multiplier <span class='text-danger'>*</span></label>
                                <input type='number' class='form-control' name='multiplier' placeholder='Enter % multiplier' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Practice Multiplier <span class='text-danger'>*</span></label>
                                <input type='number' class='form-control' name='practice_multiplier' placeholder='Enter practice multiplier' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>KPI Target <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='kpi_target' placeholder='Enter KPI target' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>KPI Actual <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='kpi_actual' placeholder='Enter KPI actual' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Bonus Target <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='bonus_target' placeholder='Enter bonus target' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Bonus Actual <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='bonus_actual' placeholder='Enter bonus actual' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Plan <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='plan' placeholder='Enter plan' required>
                            </div>
                        </div>

                        <div class='modal-footer mt-3'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                            <button type='submit' class='btn btn-primary'>Save</button>
                        </div>
                    </form>
                    <div class='errorBox'></div>

                </div>
            </div>
        </div>
    </div>";
}

// Services Modal
elseif ($item === "Services") {
    echo "
    <div class='modal fade' id='{$id}Modal' tabindex='-1'>
        <div class='modal-dialog modal-lg modal-dialog-scrollable'>
            <div class='modal-content'>
                <div class='modal-header text-white bg-info'>
                    <h5 class='modal-title'>Add Service</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div>
                <div class='modal-body'>
                    <form action='{$baseURL}modules/' method='POST'>
                        <input type='hidden' name='section' value='Services'>

                        <div class='row g-3'>
                            <div class='col-md-6'>
                                <label class='form-label'>Service Name <span class='text-danger'>*</span></label>
                                <input type='text' name='service_name' class='form-control' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>% Multiplier <span class='text-danger'>*</span></label>
                                <input type='number' class='form-control' name='multiplier' placeholder='Enter % multiplier' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Practice Multiplier <span class='text-danger'>*</span></label>
                                <input type='number' class='form-control' name='practice_multiplier' placeholder='Enter practice multiplier' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>KPI Target <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='kpi_target' placeholder='Enter KPI target' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>KPI Actual <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='kpi_actual' placeholder='Enter KPI actual' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Bonus Target <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='bonus_target' placeholder='Enter bonus target' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Bonus Actual <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='bonus_actual' placeholder='Enter bonus actual' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Plan <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='plan' placeholder='Enter plan' required>
                            </div>
                        </div>

                        <div class='modal-footer mt-3'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                            <button type='submit' class='btn btn-primary'>Save</button>
                        </div>
                    </form>
                    <div class='errorBox'></div>

                </div>
            </div>
        </div>
    </div>";
}

// Practices Modal
elseif ($item === "Practices") {
    echo "
    <div class='modal fade' id='{$id}Modal' tabindex='-1'>
        <div class='modal-dialog modal-lg modal-dialog-scrollable'>
            <div class='modal-content'>
                <div class='modal-header text-white bg-info'>
                    <h5 class='modal-title'>Add Practice</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div>
                <div class='modal-body'>
                    <form action='{$baseURL}modules/' method='POST'>
                        <input type='hidden' name='section' value='Practices'>

                        <div class='row g-3'>
                            <div class='col-md-6'>
                                <label class='form-label'>Practice Name <span class='text-danger'>*</span></label>
                                <input type='text' name='practice_name' class='form-control' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>% Multiplier <span class='text-danger'>*</span></label>
                                <input type='number' class='form-control' name='multiplier' placeholder='Enter % multiplier' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Practice Multiplier <span class='text-danger'>*</span></label>
                                <input type='number' class='form-control' name='practice_multiplier' placeholder='Enter practice multiplier' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>KPI Target <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='kpi_target' placeholder='Enter KPI target' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>KPI Actual <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='kpi_actual' placeholder='Enter KPI actual' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Bonus Target <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='bonus_target' placeholder='Enter bonus target' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Bonus Actual <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='bonus_actual' placeholder='Enter bonus actual' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Plan <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='plan' placeholder='Enter plan' required>
                            </div>
                        </div>

                        <div class='modal-footer mt-3'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                            <button type='submit' class='btn btn-primary'>Save</button>
                        </div>
                    </form>
                    <div class='errorBox'></div>

                </div>
            </div>
        </div>
    </div>";
}


// Partners Modal
elseif ($item === "Partners") {
    echo "
    <div class='modal fade' id='{$id}Modal' tabindex='-1'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header text-white bg-info'>
                    <h5 class='modal-title'>Add Partner</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div>
                <div class='modal-body'>
                    <form action='{$baseURL}modules/' method='POST'>
                        <input type='hidden' name='section' value='Partners'>

                        <div class='mb-3'>
                            <label class='form-label'>Partner Name <span class='text-danger'>*</span></label>
                            <input type='text' name='partner_name' class='form-control' required>
                        </div>

                        <div class='row g-3'>
                            <div class='col-md-6'>
                                <label class='form-label'>% Multiplier <span class='text-danger'>*</span></label>
                                <input type='number' class='form-control' name='multiplier' placeholder='Enter % multiplier' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Practice Multiplier <span class='text-danger'>*</span></label>
                                <input type='number' class='form-control' name='practice_multiplier' placeholder='Enter practice multiplier' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>KPI Target <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='kpi_target' placeholder='Enter KPI target' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>KPI Actual <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='kpi_actual' placeholder='Enter KPI actual' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Bonus Target <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='bonus_target' placeholder='Enter bonus target' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Bonus Actual <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='bonus_actual' placeholder='Enter bonus actual' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Plan <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='plan' placeholder='Enter plan' required>
                            </div>
                        </div>

                        <div class='modal-footer mt-3'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                            <button type='submit' class='btn btn-primary'>Save</button>
                        </div>
                    </form>
                    <div class='errorBox'></div>

                </div>
            </div>
        </div>
    </div>";
}

// Customers Modal
elseif ($item === "Customers") {
    echo "
    <div class='modal fade' id='{$id}Modal' tabindex='-1'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header text-white bg-info'>
                    <h5 class='modal-title'>Add Customer</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div>
                <div class='modal-body'>
                    <form action='{$baseURL}modules/' method='POST'>
                        <input type='hidden' name='section' value='Customers'>

                        <div class='mb-3'>
                            <label class='form-label'>Customer Name <span class='text-danger'>*</span></label>
                            <input type='text' name='cust_name' class='form-control' required>
                        </div>

                        <div class='mb-3'>
                            <label class='form-label'>Customer Type</label>
                            <input type='text' name='cust_type' class='form-control'>
                        </div>

                        <div class='row g-3'>
                            <div class='col-md-6'>
                                <label class='form-label'>% Multiplier <span class='text-danger'>*</span></label>
                                <input type='number' class='form-control' name='multiplier' placeholder='Enter % multiplier' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Practice Multiplier <span class='text-danger'>*</span></label>
                                <input type='number' class='form-control' name='practice_multiplier' placeholder='Enter practice multiplier' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>KPI Target <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='kpi_target' placeholder='Enter KPI target' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>KPI Actual <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='kpi_actual' placeholder='Enter KPI actual' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Bonus Target <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='bonus_target' placeholder='Enter bonus target' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Bonus Actual <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='bonus_actual' placeholder='Enter bonus actual' required>
                            </div>
                            <div class='col-md-6'>
                                <label class='form-label'>Plan <span class='text-danger'>*</span></label>
                                <input type='text' class='form-control' name='plan' placeholder='Enter plan' required>
                            </div>
                        </div>

                        <div class='modal-footer mt-3'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                            <button type='submit' class='btn btn-primary'>Save</button>
                        </div>
                    </form>
                    <div class='errorBox'></div>

                </div>
            </div>
        </div>
    </div>";
}


    // Default simple modal
    else {
        echo "
        <div class='modal fade' id='{$id}Modal' tabindex='-1' id='employeeTableContainer'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header text-white bg-info '>
                        <h5 class='modal-title'>Add {$item}</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                    </div>
                    <div class='modal-body'>
                        <form>
                            <div class='mb-3'>
                                <label class='form-label'>Enter {$item} Details</label>
                                <input type='text' class='form-control' placeholder='{$item}'>
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>Select {$id} </label>
                                <input type='text' class='form-control' placeholder='{$item}'>
                            </div>
                            <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                        <button type='submit' id='savebutton' class='btn btn-primary'>Save</button>
                    </div>
                        </form>
                        <div class='errorBox'></div>

                    </div>
                </div>
            </div>
        </div>
        ";
    }
}
?>
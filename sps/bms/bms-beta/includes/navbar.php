<?php
include "header.php";
?>
<style>
    .dropdown-menu.w-50 {
  min-width: 110px !important;
  width: 110px !important;
}
</style>

<nav class="navbar navbar-expand-lg px-3 fixed-top ">
  <div class="container-fluid">

    <!-- Brand -->
    <a class="navbar-brand fw-bold text-white" href="#">SPS-BMS</a>

    <!-- Toggler for mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon text-white"></span>
    </button>

    <!-- Center menu -->
    <div class="collapse navbar-collapse justify-content-center" id="navbarMenu">
      <ul class="navbar-nav mb-2 mb-lg-0">

        <li class="nav-item">
          <a href="../index.php" class="nav-link text-white px-3">Home</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link  text-white px-3" href="#" id="hrDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">HR</a>
          <ul class="dropdown-menu w-60" aria-labelledby="hrDropdown">
            <li><a class="dropdown-item" href="#">Employees</a></li>
            <li><a class="dropdown-item" href="#">Payroll</a></li>
            <li><a class="dropdown-item" href="#">Leave</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link  text-white px-3" href="#" id="accountingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Accounting</a>
          <ul class="dropdown-menu w-60" aria-labelledby="accountingDropdown">
            <li><a class="dropdown-item" href="#">Invoices</a></li>
            <li><a class="dropdown-item" href="#">Expenses</a></li>
            <li><a class="dropdown-item" href="#">Reports</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link  text-white px-3" href="#" id="legalDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Legal</a>
          <ul class="dropdown-menu w-60" aria-labelledby="legalDropdown">
            <li><a class="dropdown-item" href="#">Contracts</a></li>
            <li><a class="dropdown-item" href="#">Compliance</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link  text-white px-3" href="#" id="itDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">IT</a>
          <ul class="dropdown-menu w-60" aria-labelledby="itDropdown">
            <li><a class="dropdown-item" href="#">Infrastruct</a></li>
            <li><a class="dropdown-item" href="#">Support</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link  text-white px-3" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Services</a>
          <ul class="dropdown-menu w-60" aria-labelledby="servicesDropdown">
            <li><a class="dropdown-item" href="#">CustService</a></li>
            <li><a class="dropdown-item" href="#">Facilities</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link  text-white px-3" href="#" id="educationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Education</a>
          <ul class="dropdown-menu w-60" aria-labelledby="educationDropdown">
            <li><a class="dropdown-item" href="#">Courses</a></li>
            <li><a class="dropdown-item" href="#">Training</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link  text-white px-3" href="#" id="salesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Sales</a>
          <ul class="dropdown-menu w-60" aria-labelledby="salesDropdown">
            <li><a class="dropdown-item" href="#">Reports</a></li>
            <li><a class="dropdown-item" href="#">Leads</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link  text-white px-3" href="#" id="marketingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Marketing</a>
          <ul class="dropdown-menu w-60" aria-labelledby="marketingDropdown">
            <li><a class="dropdown-item" href="#">Campaigns</a></li>
            <li><a class="dropdown-item" href="#">SocialMedia</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link  text-white px-3" href="#" id="spintasksDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Spintasks</a>
          <ul class="dropdown-menu w-60" aria-labelledby="spintasksDropdown">
            <li><a class="dropdown-item" href="#">Task List</a></li>
            <li><a class="dropdown-item" href="#">Progress</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link  text-white px-3" href="#" id="jobcodeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Jobcode</a>
          <ul class="dropdown-menu w-60" aria-labelledby="jobcodeDropdown">
            <li><a class="dropdown-item" href="#">Jobs</a></li>
            <li><a class="dropdown-item" href="#">Applicants</a></li>
          </ul>
        </li>

      </ul>
    </div>

    <!-- User -->
    <div class="d-flex align-items-center ms-lg-3">
      <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" 
           alt="User" class="rounded-circle bg-white" width="30" height="30">
      <span class="text-white ms-2">Amara</span>
    </div>
  </div>
</nav>
<br>
<br><br>
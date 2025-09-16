$(document).ready(function () {
  // Function to fetch filtered data
  function fetchData() {
    let department = $("#department").val();
    let group = $("#group").val();
    let practice = $("#practice").val();
    let gender = $("#gender").val();
    let location = $("#location").val();
    let workStatus = $("#work_status").val();

    $.ajax({
      url: "modules/backend/main_table_data/fetch_employees.php",
      method: "POST",
      data: {
        department: department,
        group: group,
        practice: practice,
        gender: gender,
        location: location,
        work_status: workStatus,
      },
      success: function (response) {
        $("#employee-table-body").html(response);
      },
    });
  }

  // Trigger fetch on change of any filter
  $("#department, #group, #practice, #gender, #location, #work_status").change(
    fetchData
  );

  // Trigger fetch on search input
  $("#search").on("keyup", fetchData);
});

document.addEventListener("DOMContentLoaded", function () {
  var tooltipTriggerList = [].slice.call(
    document.querySelectorAll(".with-tooltip")
  );
  tooltipTriggerList.map(function (el) {
    return new bootstrap.Tooltip(el);
  });
});

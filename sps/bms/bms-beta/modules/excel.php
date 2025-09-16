<?php
require __DIR__ . '/../../../vendor/autoload.php'; // Ensure correct path
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include '../config/db.php'; // DB connection

// ✅ Define SQL query once
$sql = "SELECT te.emp_name, te.emp_email, te.emp_mobile, te.company,
               er.emp_role_name, er.category, er.skills, te.emp_country
        FROM timelive_emp AS te
        LEFT JOIN (
            SELECT emp_role_owner, emp_role_id, emp_role_name, emp_role_status, category, skills
            FROM tbl_emp_roles
            WHERE emp_role_id IN (
                SELECT MIN(emp_role_id) FROM tbl_emp_roles GROUP BY emp_role_owner
            )
        ) AS er ON er.emp_role_owner = te.emp_id
        ORDER BY te.emp_name ASC";

$result = $conn->query($sql);

// ✅ Excel Export
if (isset($_GET['export']) && $_GET['export'] === 'excel') {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $headers = ['Name', 'Email', 'Mobile', 'Company', 'Role', 'Group', 'Practice', 'Location'];
    $sheet->fromArray($headers, NULL, 'A1');

    $data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = [
                $row['emp_name'] ?? 'N/A',
                $row['emp_email'] ?? 'N/A',
                $row['emp_mobile'] ?? 'N/A',
                $row['company'] ?? 'N/A',
                $row['emp_role_name'] ?? 'N/A',
                $row['category'] ?? 'N/A',
                $row['skills'] ?? 'N/A',
                $row['emp_country'] ?? 'N/A'
            ];
        }
    }

    $sheet->fromArray($data, NULL, 'A2');

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="employees.xlsx"');
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}

// ✅ CSV Export
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="employees.csv"');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['Name', 'Email', 'Mobile', 'Company', 'Role', 'Group', 'Practice', 'Location']);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            fputcsv($output, [
                $row['emp_name'] ?? 'N/A',
                $row['emp_email'] ?? 'N/A',
                $row['emp_mobile'] ?? 'N/A',
                $row['company'] ?? 'N/A',
                $row['emp_role_name'] ?? 'N/A',
                $row['category'] ?? 'N/A',
                $row['skills'] ?? 'N/A',
                $row['emp_country'] ?? 'N/A'
            ]);
        }
    }
    fclose($output);
    exit;
}
?>

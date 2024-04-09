<?php
// Load the database configuration file 
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "dbproject";
$conn = mysqli_connect($servername, $username, $password, $dbName);
mysqli_query($conn, "SET NAMES utf8");

$start = $_POST["start_date"];
$end = $_POST["end_date"];
// Filter the excel data 
function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

// Excel file name for download 
$fileName = "ข้อมูลการยืมอุปกรณ์" . $start . "ถึง" . $end .  ".csv";

// Column names 
$fields = array('ชื่อ', 'นามสกุล', 'สถานะ', 'ชื่ออุปกรณ์', 'ชื่อประเภทอุปกรณ์', 'หมายเหตุ', 'วันที่ยืม', 'วันที่คืน', 'เวลาที่ยืม', 'เวลาที่คืน');

// Display column names as first row 
$excelData = implode(",", array_values($fields)) . "\n";

// Fetch records from database 
$query = $conn->query("SELECT * FROM borrow WHERE end_date >= '$start' and end_date <= '$end' ORDER BY end_date ASC");
if ($query->num_rows > 0) {
    // Output each row of the data 
    while ($row = $query->fetch_assoc()) {
        $member_id_row = $row['member_id'];
        $member_p = "SELECT * FROM member WHERE member_id = '$member_id_row'";
        $member_p_run = mysqli_query($conn, $member_p);
        foreach ($member_p_run as $member_row) {
            $membername = $member_row['firstname'];
            $membersname = $member_row['surname'];
            $memberagen = $member_row['agency'];
        }
        $equipment_id_row = $row['equipment_id'];
        $equipment_p = "SELECT * FROM equipment WHERE equipment_id = '$equipment_id_row'";
        $equipment_p_run = mysqli_query($conn, $equipment_p);
        foreach ($equipment_p_run as $equipment_row) {
            $equipmentname = $equipment_row['equipment_name'];
        }
        $equipment_type_id_row = $row['equipment_type_id'];
        $equipment_type_p = "SELECT * FROM equipment_type WHERE equipment_type_id = '$equipment_type_id_row'";
        $equipment_type_p_run = mysqli_query($conn, $equipment_type_p);
        foreach ($equipment_type_p_run as $equipment_type_row) {
            $equipment_type_name = $equipment_type_row['equipment_type_name'];
        }


        $lineData = array($membername, $membersname, $memberagen, $equipmentname, $equipment_type_name, $row['note'], $row['start_date'], $row['end_date'], $row['start_time'], $row['end_time']);
        array_walk($lineData, 'filterData');
        $excelData .= implode(",", array_values($lineData)) . "\n";
    }
} else {
    $excelData .= 'No records found...' . "\n";
}

// Headers for download 
// header('Content-Encoding: UTF-8');
header('Content-type: text/csv; charset=UTF-8');
header("Content-Disposition: attachment; filename=\"$fileName\"");
echo "\xEF\xBB\xBF";
// Render excel data 
echo $excelData;
exit;

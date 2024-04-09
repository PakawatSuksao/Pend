<?php
// Load the database configuration file 
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "dbproject";
$conn = mysqli_connect($servername, $username, $password, $dbName);
mysqli_query($conn, "SET NAMES utf8");


// Filter the excel data 
function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

// Excel file name for download 
$fileName = "ข้อมูลการจองสนามทั้งหมด" . ".csv";

// Column names 
$fields = array('ชื่อ', 'นามสกุล', 'สถานะ',  'ชื่อสนาม', 'ชื่อประเภทสนาม', 'หมายเหตุ', 'วันที่เริ่มจอง', 'วันที่สิ้นสุดการจอง', 'ช่วงเช้า', 'ช่วงบ่าย', 'ช่วงค่ำ', 'เบอร์โทร');

// Display column names as first row 
$excelData = implode(",", array_values($fields)) . "\n";

// Fetch records from database 
$query = $conn->query("SELECT * FROM booking WHERE status = 1 ORDER BY end_date ASC");
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
        $stadium_id_row = $row['stadium_id'];
        $stadium_p = "SELECT * FROM stadium WHERE stadium_id = '$stadium_id_row'";
        $stadium_p_run = mysqli_query($conn, $stadium_p);
        foreach ($stadium_p_run as $stadium_row) {
            $stadiumname = $stadium_row['stadium_name'];
        }
        $stadium_type_id_row = $row['stadium_type_id'];
        $stadium_type_p = "SELECT * FROM stadium_type WHERE stadium_type_id = '$stadium_type_id_row'";
        $stadium_type_p_run = mysqli_query($conn, $stadium_type_p);
        foreach ($stadium_type_p_run as $stadium_type_row) {
            $stadium_type_name = $stadium_type_row['stadium_type_name'];
        }
        if ($row['start_time'] == 1) {
            $start = "จอง";
        } else {
            if ($row['start_time'] == 0) {
                $start = "ว่าง";
            }
        }
        if ($row['end_time'] == 1) {
            $end = "จอง";
        } else {
            if ($row['end_time'] == 0) {
                $end = "ว่าง";
            }
        }
        if ($row['over_time'] == 1) {
            $over = "จอง";
        } else {
            if ($row['over_time'] == 0) {
                $over = "ว่าง";
            }
        }




        $lineData = array($membername, $membersname, $memberagen, $stadiumname, $stadium_type_name, $row['note'], $row['start_date'], $row['end_date'], $start, $end, $over, $row['phone_number']);
        array_walk($lineData, 'filterData');
        $excelData .= implode(",", array_values($lineData)) . "\n";
    }
} else {
    $excelData .= 'No records found...' . "\n";
}
// Headers for download 

header('Content-type: text/csv; charset=UTF-8');
header("Content-Disposition: attachment; filename=\"$fileName\"");
echo "\xEF\xBB\xBF";




// Render excel data 
echo $excelData;

exit;

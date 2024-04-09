<?php
require_once "../connect/conn.php";
$id = $_GET['id'];
$json = array();
$sqlQuery = "SELECT *
    FROM booking b
    INNER JOIN member m ON b.member_id=m.member_id
    INNER JOIN stadium s ON b.stadium_id=s.stadium_id 
    where b.status != 2 and b.status != 3 
    and b.stadium_type_id = '$id'
    ORDER BY b.booking_id ";

$result = mysqli_query($conn, $sqlQuery);
$eventArray = array();

while ($row = mysqli_fetch_assoc($result)) {
    // if($row['start_time'] == 1){
    //     $row['start_time'] = "ช่วงเช้า";
    // }else{
    //     $row['start_time'] = ' ';
    // }
    // if($row['end_time'] == 1){
    //     $row['end_time'] = "ช่วงเช้า";
    // }else{
    //     $row['end_time'] = ' ';
    // }
    // if($row['over_time'] == 1){
    //     $row['over_time'] = "ช่วงค่ำ";
    // }else {
    //     $row['over_time'] = ' ';
    // }

    array_push($eventArray, $row);

}
mysqli_free_result($result);

mysqli_close($conn);

echo json_encode($eventArray);


// $json_data= array();

// $q ="SELECT * FROM booking b
// INNER JOIN member m ON b.member_id=m.member_id
// INNER JOIN stadium s ON b.stadium_id=s.stadium_id 
// where b.status != 2 and b.status != 3
// ORDER BY b.booking_id";


// $result = $mysqli->query($q);

// while ($rs = $result->fetch_object()) {
//     if ($rs->action == '') {
//         $color = '#FFFFFF';
//         //FF0000
//     }
//     if ($rs->action == 'accept' && $rs->status == '') {
//         $color = '#FF9900';
//         //FF0000
//     }
//     if ($rs->action == 'reject' && $rs->status == '') {
//         $color = '#FFFFFF';
//     }
//     if ($rs->action == '' && $rs->status == '') {
//         $color = '#e3bc08';
//     }

//     if ($rs->status == 'accept' && $rs->action == 'accept') {
//         $color = '#02d667';
//         //FF0000
//     }
//     if ($rs->status == 'reject' && $rs->action == 'accept') {
//         $color = '#FFFFFF';
//     }
//     if ($rs->status == '' && $rs->action == 'accept') {
//         $color = '#1e90ff';
//     }
//     $json_data[] = [
//         'id' => $rs->id,
//         'title' =>
//             $rs->booking_type . ',' . $rs->purpose . ',' . $rs->booking_id,
//         'start' => $rs->booking_start_date,
//         'end' => $rs->booking_end_date,
       
//         'color' => $color,
//     ];
    
// }
// $json = json_encode($json_data);
// echo $json;

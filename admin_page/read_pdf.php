<?php
include('../connect/conn.php');
// Store the file name into variable
$booking_id = $_GET['id'];
$query = "select * from booking where booking_id = '$booking_id' ";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $name = $row['document'];
    echo $name;
}
$filename = $name;
$file = '../documents/' . $name;


// Header content type
header('Content-type: application/pdf');

header('Content-Disposition: inline; filename="' . $filename . '"');

header('Content-Transfer-Encoding: binary');

header('Accept-Ranges: bytes');

// Read the file
@readfile($file);

<?php
include('../connect/conn.php');

$borrow_id = $_GET['id'];
$query = "select * from borrow where borrow_id = '$borrow_id' ";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $name = $row['image'];
}
$filename = $name;

$imagePath = '../upload/' . $filename;

if (file_exists($imagePath)) {
    $imageData = file_get_contents($imagePath);
    if ($imageData !== false) {
        // Convert the image data to base64
        $base64Image = base64_encode($imageData);

        // Output the base64 image data
        echo '<img src="data:image/jpeg;base64,' . $base64Image . '"/>';
    } else {
        echo 'Failed to read the image file.';
    }
} else {
    echo 'Image file does not exist.';
}

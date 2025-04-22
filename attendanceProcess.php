<?php
include_once "config.php";

$matricNum = $_POST["matricNum"];
$eventID = $_POST["eventID"];
$date = $_POST["date"];
$status = $_POST["status"];

$result = eventAttendance($conn, $matricNum , $eventID , $date, $status);


function eventAttendance($conn, $matricNum, $eventID, $date, $status) {
    // Check if all parameters are provided
    if (empty($matricNum) || empty($eventID) || empty($date) || !isset($status)) {
        return "Error: Missing parameters.";
    }

    // Sanitize inputs
    $matricNum = mysqli_real_escape_string($conn, $matricNum);
    $eventID = (int)$eventID;
    $date = mysqli_real_escape_string($conn, $date);
    $status = (int)$status;

    // Insert query
    $sql = "INSERT INTO attendance (eventID, matricNum, eventDate, status)
            VALUES ('$eventID', '$matricNum', '$date', '$status')";

    // Execute query and return status
    if (mysqli_query($conn, $sql)) {
        return "Attendance record $matricNum successfully inserted for event $eventID.";
    } else {
        return "Error: " . mysqli_error($conn);
    }
}

?>

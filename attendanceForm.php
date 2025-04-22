<?php
include_once("config.php");

// Fetch events from the database
$sql = "SELECT eventID, eventName FROM event";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Attendance Form</title>
</head>
<body>
<div>
        <h1>Event Management System</h1>
</div>
    <h2>Event Attendance Form</h2>
    <form action="attendanceProcess.php" method="POST">
        <!-- Event Selection -->
        <label for="event">Select Event:</label>
        <select name="eventID" id="event" required>
            <option value="">-- Select an Event --</option>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['eventID'] . "'>" . htmlspecialchars($row['eventName']) . "</option>";
                }
            } else {
                echo "<option value=''>No events available</option>";
            }
            ?>
        </select>
        <br><br>

        <!-- Matric Number -->
        <label for="matricNum">Matric Number:</label>
        <input type="text" id="matricNum" name="matricNum" required>
        <br><br>

        <!-- Attendance Date -->
        <label for="date">Attendance Date:</label>
        <input type="date" id="date" name="date" required>
        <br><br>

        <!-- Attendance Status -->
        <label for="status">Attendance Status:</label>
        <select name="status" id="status" required>
            <option value="1">Present</option>
            <option value="0">Absent</option>
        </select>
        <br><br>

        <!-- Submit Button -->
        <button type="submit">Submit Attendance</button>
    </form>
</body>
</html>

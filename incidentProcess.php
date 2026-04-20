<?php
// Database Connection Configuration
$host = "localhost";
$user = "root";
$pass = "";
$db   = "enfrasystem_db";

// DEFECT 1: No error handling on connection
$conn = new mysqli($host, $user, $pass, $db);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Capturing inputs
    $summary = $_POST['summary'];
    $description = $_POST['description'];
    $urgency = $_POST['urgency']; // In the corrected ERD, this should be an ID
    $userId = 1; // Hardcoded for demo purposes

    // DEFECT 2: SQL Injection Vulnerability
    // We are inserting variables directly into the string instead of using Prepared Statements.
    $sql = "INSERT INTO Incidents (Summary, DetailedDescription, UrgencyID, UserID)
            VALUES ('$summary', '$description', '$urgency', '$userId')";

    if ($conn->query($sql) === true) {
        echo "<div style='color: green; padding: 20px; border: 1px solid green;'>
                <h2>Success!</h2>
                <p>Incident has been logged successfully.</p>
                <a href='index.html'>Back to Form</a>
              </div>";
    } else {
        // DEFECT 3: Information Leakage
        // Printing the raw error to the user is a security risk.
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

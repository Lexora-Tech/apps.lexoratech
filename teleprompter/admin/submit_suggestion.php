<?php
// submit_suggestion.php

// 1. Setup Headers (Allow JSON)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

// 2. Include Database
// Since this file is in the same folder as db.php, we just include it directly
include_once './includes/db.php';

// 3. Get the raw POST data (JSON)
$input = file_get_contents("php://input");
$data = json_decode($input);

// 4. Validate the input
if (
    !isset($data->type) || 
    !isset($data->subject) || 
    !isset($data->description)
) {
    http_response_code(400); // Bad Request
    echo json_encode(["message" => "Incomplete data. Please fill all fields."]);
    exit();
}

// 5. Sanitize variables
$type = $data->type;
$subject = $data->subject;
$description = $data->description;
$priority = isset($data->priority) ? (int)$data->priority : 1;

// 6. SQL Query (Using Prepared Statements for Security)
$sql = "INSERT INTO feedback (type, subject, description, priority) VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt) {
    // 'sssi' means: String, String, String, Integer
    $stmt->bind_param("sssi", $type, $subject, $description, $priority);

    if ($stmt->execute()) {
        // Success!
        http_response_code(201); // Created
        echo json_encode(["message" => "Feedback submitted successfully!", "id" => $conn->insert_id]);
    } else {
        // SQL Error
        http_response_code(503); // Server Error
        echo json_encode(["message" => "Error executing query: " . $stmt->error]);
    }

    $stmt->close();
} else {
    // Preparation Error
    http_response_code(500); // Internal Server Error
    echo json_encode(["message" => "Error preparing query: " . $conn->error]);
}

// 7. Close Connection
$conn->close();
?>

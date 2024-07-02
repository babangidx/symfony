<?php

// URL of the API endpoint
$apiUrl = 'http://127.0.0.1:8000/api/tasks';

// Initialize cURL session
$ch = curl_init($apiUrl);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);

// Execute cURL session and get the response
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    // Decode the JSON response
    $tasks = json_decode($response, true);

    // Check if the response is valid
    if (json_last_error() === JSON_ERROR_NONE) {
        // Print the tasks
        foreach ($tasks as $task) {
            echo "ID: " . $task['id'] . "<br>";
            echo "Title: " . $task['title'] . "<br>";
            echo "Description: " . $task['description'] . "<br>";
            echo "Status: " . $task['status'] . "<br>";
            echo "----------------------<br>";
        }
    } else {
        echo "Failed to decode JSON response.<br>";
    }
}

// Close cURL session
curl_close($ch);

?>

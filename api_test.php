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
            echo "ID: " . $task['id'] . "\n";
            echo "Title: " . $task['title'] . "\n";
            echo "Description: " . $task['description'] . "\n";
            echo "Status: " . $task['status'] . "\n";
            echo "----------------------\n";
        }
    } else {
        echo "Failed to decode JSON response.\n";
    }
}

// Close cURL session
curl_close($ch);

?>

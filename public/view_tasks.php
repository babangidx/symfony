<?php
// URL of the API endpoint
$apiUrl = 'http://127.0.0.1:8000/api/tasks';

// Your generated API key
$apiKey = '7acd6f7eb1fa8b9f1ecdde2efb87a2f8c39f4cc5d67155272764c216c7a689ae';

// Initialize cURL session
$ch = curl_init($apiUrl);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'X-API-KEY: ' . $apiKey
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
            echo "Description: <br><img src='" . $task['description'] . "' alt='Task Image' style='width: 100px; height: 100px;'><br>";
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

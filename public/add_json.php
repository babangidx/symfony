<?php
// URL of the API endpoint
$apiUrl = 'http://127.0.0.1:8000/api/tasks';

// Your generated API key
$apiKey = '7acd6f7eb1fa8b9f1ecdde2efb87a2f8c39f4cc5d67155272764c216c7a689ae';

// Path to the JSON file
$jsonFilePath = __DIR__ . '/tasks.json';

// Read the JSON file
$jsonData = file_get_contents($jsonFilePath);
$tasks = json_decode($jsonData, true);

// Initialize cURL session
$ch = curl_init($apiUrl);

// Loop through each task and send it to the API
foreach ($tasks as $task) {
    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($task));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'X-API-KEY: ' . $apiKey
    ]);

    // Execute cURL session and get the response
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch) . "\n";
    } else {
        echo 'Response:' . $response . "\n";
    }
}

// Close cURL session
curl_close($ch);
?>

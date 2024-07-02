<?php

// Set the API endpoint URL
$apiUrl = 'http://localhost:8000/api/tasks/';

// Function to send HTTP GET request using curl
function fetchTasks($url)
{
    $ch = curl_init();

    // Set curl options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Set headers for JSON content
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);

    // Execute curl request
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

// Fetch tasks from API
$response = fetchTasks($apiUrl);

// Display tasks
echo "Tasks:\n";
echo $response . "\n";
?>

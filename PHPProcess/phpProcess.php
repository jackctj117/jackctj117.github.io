<?php
// Start output buffering to capture all output
ob_start();

// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    echo "<h1>Form Submission Results</h1>";
    echo "<table border='1'><tr><th>Field</th><th>Value</th></tr>";

    foreach ($_REQUEST as $key => $value) {
        if (is_array($value)) {
            echo "<tr><td>" . sanitize_input($key) . "</td><td>";
            foreach ($value as $item) {
                echo sanitize_input($item) . "<br>";
            }
            echo "</td></tr>";
        } else {
            echo "<tr><td>" . sanitize_input($key) . "</td><td>" . sanitize_input($value) . "</td></tr>";
        }
    }

    echo "</table>";
} else {
    echo "<p>No form data submitted.</p>";
}

// Get the buffered content
$content = ob_get_clean();

// Output the final HTML
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission Results</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <?php echo $content; ?>
</body>
</html>

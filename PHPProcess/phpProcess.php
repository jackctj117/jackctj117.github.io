<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<h2>Form Data Submitted</h2>";
    echo "<table border='1'>";

    // Checkboxes (array)
    if (!empty($_POST['checkbox'])) {
        echo "<tr><th>Checkboxes</th><td>";
        foreach ($_POST['checkbox'] as $checked) {
            echo htmlspecialchars($checked) . "<br>";
        }
        echo "</td></tr>";
    }

    // Radio button
    if (!empty($_POST['radio'])) {
        echo "<tr><th>Selected Radio</th><td>" . htmlspecialchars($_POST['radio']) . "</td></tr>";
    }

    // Single select
    if (!empty($_POST['selectOne'])) {
        echo "<tr><th>Selected One Option</th><td>" . htmlspecialchars($_POST['selectOne']) . "</td></tr>";
    }

    // Multi select (array)
    if (!empty($_POST['selectMultiple'])) {
        echo "<tr><th>Selected Multiple Options</th><td>";
        foreach ($_POST['selectMultiple'] as $selected) {
            echo htmlspecialchars($selected) . "<br>";
        }
        echo "</td></tr>";
    }

    // Additional input
    if (!empty($_POST['textInput'])) {
        echo "<tr><th>Text Input</th><td>" . htmlspecialchars($_POST['textInput']) . "</td></tr>";
    }

    echo "</table>";
} else {
    echo "No form data submitted.";
}
?>


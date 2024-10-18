<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Listing</title>
</head>
<body>
    <h1>Just Added</h1>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    var_dump($_POST);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstname = htmlspecialchars($_POST['first']);
        $lastname = htmlspecialchars($_POST['last']);
        $country = htmlspecialchars($_POST['country']);


        echo "<p>Adding <strong>$firstname</strong>.</p>";
        echo "<p>Adding <strong>$lastname</strong>.</p>";
        echo "<p>Adding <strong>$country</strong>.</p>";


        $servername = "localhost";   // same for local dev and school server
        $username = "user14";        // get this from the email
        $password = "14rone";        // get this from the email 
        $dbname = "db14";            // get this from the email

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("INSERT INTO randuser (first, last, country) VALUES (:first, :last, :country)");
            $stmt->bindParam(':first', $firstname);
            $stmt->bindParam(':last', $lastname);
            $stmt->bindParam(':country', $country);

            echo "<div>";
            if ($stmt->execute()) {
                echo "<p>New record created successfully</p>";
            } else {
                echo "<p>Error: Unable to create a new record.</p>";
            }
            echo "</div>";

            $sql = "SELECT first, last, country FROM randuser";// MySQL: read every record from the table. Hint: https://www.w3schools.com/mysql/mysql_select.asp
            $result = $conn->query($sql);

            echo "<div>";
                echo "<table>";
                echo "<thead><tr><th>First Name</th><th>Last Name</th><th>Country</th></tr></thead><tbody>";
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    // TODO: change the hardcoded string to actual API data, ie: firstname, etc.. 
                    echo "<tr><td>" . htmlspecialchars($row['first']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['last']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['country']) . "</td></tr>";
                }
                echo "</tbody></table>";
            echo "</div>";

        } catch (PDOException $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }

        // Close the connection
        $conn = null;

    } else {
        echo "<p>No data was submitted.</p>";
    }
    ?>
</body>
</html>

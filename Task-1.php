<?php
// Your database connection code goes here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve data
$sql = "SELECT 
            customers.customer_id, 
            customers.name, 
            customers.email, 
            COUNT(orders.order_id) AS total_order
        FROM 
            customers 
        JOIN 
            orders ON customers.customer_id = orders.customer_id 
        GROUP BY 
            customers.customer_id, customers.name, customers.email 
        ORDER BY 
            total_orders DESC";
        $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Data</title>
</head>
<body>

    <h2>Customer Information</h2>

    <?php
    // Check if there are results
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<p>Customer ID: " . $row["customer_id"]. "<br> Name: " . $row["name"]. "<br>Email: " . $row["email"]. "<br>Total Orders: " . $row["total_order"]. "</p>";
        }
    } else {
        echo "0 results";
    }

    // Close the connection
    $conn->close();
    ?>

</body>
</html>
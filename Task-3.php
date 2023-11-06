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
            order_items.order_id,
            products.name, 
            order_items.quantity, 
            order_items.quantity * products.price AS total_amount
        FROM 
            order_items
        JOIN 
            products ON order_items.product_id = products.product_id 
        ORDER BY 
            order_items.order_id ASC";
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
            echo "<p>Order ID: " . $row["order_id"]. "<br> Product Name: " . $row["name"]. "<br>Product Quantity: " . $row["quantity"]. "<br>Total Amount: " . $row["total_amount"]. "</p>";
        }
    } else {
        echo "0 results";
    }

    // Close the connection
    $conn->close();
    ?>

</body>
</html>
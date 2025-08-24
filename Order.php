<?php
// Correct connection
$conn = mysqli_connect("localhost", "root", "", "foodgard");

// Check connection
if (!$conn) {
    die("<div class='message error'>Connection failed: " . mysqli_connect_error() . "</div>");
}

// Get form inputs safely
$name = $_POST['name'] ?? '';
$address = $_POST['address'] ?? '';
$mobile = $_POST['mobile'] ?? '';
$email = $_POST['email'] ?? '';
$order1 = $_POST['order1'] ?? '';
$order2 = $_POST['order2'] ?? '';
$order3 = $_POST['order3'] ?? '';

// Function to show styled message
function showMessage($text, $type = "success") {
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Order Status</title>
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: url('https://www.toptal.com/designers/subtlepatterns/uploads/wood_pattern.png');
                background-size: cover;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .message {
                padding: 25px 45px;
                border-radius: 15px;
                font-size: 20px;
                box-shadow: 0px 6px 14px rgba(0,0,0,0.4);
                text-align: center;
                animation: fadeIn 0.5s ease-in-out;
                background: rgba(255, 248, 240, 0.9);
                border: 3px solid #8B5A2B;
            }
            .success {
                color: #3e2723;
            }
            .error {
                color: #b71c1c;
            }
            a {
                display: inline-block;
                margin-top: 18px;
                padding: 12px 24px;
                text-decoration: none;
                background: #8B5A2B;
                color: #fff;
                font-weight: bold;
                border-radius: 10px;
                transition: 0.3s;
                box-shadow: 0px 3px 6px rgba(0,0,0,0.3);
            }
            a:hover {
                background: #5d3a1a;
            }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(-10px); }
                to { opacity: 1; transform: translateY(0); }
            }
        </style>
    </head>
    <body>
        <div class='message $type'>
            $text <br>
            <a href='home.html'>🌱 Go Back</a>
        </div>
    </body>
    </html>";
}

// Insert
if (isset($_POST['save'])) {
    $sql = "INSERT INTO `order` (name, address, mobile, email, order1, order2, order3) 
            VALUES ('$name', '$address', '$mobile', '$email', '$order1', '$order2', '$order3')";

    if (mysqli_query($conn, $sql)) {
        showMessage("✅ Order saved successfully!");
    } else {
        showMessage("❌ Error: " . mysqli_error($conn), "error");
    }
}

// Update
if (isset($_POST['update'])) {
    $sql = "UPDATE `order` 
            SET address='$address', mobile='$mobile', order1='$order1', order2='$order2', order3='$order3' 
            WHERE email='$email'";

    if (mysqli_query($conn, $sql)) {
        showMessage("✅ Order updated successfully!");
    } else {
        showMessage("❌ Update failed: " . mysqli_error($conn), "error");
    }
}

// Delete
if (isset($_POST['delete'])) {
    $sql = "DELETE FROM `order` WHERE email='$email'";

    if (mysqli_query($conn, $sql)) {
        showMessage("✅ Order deleted successfully!");
    } else {
        showMessage("❌ Delete failed: " . mysqli_error($conn), "error");
    }
}

mysqli_close($conn);
?>

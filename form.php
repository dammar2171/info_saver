<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.8);
            width: 320px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="submit"], input[type="reset"] {
            width: 48%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="reset"] {
            background-color: #f44336;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
        }

        input[type="submit"]:hover, input[type="reset"]:hover {
            opacity: 0.9;
        }

        .btn-user-list {
    margin-top: 20px;
    text-align: center;
}

.btn-user-list a {
    display: inline-block;
    padding: 10px 20px;
    color: white;
    background-color: #6200ea;
    border-radius: 4px;
    border: none;
    transition: background-color 0.3s ease;
}

.btn-user-list a:hover {
    background-color: #3700b3;
}

.btn-user-list a:active {
    transform: scale(0.95);
}

    </style>
</head>
<body>
    <div class="container">
        <h2>User Information</h2>
        <form action="form.php" method="POST">
            <div class="form-group">
                <label for="fullname">Full Name:</label>
                <input type="text" name="fullname" id="fullname" required>
            </div>
            
            <div class="form-group">
                <label for="number">Phone Number:</label>
                <input type="text" name="number" id="number" required>
            </div>
            
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" required>
            </div>

            <div class="button-group">
                <input type="submit" name="submit" value="Save">
                <input type="reset" value="Reset">
            </div>
            <div class="btn-user-list">
                <a href="user_list.php">User List</a>
            </div>

        </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'testdb');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $fullname = $_POST['fullname'];
    $number = $_POST['number'];
    $address = $_POST['address'];

    // Insert user data into the database
    $sql = "INSERT INTO user (fullname, `number`, address) VALUES ('$fullname', '$number', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New user created successfully!');
        window.location.href='user_list.php';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

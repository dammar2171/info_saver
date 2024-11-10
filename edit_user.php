<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 320px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
        }

        input[type="text"], input[type="submit"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit User Information</h2>

        <?php
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'testdb');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get user ID from URL
        if (isset($_GET['id'])) {
            $user_id = $_GET['id'];

            // Fetch user data based on the ID
            $sql = "SELECT * FROM user WHERE id = $user_id";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $fullname = $row['fullname'];
                $number = $row['number'];
                $address = $row['address'];
            } else {
                echo "User not found.";
                exit();
            }
        }

        // Update user data
        if (isset($_POST['update'])) {
            $fullname = $_POST['fullname'];
            $number = $_POST['number'];
            $address = $_POST['address'];

            // Update query
            $sql = "UPDATE user SET fullname='$fullname', number='$number', address='$address' WHERE id=$user_id";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('User updated successfully!'); window.location.href='user_list.php';</script>";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }

        $conn->close();
        ?>

        <!-- Edit Form -->
        <form action="" method="POST">
            <label for="fullname">Full Name:</label>
            <input type="text" name="fullname" value="<?php echo $fullname; ?>" required>

            <label for="number">Phone Number:</label>
            <input type="text" name="number" value="<?php echo $number; ?>" required>

            <label for="address">Address:</label>
            <input type="text" name="address" value="<?php echo $address; ?>" required>

            <input type="submit" name="update" value="Update">
        </form>
    </div>
</body>
</html>

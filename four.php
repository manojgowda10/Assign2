<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "football_club");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize form data variables
$name = $email = $phone = $address = $dob = $gender = $position = $experience = "";
$form_submitted = false; // Flag to check if the form is submitted

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $position = $_POST['position'];
    $experience = $_POST['experience'];

    // Insert the player into the database
    $sql = "INSERT INTO players (name, email, phone, address, dob, gender, position, experience) 
            VALUES ('$name', '$email', '$phone', '$address', '$dob', '$gender', '$position', '$experience')";

    if ($conn->query($sql) === TRUE) {
        $message = "Player registered successfully!";
        $form_submitted = true; // Set flag to true when the form is submitted successfully
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Football Club Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        .registration-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
        }

        input, textarea, select, button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 10px;
        }

        .message {
            text-align: center;
            color: green;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Football Club Registration</h1>

        <!-- Show success/error message -->
        <?php if (isset($message)): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>

        <!-- Show the entered data after successful registration -->
        <?php if ($form_submitted): ?>
            <h2>Submitted Data</h2>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></p>
            <p><strong>Address:</strong> <?php echo nl2br(htmlspecialchars($address)); ?></p>
            <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($dob); ?></p>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($gender); ?></p>
            <p><strong>Position:</strong> <?php echo htmlspecialchars($position); ?></p>
            <p><strong>Experience Level:</strong> <?php echo htmlspecialchars($experience); ?></p>
        <?php else: ?>
            <!-- Registration Form -->
            <form action="" method="POST" class="registration-form">
                <label for="name">Full Name:</label>
                <input type="text" name="name" id="name" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="phone">Phone Number:</label>
                <input type="text" name="phone" id="phone" required>

                <label for="address">Home Address:</label>
                <textarea name="address" id="address" required></textarea>

                <label for="dob">Date of Birth:</label>
                <input type="date" name="dob" id="dob" required>

                <label for="gender">Gender:</label>
                <select name="gender" id="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>

                <label for="position">Preferred Position:</label>
                <select name="position" id="position" required>
                    <option value="Goalkeeper">Goalkeeper</option>
                    <option value="Defender">Defender</option>
                    <option value="Midfielder">Midfielder</option>
                    <option value="Forward">Forward</option>
                </select>

                <label for="experience">Experience Level:</label>
                <select name="experience" id="experience" required>
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                </select>

                <button type="submit">Register Player</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>

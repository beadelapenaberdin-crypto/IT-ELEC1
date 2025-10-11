<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px;
        }
        button:hover {
            background-color: #45a049;
        }
        .clear-btn {
            background-color: #f44336;
        }
        .clear-btn:hover {
            background-color: #da190b;
        }
        .success {
            color: #4CAF50;
            text-align: center;
            margin-top: 10px;
        }
        .error {
            color: #f44336;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Registration</h1>
        <form method="POST" action="">
            <label for="studentName">Student Name:</label>
            <input type="text" id="studentName" name="studentName" required>

            <label for="studentId">Student ID:</label>
            <input type="text" id="studentId" name="studentId" required>

            <label for="course">Course:</label>
            <input type="text" id="course" name="course" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <button type="submit" name="register">Register Student</button>
        </form>

        <form method="POST" action="" style="margin-top: 20px;">
            <button type="submit" name="clear" class="clear-btn">Clear All Data</button>
        </form>

        <?php
        $filename = 'students.txt';
        $success = '';
        $error = '';

        if (isset($_POST['register'])) {
            $name = htmlspecialchars($_POST['studentName']);
            $id = htmlspecialchars($_POST['studentId']);
            $course = htmlspecialchars($_POST['course']);
            $email = htmlspecialchars($_POST['email']);

            if (!empty($name) && !empty($id) && !empty($course) && !empty($email)) {
                $data = "Name: $name, ID: $id, Course: $course, Email: $email\n";
                if (file_put_contents($filename, $data, FILE_APPEND | LOCK_EX) !== false) {
                    $success = "Student registered successfully!";
                } else {
                    $error = "Error saving data.";
                }
            } else {
                $error = "Please fill all fields.";
            }
        }

        if (isset($_POST['clear'])) {
            if (file_put_contents($filename, '') !== false) {
                $success = "All data cleared successfully!";
            } else {
                $error = "Error clearing data.";
            }
        }

        if ($success) {
            echo "<p class='success'>$success</p>";
        }
        if ($error) {
            echo "<p class='error'>$error</p>";
        }
        ?>
    </div>
</body>
</html>
<?php
include 'includes/db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Verify reCAPTCHA response
    $secretKey = 'YOUR_SECRET_KEY';
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse");
    $responseKeys = json_decode($response, true);

    if (intval($responseKeys["success"]) !== 1) {
        echo '<script>alert("Please complete the reCAPTCHA.");</script>';
        exit();
    }

    // Sanitize input to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $email);

    $sql = "SELECT * FROM users WHERE LOWER(email) = LOWER('$email')";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row['password'];

            if (password_verify($password, $stored_password)) {
                $_SESSION['user_id'] = $row['id'];

                // Check if "Remember Me" is selected
                if (isset($_POST['remember'])) {
                    // Set cookie to remember user for 2 days
                    setcookie('user_email', $email, time() + (2 * 24 * 60 * 60), '/');
                }

                // Display success message and redirect to the dashboard after a brief delay
                echo '<script>
                    alert("Login successful");
                    window.location.href = "dashboard.php";
                    </script>';
                exit(); // Ensure no further code is executed after redirection
            } else {
                echo '<script>alert("Invalid Credentials");</script>';
                exit(); // Ensure no further code is executed after outputting error message
            }
        } else {
            echo '<script>alert("No user found with that email.");</script>';
            exit(); // Ensure no further code is executed after outputting error message
        }
    } else {
        echo '<script>alert("Error: ' . $sql . ' - ' . $conn->error . '");</script>';
        exit(); // Ensure no further code is executed after outputting error message
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="login.php" method="post" id="loginform">
    <input type="email" name="email" placeholder="Email" class="input-field" required>
    <br>
    <input type="password" name="password" placeholder="Password" class="input-field" required>
    <br>
    <div class="recaptcha-container">
        <div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY" data-size="compact"></div>
    </div>
    <br>
    <div class="remember-me">
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">Remember Me</label>
    </div>
    <br>
    <button class="login-button" type="submit">Login</button>
</form>

</body>
</html>
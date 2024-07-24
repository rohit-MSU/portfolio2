<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        .success-message {
            color: green;
            margin-bottom: 10px;
        }
    </style>
    <script>
        function showSuccess(message) {
            document.getElementById('success-message').textContent = message;
        }
    </script>
</head>
<body>
    <div id="success-message" class="success-message"></div>
    <?php
    if (isset($_GET['message'])) {
        echo '<script type="text/javascript">',
             'showSuccess("' . htmlspecialchars($_GET['message']) . '");',
             '</script>';
        echo '<script type="text/javascript">',
             'alert("' . htmlspecialchars($_GET['message']) . '");',
             '</script>';
    }
    ?>
    <h1>Welcome to the Dashboard</h1>
    <p>You are now logged in.</p>
</body>
</html>

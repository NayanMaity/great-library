<?php

$sub = "Your password was reset successfully";

$msg = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Password Reset Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            color: #333333;
        }
        p {
            color: #555555;
            line-height: 1.6;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #888888;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h1>Password Reset Successful</h1>
        <p>Dear " . $name . ",</p>
        <p>We wanted to let you know that your password has been successfully reset. You can now log in to your account using your new password.</p>
        <p>If you did not perform this action, please contact our support team immediately to secure your account.</p>
        <div class='footer'>
            Thank you,<br>
            Great Library Support Team
        </div>
    </div>
</body>
</html>

";

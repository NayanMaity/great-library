<?php

$sub = "Your password reset token";

$msg = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Password Reset Request</title>
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
        .token {
            display: block;
            background-color: #f4f4f4;
            padding: 10px;
            margin: 20px 0;
            text-align: center;
            font-size: 1.2em;
            font-weight: bold;
            color: #333333;
            border-radius: 4px;
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
        <h1>Password Reset Request</h1>
        <p>Dear " . $name . ",</p>
        <p>We received a request to reset your password for your account associated with this email address. If you did not make this request, please ignore this email.</p>
        <p>To reset your password, please use the following token:</p>
        <span class='token'>" . $token . "</span>
        <p>This token will expire in 30 minutes. If you need further assistance, please contact our support team.</p>
        <div class='footer'>
            Thank you,<br>
            Great Library Support Team
        </div>
    </div>
</body>
</html>

";

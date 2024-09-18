<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        p {
            margin-bottom: 10px;
        }

        .button-container {
            text-align: center;
        }

        .button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Confirmation</h2>
        <?php
        // Get the query parameters
        $bank = isset($_GET["bank"]) ? $_GET["bank"] : "";
        $message = isset($_GET["message"]) ? $_GET["message"] : "";
        $account_number = isset($_GET["account_number"]) ? $_GET["account_number"] : "";
        $account_name = isset($_GET["account_name"]) ? $_GET["account_name"] : "";
        $phone_number = isset($_GET["phone_number"]) ? $_GET["phone_number"] : "";
        $email = isset($_GET["email"]) ? $_GET["email"] : "";
        ?>
        <p>Dear Customer,</p>
        <p>Confirm your information:</p>
        <p>Your account name: <?php echo $account_name; ?></p>
        <p>Your account number: <?php echo $account_number; ?></p>
        <p>Your phone number: <?php echo $phone_number; ?></p>
        <p>Your email: <?php echo $email; ?></p>
        <div class="button-container">
            <a href="success.php" class="button">Confirm</a>
        </div>
    </div>
</body>
</html>

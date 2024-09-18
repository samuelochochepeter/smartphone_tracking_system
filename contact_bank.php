<?php
// Include your database connection file
include "db_connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $bank = $_POST["bank"];
    $message = $_POST["message"];
    $account_number = $_POST["account_number"];
    $account_name = $_POST["account_name"];
    $phone_number = $_POST["phone_number"];
    $email = $_POST["email"];

    // Insert the form data into the database
    $sql = "INSERT INTO account_block (bank, account_number, account_name, phone_number, email, message) VALUES ('$bank', '$account_number', '$account_name', '$phone_number', '$email', '$message')";
    if (mysqli_query($conn, $sql)) {
        // Redirect to confirmation page with GET parameters
        header("Location: confirmation_bank.php?bank=$bank&message=$message&account_number=$account_number&account_name=$account_name&phone_number=$phone_number&email=$email");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Contact Bank</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: grey;
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

        .bank {
            text-align: center;
            margin-bottom: 15px; /* Added margin */
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold; /* Added font-weight */
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="container">
        
        <h2>Contact your Bank's Customer Care to block your account Temporarily</h2>
        <form action="contact_bank.php" method="post">
            <div class="bank"> <!-- Enclosing bank selection in a div -->
                <label for="bank">Select Your Bank:</label>
                <select id="bank" name="bank" required>
                    <option value="">Select Bank</option>
                    <option value="Guaranty Trust Holding Company Plc">Guaranty Trust Holding Company Plc</option>
                    <option value="Access Bank">Access Bank</option>
                    <option value="Union Bank">Union Bank</option>
                    <option value="Zeneth Bank">Zeneth Bank</option>
                    <option value="Ecobank Nigeria">Ecobank Nigeria</option>
                    <option value="United Bank for Africa Plc">United Bank for Africa Plc(UBA)</option>
                    <option value="First City Monument Bank Limited">First City Monument Bank Limited(FCMB)</option>
                    <option value="Citibank Nigeria Limited">Citibank Nigeria Limited</option>
                    <option value="Polaris Bank Limited.">Polaris Bank Limited.</option>
                    <option value="Wema Bank Plc.">Wema Bank Plc.</option>
                    <option value="Unity Bank Plc">Unity Bank Plc.</option>
                    <option value="Sterling Bank Plc.">Sterling Bank Plc.</option>
                    <option value="Standard Chartered.">Standard Chartered.</option>
                    <option value="Stanbic IBTC Bank Plc.">Stanbic IBTC Bank Plc.</option>
                    <option value="Keystone Bank Limited.">Keystone Bank Limited.</option>
                    <option value="Titan Trust bank">Titan Trust bank</option>
                    <!-- Add more banks as needed -->
                </select><br><br>
            </div>
            <label for="account_number">Account Number:</label>
            <input type="text" id="account_number" name="account_number" required placeholder="Enter your Account number "><br><br>
            <label for="account_name">Account Name:</label>
            <input type="text" id="account_name" name="account_name" required placeholder="Enter your account name"><br><br>
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required placeholder="Enter your phone number that connected to your account"><br><br>
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required placeholder="Enter your Email that is Connected to your account"><br><br>
            <label for="message">Your Message:</label>
            <textarea id="message" name="message" rows="4" required placeholder="Reason for blocking your account"></textarea>
            <button type="submit">Send Message</button>
        </form>
        <a href="user_dashboard.php" class="btn btn-primary mt-3">Back to Dashboard</a>
    </div>
</body>
    </div>

</body>
</html>

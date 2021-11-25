<?php

require "components/config.php";

// if post request
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require_once "components/auth-status.php";
    $sender = $_SESSION['email'];
    $reciver = trim($_POST['reciver-email']);
    $subject = trim($_POST['subject']);
    $content = trim($_POST['content']);


    // checking for empty email
    if (empty($reciver) || empty($content)) {
        $error = "Invalid Mail. Try Again!";
        header("location: write-mail.php?msg=" . $error);
    }


    // checking for @email.com is given in email
    if (!strpos($reciver, '@email.com')) {
        $reciver .= '@email.com';
    }

    // checking that mail exists or not
    if(!emailExists($reciver)){
        $error = 'Email Not Exists.';
        header("location: write-mail.php?msg=" . $error);
    }

    if ($error == '') {
        $sql = "INSERT INTO `emails` (`sender`, `reciver`, `subject`, `content`) VALUES (?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $sender, $reciver, $subject, $content);

            // Try to execute this statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                $message = "Mail send Successfully";
            } else {
                echo "Something went wrong";
            }
        }
        mysqli_stmt_close($stmt);
    }

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Write Mail | Email Services</title>

    <link rel="stylesheet" href="static/CSS/base.css">
    <link rel="stylesheet" href="static/CSS/modal.css">
    <link rel="stylesheet" href="static/CSS/write-mail.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
</head>

<body>

    <?php
    require_once "components/nav.php";
    ?>

    <div class="form-container">
        <h1>Write Mail</h1>
        <form action="write-mail.php" method="POST">
            <div class="input-box">
                <input type="text" name="reciver-email" id="reciver" placeholder="To" required>
            </div>
            <div class="input-box">
                <input type="text" name="subject" id="subject" placeholder="Subject">
            </div>
            <div class="input-box">
                <textarea name="content" id="content" cols="20" rows="10" placeholder="Enter Your Mail Here...." required></textarea>
            </div>

            <button type="submit">Send Mail</button>
        </form>
        <button onclick="window.location.href = '/email/index.php'">Cancle</button>
    </div>




</body>

</html>
<?php

require_once "components/config.php";

$sql = "SELECT id, reciver, sender, date, subject, content FROM emails where id = '" . $_GET['id'] . "'";
$result = $conn->query($sql);

$mail = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Email | Email Services</title>

    <link rel="stylesheet" href="static/CSS/base.css">
    <link rel="stylesheet" href="static/CSS/modal.css">
    <link rel="stylesheet" href="static/CSS/mail.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
</head>

<body>

    <?php
    require_once "components/nav.php";
    ?>

    <div class="mail-container">
        <h1>Email</h1>
        <div class="box">
            <label for="from">From</label>
            <input type="text" name="from" id="from" value='<?php echo $mail['sender']; ?>' readonly>
        </div>
        <div class="box">
            <label for="to">To</label>
            <input type="text" name="to" id="to" value='<?php echo $mail['reciver']; ?>' readonly>
        </div>

        <div class="box">
            <label for="date">Date</label>
            <input type="text" name="date" id="date" value='<?php echo $mail['date']; ?>' readonly>
        </div>

        <div class="box">
            <label for="subject">Subject</label>
            <input type="text" name="subject" id="subject" value='<?php echo $mail['subject']; ?>' readonly>
        </div>
        <div class="content">
            <?php echo $mail['content']; ?>
        </div>

    </div>




</body>

</html>
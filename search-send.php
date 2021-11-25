<?php
// fetching search query
$search_str = $_GET['search'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Inbox | Email Services</title>

    <link rel="stylesheet" href="static/CSS/base.css">
    <link rel="stylesheet" href="static/CSS/modal.css">
    <link rel="stylesheet" href="static/CSS/inbox.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
</head>

<body>

    <?php
    require_once "components/nav.php";
    ?>

    <div class="mails-container" id="inbox-container">
        <h1>Search Result of Send Mail</h1>
        <div class="search-container">
            <form action="search-send.php" method="GET">
                <input type="search" name="search" id="search" value="<?php echo $search_str; ?>">
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="mail">
            <div class="date">
                Date
            </div>
            <div class="from">
                To
            </div>
            <div class="subject">
                Subject
            </div>
        </div>

        <?php

        // code to search mails

        require_once "components/config.php";

        $sql = "SELECT id, reciver, sender, date, subject, content FROM emails where sender = '" . $_SESSION['email'] . "' ORDER BY date DESC";
        $result = $conn->query($sql);

        if (!empty($result)) {

            if ($result->num_rows > 0) {
                // searching the mails 
                $results = '';
                while ($row = $result->fetch_assoc()) {
                    if (empty($search_str)) {
                        header("location: send-mails.php");
                    } else if ((strpos($row["subject"], $search_str) !== false) || (strpos($row["content"], $search_str) !== false)) {
                        $results .= '<a class="mail" href="/email/mail.php?id=' . $row["id"] . '"><div class="date">' . $row["date"] . '</div><div class="from">' . $row["reciver"] . '</div><div class="subject">' . $row["subject"] . '</div></a>';

                    }
                }
            } else {
                $results = "No Mail Found";
            }
            echo $results;
        }

        ?>

    </div>


</body>

</html>
<?php
require_once "components/config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// handling the post request
require_once "components/sign-up-post.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Email Services</title>
    <link rel="stylesheet" href="static/CSS/base.css">
    <link rel="stylesheet" href="static/CSS/modal.css">
    <link rel="stylesheet" href="static/CSS/signUp.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

</head>

<body>
    <?php
    require_once "components/nav.php";
    ?>

    <div class="form-container">
        <h1>Sign Up</h1>
        <form action="signUp.php" method="post">
            <div class="input-box">
                <input type="text" name="first-name" id="first-name" placeholder="First Name" required>
            </div>
            <div class="input-box">
                <input type="text" name="last-name" id="last-name" placeholder="Last Name" required>
            </div>

            <div class="input-box">
                <select name="gender" id="gender"> 
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="input-box">
                <input type="date" name="dob" id="dob" required>
            </div>

            <div class="input-box">
                <input type="text" name="email" id="email" placeholder="Choose Your Email" required>
                <span style="border:none;">@email.com</span>
            </div>


            <div class="input-box">
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="input-box">
                <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password" required>
            </div>

            <button type="submit">Create Account</button>
        </form>

    </div>

</body>



</html>